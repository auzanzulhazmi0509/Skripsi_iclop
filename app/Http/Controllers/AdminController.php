<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // Pages
    public function dashboard()
    {
        $tahun_ajaran = AcademicYear::where('status', '=', 'Aktif')->get();
        return view('user.admin.dashboard', compact('tahun_ajaran'));
    }

    public function academic_year()
    {
        $tahun_ajaran = AcademicYear::where('status', '=', 'Aktif')->get();
        return view('user.admin.academic_year.index', compact('tahun_ajaran'));
    }


    public function class()
    {
        $classes = Classes::with('teacher', 'year')->paginate(3);
        $teacher = Teacher::all();
        $year = AcademicYear::where('status', 'Aktif')->get();
        return view('user.admin.class.index', compact('classes', 'teacher', 'year'));
    }

    public function teacher()
    {
        $year = AcademicYear::where('status', 'Aktif')->get();
        $teacher = Teacher::with('user')->paginate(3);
        $users = User::get();
        $users = User::where('role', 'teacher')->get();
        return view('user.admin.teacher.index', compact('teacher', 'year', 'users'));

    }


    public function student()
    {
        $year = AcademicYear::where('status', 'Aktif')->get();
        return view('user.admin.student.index', compact('year'));
    }
// End of Pages
}
