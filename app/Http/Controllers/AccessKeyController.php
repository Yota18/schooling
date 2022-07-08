<?php

namespace App\Http\Controllers;

use App\Models\ApiUser;
use Illuminate\Http\Request;

class AccessKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessKey = ApiUser::get();
        $data['accessKeys'] = $accessKey;
        return view('API.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('API.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required'],
            'ability'=>['required'],
            'active'=>['required'],
        ]);
        $token = md5(uniqid(rand(), true));
        ApiUser::create([
            'project_name'=>$request->name,
            'is_active'=>$request->active,
            'token'=>$token,
            'ability'=>implode(',',$request->ability),
        ]);
        // return implode(',',$request->ability);
        return redirect()->to(route('accesskey.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function show(ApiUser $apiUser)
    {
        return $apiUser;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiUser $apiUser)
    {
        $accessKey = $apiUser;
        return view('API.edit', ['accessKey' => $accessKey]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiUser $apiUser)
    {
        // var_dump($apiUser);
        $request->validate([
            'name'=>['required'],
            'ability'=>['required'],
            'active'=>['required'],
        ]);

        $apiUser->update([
            'project_name'=>$request->name,
            'is_active'=>$request->active,
            'ability'=>implode(',',$request->ability),
        ]);

        return redirect()->to(route('accesskey.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiUser $apiUser)
    {
        $apiUser->delete();
        return redirect()->to(route('accesskey.index'));
    }
}
