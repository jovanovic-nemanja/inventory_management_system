<?php

namespace App\Http\Controllers\Frontend;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Profile';
        $user = auth()->user();
        $userid = auth()->id();
        $currencies = Currency::all();

//        $marks = User::getMarks($userid);
        $userDetail = User::where('id', $userid)->first();
        return view('frontend.account', compact('userDetail', 'currencies', 'page'));
    }

    /**
     * Display My reviews page.
     *
     * @return \Illuminate\Http\Response
     */
    public function myreviews()
    {
        $user = auth()->user();
        $userid = auth()->id();
        $marks = User::getMarks($userid);

        $reviews = DB::table('reviews')
            ->Join('purchase_orders', 'purchase_orders.id', '=', 'reviews.purchase_id')
            ->Join('quotes', 'quotes.id', '=', 'purchase_orders.request_id')
            ->Join('requests', 'quotes.request_id', '=', 'requests.id')
            ->Join('users', 'users.id', '=', 'reviews.putter')
            ->where('purchase_orders.payment_status', '=', 3)
            ->where('quotes.status', 2)
            ->where('reviews.receiver', $userid)
            ->whereNull('quotes.deleted_at')
            ->select('quotes.product_name as product_name', 'reviews.sign_date', 'quotes.total_price', 'reviews.mark', 'reviews.description', 'users.name')
            ->get();

        return view('frontend.myreviews', compact('user', 'marks', 'reviews'));
    }

    /**
     * Display a Change password page.
     *
     * @return \Illuminate\Http\Response
     */
    public function changepass()
    {
        $page = 'Change Password';
        $user = auth()->user();
        return view('frontend.changepass', compact('user', 'page'));
    }

    /**
     * Update Account
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (!empty(request('company_function'))) {
            $company_function = implode(",", (request('company_function')));
        } else {
            $company_function = '';
        }
        if (@$request->company_license) {
            $request->validate([
                'company_license' => 'required|mimes:jpg,jpeg,png,pdf,doc,txt,docx,xlx,csv|max:2048',
            ]);
            $company_license = 'company_license_' . auth()->id() . '.' . $request->company_license->extension();
            $request->company_license->move(public_path('uploads/company_license'), $company_license);
        } else {
            $company_license = '';
        }

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = auth()->user();
        $user->name = request('name');
        $user->company_name = request('company_name');
        $user->email = request('email');
        $user->phone_number = request('phone_number');
        $user->company_address = request('company_address');
        $user->country = request('country');
        $user->year_of_establishment = request('year_of_established');
        $user->company_function = $company_function;
        $user->currency = request('currency');
        $user->company_about = request('company_about');
        $user->company_license = $company_license;

        Image::upload_logo_img($user->id);

        $user->save();

        return redirect()->route('account')->with('message', 'success|Account has been successfully updated.');
    }

    /**
     * Change password
     *
     * @return \Illuminate\Http\Response
     */
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
                return redirect()->route('changepass')->with('message', 'success|Password has been successfully changed.');
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
            return redirect()->route('changepass')->with('message', 'success|Password has been successfully changed.');
        }
    }

}