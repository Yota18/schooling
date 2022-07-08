<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.akademik.school_year.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.akademik.school_year.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'tahun_ajaran' => ['required', 'max:10'],
                'semester' => ['required', 'max:2'],
                // 'status' => ['required', 'max:2'],
            ],
            customAttributes: [
                'tahun_ajaran' => __('attributes.tahun_ajaran'),
            ],
        )->validate();


        $insert = SchoolYear::create([
            'year' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'status' => 0,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('akademik.school.year.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolYear $schoolYear)
    {
        return redirect()->to(route('akademik.school.year.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolYear $schoolYear)
    {
        return view('pages.akademik.school_year.edit', ['tahun_year' => $schoolYear]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolYear $schoolYear)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'tahun_ajaran' => ['required', 'max:10'],
                'semester' => ['required', 'max:2'],
                // 'status' => ['required', 'max:2'],
            ],
            customAttributes: [
                'tahun_ajaran' => __('attributes.tahun_ajaran'),
            ],
        )->validate();


        $insert = $schoolYear->update([
            'year' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'status' => 0,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data.', 'error');
        }

        return redirect()->to(route('akademik.school.year.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolYear $schoolYear)
    {
        if ($schoolYear->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Jurusan berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Jurusan gagal dihapus!',
            );
        }

        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(SchoolYear::latest()->get())->make(true);
    }

    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $SchoolYear = SchoolYear::find($request->id);
            if ($SchoolYear) {
                SchoolYear::where(['status' => '1'])->update(['status' => '0']);
                if ($SchoolYear->update(['status' => $isactive])) {
                    if ($isactive == '0') {
                        $message1 = "Tahun Ajaran Berhasil di non aktifkan";
                    } else {
                        $message1 = "Tahun Ajaran Berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'success',
                        'message' => $message1,
                    );
                } else {
                    if ($isactive == '0') {
                        $message2 = "Tahun Ajaran tidak berhasil di non aktifkan";
                    } else {
                        $message2 = "Tahun Ajaran tidak berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'error',
                        'message' => $message2,
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Tahun Ajaran tidak ditemukan!',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Tahun Ajaran tidak ditemukan!',
            );
        }
        echo json_encode($response);
    }
}
