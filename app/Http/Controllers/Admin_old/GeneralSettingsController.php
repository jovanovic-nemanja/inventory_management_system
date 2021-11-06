<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GeneralSetting;

class GeneralSettingsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }

    public function index() {
    	return view('admin.general.index');
    }

    public function update(GeneralSetting $generalsetting) {
    	try {

	        $this->validate(request(), [
	            'site_name' => 'required',
                'meta_title' => 'required',
                'meta_keywords' => 'required',
                'meta_description' => 'required',
	        ]);

	    	$generalsetting->site_name = request('site_name');
	    	$generalsetting->site_title = request('site_title');
            $generalsetting->meta_title = request('meta_title');
            $generalsetting->meta_keywords = request('meta_keywords');
            $generalsetting->meta_description = request('meta_description');
	    	$generalsetting->site_subtitle = request('site_subtitle');
            $generalsetting->site_desc = request('site_desc');
	    	$generalsetting->site_footer = request('site_footer');
	    	$generalsetting->save();   		
    	} catch (Exception $e) {
    		echo $e->getMessage();
    	}

    	return back()->with('flash', 'Setting has been successfully updated');
    }
}
