<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategorySubject;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CategorySubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.akademik.mapel.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.akademik.mapel.category.add');
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
                'category_pelajaran' => ['required', 'max:10'],
                'status' => ['required', 'max:2'],
            ],
            customAttributes: [
                'category_pelajaran' => __('attributes.category_pelajaran'),
                'tahun_ajaran' => __('attributes.tahun_ajaran'),
            ],
        )->validate();


        $insert = CategorySubject::create([
            'name' => $request->category_pelajaran,
            'status' => $request->status,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('akademik.mapel.category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorySubject  $categorySubject
     * @return \Illuminate\Http\Response
     */
    public function show(CategorySubject $categorySubject)
    {
        return redirect()->to(route('akademik.mapel.category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorySubject  $categorySubject
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorySubject $categorySubject)
    {
        return view('pages.akademik.mapel.category.edit', ['kategori' => $categorySubject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorySubject  $categorySubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorySubject $categorySubject)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'category_pelajaran' => ['required', 'max:10'],
                'status' => ['required', 'max:2'],
            ],
            customAttributes: [
                'category_pelajaran' => __('attributes.category_pelajaran'),
                'tahun_ajaran' => __('attributes.tahun_ajaran'),
            ],
        )->validate();


        $insert = $categorySubject->update([
            'name' => $request->category_pelajaran,
            'status' => $request->status,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data.', 'error');
        }

        return redirect()->to(route('akademik.mapel.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorySubject  $categorySubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorySubject $categorySubject)
    {
        if ($categorySubject->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Kategori Pelajaran berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kategori Pelajaran gagal dihapus!',
            );
        }

        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(CategorySubject::latest()->get())->make(true);
    }

    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $CategorySubject = CategorySubject::find($request->id);
            if ($CategorySubject) {
                if ($CategorySubject->update(['status' => $isactive])) {
                    if ($isactive == '0') {
                        $message1 = "Kategori Pelajaran Berhasil di non aktifkan";
                    } else {
                        $message1 = "Kategori Pelajaran Berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'success',
                        'message' => $message1,
                    );
                } else {
                    if ($isactive == '0') {
                        $message2 = "Kategori Pelajaran tidak berhasil di non aktifkan";
                    } else {
                        $message2 = "Kategori Pelajaran tidak berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'error',
                        'message' => $message2,
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Kategori Pelajaran tidak ditemukan!',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kategori Pelajaran tidak ditemukan!',
            );
        }
        echo json_encode($response);
    }
}
