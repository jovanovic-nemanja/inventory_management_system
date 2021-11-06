<?php

namespace App\Http\Controllers\Admin;

use App\Emails;
use App\EmailTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmailsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Emails::all();

        return view('admin.emails.index', compact('emails'));
    }
    public function template()
    {
        $alltemplate = EmailTemplates::get();
        return view('admin.emails.template', compact('alltemplate'));
    }
    public function template_view($id)
    {
        $template = EmailTemplates::where('id',$id)->first();
        return view('admin.emails.template_view', compact('template'));
    }
    public function template_create()
    {
        $alltemplate = EmailTemplates::where('status',1)->get();
        return view('admin.emails.template_create', compact('alltemplate'));
    }
    public function template_store(Request $request)
    {
        $category = EmailTemplates::create([
            'email_name' => $request->email_name,
            'email_subject' => $request->email_subject,
            'email_body' => $request->email_body,
            'header_image' => '',
        ]);

        $alltemplate = EmailTemplates::where('status',1)->get();

        return view('admin.emails.template', compact('alltemplate'));
    }

    public function template_edit($id)
    {
        $template = EmailTemplates::where('id',$id)->first();
        return view('admin.emails.template_edit', compact('template'));
    }
    public function template_update(Request $request)
    {
        $template = EmailTemplates::where('id',$request->template_id)->first();
        // $template-> email_name = $request->email_name;
        $template-> email_subject = $request->email_subject;
        $template-> email_body = $request->email_body;
        $template->update();
        return redirect()->route('template.index')->with('flash', 'Email template has successfully updated');
    }
    public function template_delete($id)
    {
        $template = EmailTemplates::where('id',$id)->first();
        $template->delete();
        return redirect()->route('template.index')->with('flash', 'Email template has successfully deleted');
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
}
