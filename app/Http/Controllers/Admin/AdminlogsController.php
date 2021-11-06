<?php

namespace App\Http\Controllers\Admin;

use App\Adminlogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Adminlogs::all();

        return view('admin.adminlogs.index', compact('logs'));
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
    }
    public function changepass()
    {
        $page = 'Change Password';
        $user = auth()->user();
        return view('admin.changepassword.index', compact('user', 'page'));
    }

    public function updatePassword()
    {
        $user = auth()->user();

        if ($user->password) {
            $this->validate(request(), [
                'old_password' => 'required',
                'password' => 'required|min:6',
                // 'password_confirmation' => 'required|same:password',
                'password_confirmation' => 'same:password',
            ]);

            if (Hash::check(request('old_password'), $user->password)) {
                $user->password = Hash::make(request('password'));
                $user->save();
                return redirect()->route('admin.changepass')->with('message', 'success|Password has been successfully changed.');
            } else {
                $this->validate(request(), [
                    'old_password' => 'confirmed',
                ]);
            }
        } else {
            $this->validate(request(), [
                // 'old_password' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);

            $user->password = Hash::make(request('password'));
            $user->save();
            return redirect()->route('admin.changepass')->with('message', 'success|Password has been successfully changed.');
        }
    }
}
