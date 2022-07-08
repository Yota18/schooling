<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master.teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.teacher.add');
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
                'nip' => ['required', 'max:50', Rule::unique(Teacher::class)],
                'name' => ['required', 'max:200'],
                'email' => ['required', Rule::unique(User::class)],
                'gender' => ['required'],
                'birthplace' => ['required'],
                'birthdate' => ['required'],
                'religion' => ['required', 'max:20'],
                'phone' => ['required', 'max:20'],
                'address' => ['required'],
                'status' => ['required'],
                // 'image'=>['required', 'image','file','max:3024'],
            ],
            customAttributes: [
                'nip'=> __('attributes.nip'),
                'name'=> __('attributes.name'),
                'email' => __('attributes.email'),
                'gender' => __('attributes.gender'),
                'birthplace' => __('attributes.birthplace'),
                'birthdate' => __('attributes.birthdate'),
                'religion' => __('attributes.religion'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();

        
        $add_user = User::create([
            'name' => $request->name,
            'username' => $request->nip,
            'position_id' => 3,
            'email' => $request->email,
            'password' => Hash::make('Password'.$request->nip),
            'is_admin' => 0,
            'is_active' => $request->status,
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);
        
        
        if (!$add_user) {
            Alert::toast('Gagal menambahkan akun Guru.', 'error');
            return redirect()->to(route('master.users.teacher.index'));
        }
        
        
        $insert = Teacher::create([
            'nip' => $request->nip,
            'user_id' => $add_user->id,
            'gender' => $request->gender,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'religion' => $request->religion,
            // 'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
            'address' => $request->address,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('master.users.teacher.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return redirect()->to(route('master.users.teacher.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('pages.master.teacher.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'nip' => ['required', 'max:50', Rule::unique(Teacher::class)->ignore($teacher->id)],
                'name' => ['required', 'max:200'],
                'email' => ['required', Rule::unique(User::class)->ignore($teacher->user->id)],
                'gender' => ['required'],
                'birthplace' => ['required'],
                'birthdate' => ['required'],
                'religion' => ['required', 'max:20'],
                'phone' => ['required', 'max:20'],
                'address' => ['required'],
                'status' => ['required'],
                // 'image'=>['required', 'image','file','max:3024'],
            ],
            customAttributes: [
                'nip'=> __('attributes.nip'),
                'name'=> __('attributes.name'),
                'email' => __('attributes.email'),
                'gender' => __('attributes.gender'),
                'birthplace' => __('attributes.birthplace'),
                'birthdate' => __('attributes.birthdate'),
                'religion' => __('attributes.religion'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();

        $add_user = $teacher->user->update([
            'name' => $request->name,
            'username' => $request->nip,
            'email' => $request->email,
            'is_active' => $request->status,
        ]);

        $insert = $teacher->update([
            'nip' => $request->nip,
            'gender' => $request->gender,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'religion' => $request->religion,
            // 'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
            'address' => $request->address,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data guru {{ $request->name }}.', 'success');
        }else{
            Alert::toast('Gagal Mengubah data guru {{ $request->name }}.', 'error');
        }

        return redirect()->to(route('master.users.teacher.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
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
        
            
            $user = Teacher::find($request->id);
            if ($user->user->status != 'root') {
        
                if($user->user->email_verified_at != NULL){
                    if ($user->user->update(['is_active' => $isactive])) {
                        if ($isactive == '0') {
                            $message1 = "Pengguna Berhasil di non aktifkan";
                        }else{
                            $message1 = "Pengguna Berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'success',
                            'message' => $message1,
                        );
                    } else {
                        if ($isactive == '0') {
                            $message2 = "Pengguna tidak berhasil di non aktifkan";
                        }else{
                            $message2 = "Pengguna tidak berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'error',
                            'message' => $message2,
                        );
                    }
                }else{
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
