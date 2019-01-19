<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        //
        return view('admin.user.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');

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
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt('password'),
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/dp.png'
        ]);

        Session::flash('success', 'User Created Successfully.');

        return redirect()->route('users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->profile->delete();
        $user->delete();

        Session::flash('success', 'User Deleted Permanently');

        return redirect()->route('users');
    }

    public function admin($id){
        $user = User::findOrFail($id);
        $user->admin = 1;
        $user->save();

        Session::flash('success', 'The Permission Changed to Admin');

        return redirect()->back();

    }

    public function notAdmin($id){
        $user = User::findOrFail($id);
        $user->admin = 0;
        $user->save();

        Session::flash('success', 'The Permission Changed to Subscriber');

        return redirect()->back();

    }
}
