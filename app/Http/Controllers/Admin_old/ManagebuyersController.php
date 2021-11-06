<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Verify;
use App\Adminlogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagebuyersController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'manager']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = User::all();
        return view('admin.managebuyers.index', compact('categories'));
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
     * Display the verify page resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
        return view('admin.managebuyers.verify', compact('id'));
    }

    /**
     * verify status change : From Not verified to Verified
     * @param $request
     * @since 2020-12-14
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function submitVerify(Request $request)
    {
        $this->validate(request(), [
            'document' => 'required',
            'comment' => 'required',
            'userid' => 'required'
        ]);

        $user = User::where('id', $request->userid)->first();
        if (@$user) {
            $user->verified = 2;
            if ($user->update()) {
                $verify = Verify::create([
                    'document' => $request->document,
                    'comment' => $request->comment,
                    'userid' => $request->userid,
                    'sign_date' => date('Y-m-d h:i:s')
                ]);

                Verify::upload_document($verify->id);
            }
        }

        return redirect()->route('managebuyers.index');
    }

    /**
     * Remove the verified data and change the status from verified to not verified.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notverify($id)
    {
        $seller = User::where('id', $id)->first();
        if (@$seller) {
            $seller->verified = 1;
            if($seller->update()) {
                Verify::where('userid', $seller->id)->delete();
            }
        }

        return redirect()->route('managebuyers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $records = User::where('id', $id)->get();
            if (@$records) {
                $records[0]['block'] = 0;
                $records[0]->update();

                $data = [];
                $data['title'] = 'Un-Blocked';
                $data['description'] = 'Buyer Name: '.$records[0]['name'];
                $add_logs = Adminlogs::Addlog($data);

                return redirect()->route('managebuyers.index')->with('flash', 'Buyer has been successfully changed the status.');
            }
        }else{
            return redirect()->route('managesellers.index');
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $records = User::where('id', $id)->get();
            if (@$records) {
                $records[0]['block'] = 1;
                $records[0]->update();

                $data = [];
                $data['title'] = 'Blocked';
                $data['description'] = 'Buyer Name: '.$records[0]['name'];
                $add_logs = Adminlogs::Addlog($data);

                return redirect()->route('managebuyers.index')->with('flash', 'Buyer has been successfully changed the status.');
            }
        }else{
            return redirect()->route('managesellers.index');
        } 
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
}
