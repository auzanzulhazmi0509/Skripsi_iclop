<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\User;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{

    public function getTeacher()
    {
        $dosen = Teacher::all();
        return DataTables::of($dosen)
            ->editColumn('academic_year_id', function ($row) {
                return $row->academic_year->name;
            })
            ->addColumn('status', function ($row) {
                return $row -> academic_year -> status;
            })
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group" role="group">
                            <a href="'.route('admin.teacher.update', ['id' => $row['id']]).'" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Update">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="'.route('admin.teacher.delete', ['id' => $row['id']]).'" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="fa fa-trash"></i>
                            </a>
                        </div>';

            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function addTeacher(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'academic_year_id'  => 'required',
            'user_id'   => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $teacher = new Teacher();
            $teacher->nama = $request->name;
            $teacher->academic_year_id = $request->academic_year_id;
            $teacher->user_id = $request->user_id;
            $query = $teacher->save();


            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Terjadi kesalahan']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Dosen baru berhasil ditambahkan']);
            }
        }
    }

    public function dashboard()
    {
        return view('user.teacher.dashboard');
    }

    public function class()
    {
        $year = AcademicYear::where('status', 'Aktif')->get();
        $teacher = Teacher::all();
        // $class = Classes::where('teacher_id', 1)->paginate(2);
        $class = Classes::with('teacher', 'year')->paginate(4);
        // $class = Classes::where('teacher_id', 1)->paginate(3);
        return view('user.teacher.class.index', compact('class', 'year'));
    }

    public function getClassStudent(Request $request)
    {
        $class_id = $request->class_id;

    }

    public function getClass()
    {
        $class = Classes::where('teacher_id', 1)->get();
        return response()->json(['code' => 1, 'details' => $class]);
    }

    public function question()
    {
        return view('user.teacher.question.index');
    }

    public function exercise()
    {
        $exercise = Exercise::with('year')->paginate(3);
        $year = AcademicYear::where('status', 'Aktif')->get();
        return view('user.teacher.exercise.index', compact('exercise', 'year'));
    }

    public function exerciseQuestion(Request $request)
    {
        $exercise = Exercise::with('year')->paginate(3);
        $year = AcademicYear::where('status', 'Aktif')->get();
        $exercise_id = $request->exercise_id;
        return view('user.teacher.exerciseQuestion.index',compact('exercise', 'year','exercise_id'));
    }

    public function exerciseResult(Request $request)
    {
        // $class = Classes::where('teacher_id', Auth::user()->id)->get();
        $class = DB::table('teacher')
            ->join('users', 'teacher.user_id', 'users.id')
            ->join('class', 'teacher.id', 'class.teacher_id')
            ->where('users.id', Auth::user()->id)
            ->select('class.id', 'class.name')
            ->get();
        return view('user.teacher.exerciseResult.index', compact('class'));
    }


    public function updateView($id)
    {
        $teacher = Teacher::find($id);
        $year = AcademicYear::where('status', 'Aktif')->get();
        $users = User::get();
        $users = User::where('role', 'teacher')->get();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan');
        }

        return view('user.admin.teacher.update', compact('teacher', 'year', 'users'));
    }


    public function updateTeacher(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'academic_year_id'  => 'required',
        ]);

        // Periksa apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Lakukan proses pembaruan data dosen
        $teacher = Teacher::find($id);
        $year = AcademicYear::where('status', 'Aktif')->get();
        $teacher->academic_year_id = $request->academic_year_id;
        $teacher->nama = $request->name;
        $teacher->save();

        // Mengirimkan data tahun dan data user ke tampilan index
        $year = AcademicYear::all();
        $users = User::all();
        return view('user.admin.teacher.index', compact('year', 'users'))->with('success', 'Data dosen berhasil diperbarui');
    }

    public function deleteTeacher(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan');
        }

        $teacher->delete();

        $year = AcademicYear::all(); // untuk mendapatkan data tahun
        $users = User::all(); // untuk mendapatkan data pengguna

        return view('user.admin.teacher.index', compact('year', 'users'))->with('success', 'Data dosen berhasil dihapus');
    }


}
