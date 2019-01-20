<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        return view('admin.setting.index')->with('settings', Setting::first());
    }

    public function update(Request $request){
       // dd($request->all());
        $this->validate($request,[
            'site_name' => 'required',
            'address' => 'required',
            'contact_email' => 'required|email',
            'contact_number' => 'required',
            'about' => 'required',
        ]);

        $settings = Setting::first();

        $settings->site_name = $request->site_name;
        $settings->address = $request->address;
        $settings->contact_email = $request->contact_email;
        $settings->contact_number = $request->contact_number;
        $settings->about = $request->about;

        $settings->save();

        Session::flash('success', 'Settings are Updated');

        return redirect()->route('settings');
    }
}
