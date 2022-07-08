<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\CategorySubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.akademik.mapel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.akademik.mapel.add', ['categories' => CategorySubject::all()]);
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
                'pelajaran' => ['required', 'max:100'],
                'code' => ['required', 'max:10'],
                'category_pelajaran' => ['required', 'max:10'],
                'status' => ['required', 'max:2'],
            ],
            customAttributes: [
                'category_pelajaran' => __('attributes.category_pelajaran'),
                'code' => __('attributes.code'),
            ],
        )->validate();


        $insert = Subject::create([
            'name' => $request->pelajaran,
            'category_subject_id' => $request->category_pelajaran,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('akademik.mapel.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return redirect()->to(route('akademik.mapel.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('pages.akademik.mapel.edit', ['mapel' => $subject, 'categories' => CategorySubject::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'pelajaran' => ['required', 'max:100'],
                'code' => ['required', 'max:10'],
                'category_pelajaran' => ['required', 'max:10'],
                'status' => ['required', 'max:2'],
            ],
            customAttributes: [
                'category_pelajaran' => __('attributes.category_pelajaran'),
                'code' => __('attributes.code'),
            ],
        )->validate();


        $insert = $subject->update([
            'name' => $request->pelajaran,
            'category_subject_id' => $request->category_pelajaran,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data.', 'error');
        }

        return redirect()->to(route('akademik.mapel.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        if ($subject->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Pelajaran berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pelajaran gagal dihapus!',
            );
        }

        echo json_encode($response);
    }
    public function data()
    {
        // return Subject::latest()->get();
        return DataTables::of(Subject::latest()->get())->make(true);
    }

    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $Subject = Subject::find($request->id);
            if ($Subject) {
                if ($Subject->update(['status' => $isactive])) {
                    if ($isactive == '0') {
                        $message1 = "Pelajaran Berhasil di non aktifkan";
                    } else {
                        $message1 = "Pelajaran Berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'success',
                        'message' => $message1,
                    );
                } else {
                    if ($isactive == '0') {
                        $message2 = "Pelajaran tidak berhasil di non aktifkan";
                    } else {
                        $message2 = "Pelajaran tidak berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'error',
                        'message' => $message2,
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Pelajaran tidak ditemukan!',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pelajaran tidak ditemukan!',
            );
        }
        echo json_encode($response);
    }
}
