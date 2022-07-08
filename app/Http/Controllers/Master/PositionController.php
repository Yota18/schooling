<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master.position.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.position.add');
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
                // 'image'=>['required', 'image','file','max:1024'],
            ],
            customAttributes: [
                'name'=> __('attributes.name'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();
        

        $insert = Position::create([
            'name' => $request->name,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('master.jabatan.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return redirect()->to(route('master.jabatan.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('pages.master.position.edit', ['jabatan' => $position]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:100'],
                // 'image'=>['required', 'image','file','max:1024'],
            ],
            customAttributes: [
                'name'=> __('attributes.name'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();
        

        $update = $position->update([
            'name' => $request->name,
        ]);

        if ($update) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }

        return redirect()->to(route('master.jabatan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        if ($position->delete()) {
            // Storage::disk('public')->delete($career->image);
            $response = array(
                'status' => 'success',
                'message' => 'Karir berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Karir tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }
}
