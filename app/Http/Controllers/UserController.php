<?php

namespace App\Http\Controllers;

use App\Models\User;
//use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $model = User::all();
        // dump($model);
        return view('users.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         return view('users.index');
     }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $model
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dump($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            // 'email_verified_at' => 'required',
        ]);
    

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // User::create($request->all());

        return redirect('/user')
            ->with('status', 'Data Pengguna Berhasil Ditambahkan!');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\User  $model
    * @return \Illuminate\Http\Response
    */   


    public function show($id)
    {
        $model = User::findOrFail($id);
        return view('users.index', compact('model'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\User  $model
    * @return \Illuminate\Http\Response
    */
    public function edit(User $model)
    {
        return view('user', compact('model'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $model
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request , User $model)
    {

        $model = User::find($model);

        $model->name = $request->input('name');
        $model->email = $request->input('email');

        $model->save();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\User  $model
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/user')
            ->with('status', 'Data Pengguna Berhasil Dihapus!');
    }

}

?>