<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SettingClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ClassPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function class()
    {
        return view('pages.akademik.class_promotion.class', ['classes' => Classes::orderBy('code', 'ASC')->get()->append('siswa', 'mapal'), 'warnanya' => ['success', 'warning', 'danger', 'info', 'secondary']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Classes $class)
    {
        $kelas = $class->load('major');
        $students = Student::where('classes_id', $class->id)->NotAlumni()->get()->load('user');
        // return $students;
        return view('pages.akademik.class_promotion.index', ['kelas' => $kelas, 'students' => $students, 'classes' => Classes::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Classes $class)
    {
        return view('pages.akademik.class_promotion.add', ['kelas' => $class, 'teachers' => Teacher::all()->load('user'), 'subjects' => Subject::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classes $class)
    {
        // dd($request->students);


        Validator::make(
            data: $request->all(),
            rules: [
                'kelas_dest' => ['required'],
                // 'siswa' => ['required'],
            ],
            customAttributes: [
                'kelas_dest' => __('attributes.kelas_dest'),
            ],
        )->validate();

        if ($request->siswa == null) {
            Alert::toast('Mohon pilih siswa yang akan dipindahkan.', 'warning');
            return redirect()->to(route('akademik.pindah.class.index', ['class' => $class->code]));
        }

        if ($request->kelas_dest != 'alumni') {
            $get_siswa = Student::whereIn('id', $request->siswa)->update(['classes_id' => $request->kelas_dest]);
        } else {
            $get_siswa = Student::whereIn('id', $request->siswa)->get()->load('user');
            foreach ($get_siswa as $siswa) {
                $siswa->user->update(['position_id' => 5]);
                $siswa->update(['alumni' => 1]);
            }
        }


        if ($get_siswa) {
            Alert::toast('Berhasil memindahkan siswa.', 'success');
        } else {
            Alert::toast('Gagal memindahkan siswa.', 'error');
        }

        return redirect()->to(route('akademik.pindah.class.index', ['class' => $class->code]));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingClass  $settingClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class, SettingClass $settingClass)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'pelajaran' => ['required', 'max:2'],
                'pengajar' => ['required', 'max:50'],
            ],
            customAttributes: [
                // 'name' => __('attributes.name'),
            ],
        )->validate();


        $insert = $settingClass->update([
            'classes_id' => $class->id,
            'subject_id' => $request->pelajaran,
            'teacher_id' => $request->pengajar,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data.', 'error');
        }

        return redirect()->to(route('akademik.setting.class.index', ['class' => $class->code]));
    }
}
