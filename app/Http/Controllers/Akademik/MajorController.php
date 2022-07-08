<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.akademik.major.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.akademik.major.add');
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
                'name' => ['required', 'max:100'],
                'kode' => ['required', 'max:50', Rule::unique(Major::class, 'code')],
                'status' => ['required', 'max:50'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
            ],
        )->validate();


        $insert = Major::create([
            'name' => $request->name,
            'code' => $request->kode,
            'status' => $request->status,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('akademik.major.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        return redirect()->to(route('akademik.major.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        return view('pages.akademik.major.edit', ['jurusan' => $major]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:100'],
                'kode' => ['required', 'max:50', Rule::unique(Major::class, 'code')->ignore($major->id)],
                'status' => ['required', 'max:50'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
            ],
        )->validate();


        $insert = $major->update([
            'name' => $request->name,
            'code' => $request->kode,
            'status' => $request->status,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data.', 'error');
        }

        return redirect()->to(route('akademik.major.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        if ($major->delete()) {
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
        return DataTables::of(Major::latest()->get())->make(true);
    }
    
    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $major = Major::find($request->id);
            if ($major) {
                if ($major->update(['status' => $isactive])) {
                    if ($isactive == '0') {
                        $message1 = "Jurusan Berhasil di non aktifkan";
                    } else {
                        $message1 = "Jurusan Berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'success',
                        'message' => $message1,
                    );
                } else {
                    if ($isactive == '0') {
                        $message2 = "Jurusan tidak berhasil di non aktifkan";
                    } else {
                        $message2 = "Jurusan tidak berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'error',
                        'message' => $message2,
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Jurusan tidak ditemukan!',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Jurusan tidak ditemukan!',
            );
        }
        echo json_encode($response);
    }
}
