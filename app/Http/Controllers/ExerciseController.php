<?php

namespace App\Http\Controllers;

use App\Models\ExerciseQuestion;
use Illuminate\Support\Facades\Redirect;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExerciseController extends Controller
{
    public function addExercise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'year_id' => 'required|numeric',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {


            $exercise = new Exercise();
            $exercise->name = $request->name;
            $exercise->academic_year_id = $request->year_id;
            $exercise->description = $request->description;
            $query = $exercise->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Terjadi kesalahan']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Latihan baru berhasil ditambahkan']);
            }
        }
    }

    public function getExerciseDetail(Request $request)
    {
        $detail = Exercise::with('year')->where('id', $request->eid)->get();
        return response()->json(['code' => 1, 'details' => $detail]);
    }

    public function updateExercise(Request $request)
    {
        $eid = $request->eid;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'academic_year_id' => 'required',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $exercise = Exercise::find($eid);
            $exercise->name = $request->name;
            $exercise->academic_year_id = $request->academic_year_id;
            $exercise->description = $request->description;
            $query = $exercise->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Terjadi kesalahan']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Tahun Ajaran berhasil diperbarui']);
            }
        }
    }

    public function getExerciseAsOption(Request $request)
    {
        $data['exercise'] = Exercise::where('academic_year_id', $request->yid)->get();
        return response()->json($data);
    }

    public function getExerciseIDForDataTable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exercise_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            return response()->json(['code' => 1, 'msg' => $request->exercise_id]);
        }
    }

    // public function getExerciseIDForDataTable(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'exercise_id' => [
    //             'required',
    //             'numeric',
    //             function ($attribute, $value, $fail) {
    //                 $exercise = Exercise::where('id', $value)->where('is_enabled', true)->first();
    //                 if (!$exercise) {
    //                     $fail('Latihan yang dipilih tidak aktif atau tidak ditemukan.');
    //                 }
    //             },
    //         ],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    //     } else {
    //         return response()->json(['code' => 1, 'msg' => $request->exercise_id]);
    //     }
    // }

    public function toggleExercise(Request $request)
    {
        $exercise = Exercise::find($request->exercise_id);
        if ($exercise) {
            $exercise->is_enabled = !$exercise->is_enabled;
            $exercise->save();
            $status = $exercise->is_enabled ? 'di-Enable' : 'di-Disable';
            return response()->json(['code' => 1, 'msg' => "Status latihan berhasil $status"]);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Latihan tidak ditemukan']);
        }
    }


    public function deleteExercise(Request $request, $exercise_id)
    {
        $exercise = Exercise::find($exercise_id);
        if (!$exercise) {
            return response()->json(['code' => 0, 'msg' => 'Latihan tidak ditemukan']);
        }

        // Hapus latihan pada tabel ExerciseQuestion
        ExerciseQuestion::where('exercise_id', $exercise_id)->delete();

        $exercise->delete();
        return Redirect::back()->with(['code' => 1, 'msg' => 'Latihan berhasil dihapus']);
    }
}
