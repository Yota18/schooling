<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Classes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Classes::latest()->get()->load('major');
        return view('pages.akademik.classes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.akademik.classes.add', ['jurusan' => Major::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        Validator::make(
            data: $request->all(),
            rules: [
                // 'kode' => ['required', 'max:50', Rule::unique(Classes::class, 'code')],
                'jurusan' => ['required', 'max:4'],
                'name' => ['required', 'max:100', Rule::unique(Classes::class)->where(fn ($query) => $query->where(['major_id' => $request->jurusan, 'name' => $request->name]))],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
            ],
        )->validate();


        $jurusan = Major::find($request->jurusan);

        $insert = Classes::create([
            'name' => $request->name,
            'code' => Str::slug($request->name . '-' . $jurusan->code, '-'),
            'major_id' => $jurusan->id,
            'status' => 0,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('akademik.classes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        return redirect()->to(route('akademik.classes.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        return view('pages.akademik.classes.edit', ['jurusan' => Major::all(), 'class' => $classes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $classes)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                // 'kode' => ['required', 'max:50', Rule::unique(Classes::class, 'code')],
                'jurusan' => ['required', 'max:4'],
                'name' => ['required', 'max:100', Rule::unique('Classes')->where(fn ($query) => $query->where(['major_id' => $request->jurusan, 'name' => $request->name]))->ignore($classes->id) ],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
            ],
        )->validate();

        // return $request->all();

        $jurusan = Major::find($request->jurusan);

        $insert = $classes->update([
            'name' => $request->name,
            'code' => Str::slug($request->name . '-' . $jurusan->code, '-'),
            'major_id' => $jurusan->id,
        ]);

        if ($insert) {
            Alert::toast('Berhasil mengubah data.', 'success');
        } else {
            Alert::toast('Gagal mengubah data.', 'error');
        }

        return redirect()->to(route('akademik.classes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        if ($classes->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Kelas berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kelas gagal dihapus!',
            );
        }

        echo json_encode($response);
    }
    public function data()
    {
        return DataTables::of(Classes::latest()->get()->load('major'))->make(true);
    }
    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $classes = Classes::find($request->id);
            if ($classes) {
                if ($classes->update(['status' => $isactive])) {
                    if ($isactive == '0') {
                        $message1 = "Kelas Berhasil di non aktifkan";
                    } else {
                        $message1 = "Kelas Berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'success',
                        'message' => $message1,
                    );
                } else {
                    if ($isactive == '0') {
                        $message2 = "Kelas tidak berhasil di non aktifkan";
                    } else {
                        $message2 = "Kelas tidak berhasil di aktifkan";
                    }
                    $response = array(
                        'status' => 'error',
                        'message' => $message2,
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Kelas tidak ditemukan!',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kelas tidak ditemukan!',
            );
        }
        echo json_encode($response);
    }
}
