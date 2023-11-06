<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Submission;
use App\Models\ExerciseQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    public function getQuestionDataTable()
    {
        $soal = Question::all();
        return DataTables::of($soal)
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group" role="group">
            <button id="detailBtn" type="button" class="btn btn-primary btn-block" data-id="' . $row->id . '">
            <i class="fa fa-eye"></i>
            </button>
            </div>';
            })
            ->addColumn('delete', function ($row) {
                return '<button id="deleteBtn" type="button" class="btn btn-danger btn-block" data-id="' . $row->id . '">
                    <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function addQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'topic' => 'string',
            // 'dbname' => 'required|string',
            'description' => 'required|string',
            'hint' => 'string',
            'answer' => 'required|string',
            'guidance' => 'required|mimes:pdf|max:2048',
            // 'test_result' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $path = 'dql_soal/';
            $file = $request->file('guidance');
            $file_name = $file->getClientOriginalName();

            $upload = $file->storeAs($path, $file_name, 'public');

            if ($upload) {
                Question::insert([
                    'title' => $request->title,
                    'topic' => $request->topic,
                    // 'dbname' => $request->dbname,
                    'description' => $request->description,
                    'hint' => $request->hint,
                    'answer' => $request->answer,
                    'guide' => $file_name,
                    // 'test_result' => $request->test_result,
                ]);
                return response()->json(['code' => 1, 'msg' => 'BERHASIL menambahkan soal baru.']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'GAGAL menambahkan soal baru.']);
            }
        }
    }

    public function getQuestionDetail(Request $request)
    {
        $detailSoal = Question::find($request->question_id);
        return response()->json(['code' => 1, 'details' => $detailSoal]);
    }


    public function updateQuestion(Request $request)
    {
        $question_id = $request->qid;
        $task = Question::find($question_id);
        $path = 'dql_soal/';

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'topic' => 'string',
            // 'dbname' => 'required|string',
            'description' => 'required|string',
            'answer' => 'required|string',
            // 'test_result' => 'required|string',
            'guidance_update' => 'mimes:pdf|max:2048|unique:question,guide',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            if ($request->hasFile('guidance_update')) {
                $file_path = $path . $task->guidance;
                if ($task->guidance != null && Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('guidance_update');
                $file_name = $file->getClientOriginalName();
                $upload = $file->storeAs($path, $file_name, 'public');

                if ($upload) {
                    $task->update([
                        'title' => $request->title,
                        'topic' => $request->topic,
                        // 'dbname' => $request->dbname,
                        'description' => $request->description,
                        'hint' => $request->hint,
                        'answer' => $request->answer,
                        'guide' => $file_name,
                        // 'test_result' => $request->test_result,
                    ]);
                    return response()->json(['code' => 1, 'msg' => 'BERHASIL memperbarui data soal.']);
                }
            } else {
                $task->update([
                    'title' => $request->title,
                    'topic' => $request->topic,
                    // 'dbname' => $request->dbname,
                    'description' => $request->description,
                    'hint' => $request->hint,
                    'answer' => $request->answer,
                    // 'test_result' => $request->test_result,
                ]);
                return response()->json(['code' => 1, 'msg' => 'BERHASIL memperbarui data soal.']);
            }
        }
    }

    public function deleteQuestion(Request $request)
    {
        $question = Question::find($request->question_id);
        if ($question) {
            // Hapus semua submission yang terkait
            Submission::where('question_id', $request->question_id)->delete();
            // Lakukan pengecekan dan hapus keterkaitan terlebih dahulu sebelum menghapus baris
            $exerciseQuestions = ExerciseQuestion::where('question_id', $request->question_id)->get();
            foreach ($exerciseQuestions as $exerciseQuestion) {
                $exerciseQuestion->delete();
            }
            // Hapus file gambar terkait dengan menggunakan Storage::disk('public')->delete('nama_file');
            $question->delete();
            return response()->json(['msg' => 'Soal berhasil dihapus.']);
        } else {
            return response()->json(['msg' => 'Gagal menghapus soal.'], 400);
        }
    }
}
