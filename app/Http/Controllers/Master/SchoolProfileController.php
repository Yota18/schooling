<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class SchoolProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolProfile  $schoolProfile
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolProfile $schoolProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolProfile  $schoolProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolProfile $schoolProfile)
    {
        // return SchoolProfile::latest()->first();
        return view('pages.master.school_profile.edit', ['school' => SchoolProfile::latest()->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolProfile  $schoolProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'nama_sekolah' => ['required', 'max:100'],
                'npsn' => ['required', 'max:100'],
                'nss' => ['required', 'max:100'],
                'email' => ['required', 'email', 'max:100'],
                'alamat' => ['required'],
                'website' => ['required', 'max:100'],
                'youtube' => ['max:100'],
                'alamat' => ['max:100'],
                'whatsapp' => ['max:100'],
                'instagram' => ['max:100'],
                'facebook' => ['max:100'],
            ],
            customAttributes: [
                'nama_sekolah' => __('attributes.nama_sekolah'),
            ],
        )->validate();

        if ($request->file('image')) {
            Validator::make(
                data: $request->all(),
                rules: [
                    'logo' => ['required', 'image', 'file', 'max:3024'],
                ],
                customAttributes: [
                    // 'image' => __('attributes.image'),
                ],
            )->validate();
        }

        $schoolProfile = SchoolProfile::first();
        // return $schoolProfile;
        $data = [
            'name' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'nss' => $request->nss,
            'address' => $request->alamat,
            'website' => $request->website,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
        ];
        if ($request->file('logo')) {
            if ($schoolProfile->image != null) {
                Storage::disk('public')->delete($schoolProfile->image);
            }
            $data['image'] = $request->file('logo')->store('profil_sekolah');
        }
        if ($schoolProfile == null) {
            $edit = SchoolProfile::create($data);
        } else {
            $edit = $schoolProfile->update($data);
        }

        if ($edit) {
            Alert::toast('Berhasil mengubah Profil Sekolah.', 'success');
        } else {
            Alert::toast('Gagal mengubah Profil Sekolah.', 'error');
        }
        return redirect()->to(route('master.school.profile.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolProfile  $schoolProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolProfile $schoolProfile)
    {
        //
    }
}
