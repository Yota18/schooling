<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Staff::latest()->get()->load('user', 'user.position');
        return view('pages.master.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.staff.add', ['positions' => Position::whereNotIn('id', [3, 4])->get()]);
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
                'name' => ['required', 'max:200'],
                'username' => ['required', 'max:50', Rule::unique(User::class)],
                'email' => ['required', Rule::unique(User::class)],
                'gender' => ['required'],
                'birthplace' => ['required'],
                'birthdate' => ['required'],
                'religion' => ['required', 'max:20'],
                'phone' => ['required', 'max:20'],
                'address' => ['required'],
                'status' => ['required'],
                'position' => ['required'],
                // 'image'=>['required', 'image','file','max:3024'],
            ],
            customAttributes: [
                'username'=> __('attributes.username'),
                'name'=> __('attributes.name'),
                'email' => __('attributes.email'),
                'gender' => __('attributes.gender'),
                'birthplace' => __('attributes.birthplace'),
                'birthdate' => __('attributes.birthdate'),
                'religion' => __('attributes.religion'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
                'position' => __('attributes.position'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();

        

        $add_user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'position_id' => $request->position,
            'email' => $request->email,
            'password' => Hash::make('Password'),
            'is_admin' => 0,
            'is_active' => $request->status,
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);
        
        // return $request->all();
        
        if (!$add_user) {
            Alert::toast('Gagal menambahkan akun Staff.', 'error');
            return redirect()->to(route('master.users.staff.index'));
        }
        
        
        $insert = Staff::create([
            'user_id' => $add_user->id,
            'gender' => $request->gender,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'religion' => $request->religion,
            'address' => $request->address,
            // 'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data Staff.', 'success');
        }else{
            Alert::toast('Gagal menambah data Staff.', 'error');
        }

        return redirect()->to(route('master.users.staff.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return redirect()->to(route('master.users.staff.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        return view('pages.master.staff.edit', ['staff' => $staff, 'positions' => Position::whereNotIn('id', [3, 4])->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:200'],
                'username' => ['required', 'max:50', Rule::unique(User::class)->ignore($staff->user->id)],
                'email' => ['required', Rule::unique(User::class)->ignore($staff->user->id)],
                'gender' => ['required'],
                'birthplace' => ['required'],
                'birthdate' => ['required'],
                'religion' => ['required', 'max:20'],
                'phone' => ['required', 'max:20'],
                'address' => ['required'],
                'status' => ['required'],
                'position' => ['required'],
                // 'image'=>['required', 'image','file','max:3024'],
            ],
            customAttributes: [
                'username'=> __('attributes.username'),
                'name'=> __('attributes.name'),
                'email' => __('attributes.email'),
                'gender' => __('attributes.gender'),
                'birthplace' => __('attributes.birthplace'),
                'birthdate' => __('attributes.birthdate'),
                'religion' => __('attributes.religion'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
                'position' => __('attributes.position'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();

        

        $add_user = $staff->user->update([
            'name' => $request->name,
            'username' => $request->username,
            'position_id' => $request->position,
            'email' => $request->email,
            'is_active' => $request->status,
        ]);
        
        // return $request->all();
        
        if (!$add_user) {
            Alert::toast('Gagal mengubah akun Staff.', 'error');
            return redirect()->to(route('master.users.staff.index'));
        }
        
        
        $insert = $staff->update([
            'gender' => $request->gender,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'religion' => $request->religion,
            'address' => $request->address,
            // 'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
        ]);

        if ($insert) {
            Alert::toast('Berhasil mengubah data Staff.', 'success');
        }else{
            Alert::toast('Gagal mengubah data Staff.', 'error');
        }

        return redirect()->to(route('master.users.staff.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }

    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $user = Staff::find($request->id);
            if ($user->user->status != 'root') {

                if ($user->user->email_verified_at != NULL) {
                    if ($user->user->update(['is_active' => $isactive])) {
                        if ($isactive == '0') {
                            $message1 = "Pengguna Berhasil di non aktifkan";
                        } else {
                            $message1 = "Pengguna Berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'success',
                            'message' => $message1,
                        );
                    } else {
                        if ($isactive == '0') {
                            $message2 = "Pengguna tidak berhasil di non aktifkan";
                        } else {
                            $message2 = "Pengguna tidak berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'error',
                            'message' => $message2,
                        );
                    }
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Email Belum di Verifikasi',
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Root tidak bisa dinonaktifkan',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pengguna tidak ditemukan!',
            );
        }
        echo json_encode($response);
    }
}
