<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;
use App\RoleUser;
use App\User;
use App\VerifyEmailcodes;
use App\EmailTemplates;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        echo 'done'; exit;
        if (!@$data['role']) {
            return false;
        } else {
            if ($data['role'] == 'seller') { //seller
                $role = 2;
            } else if ($data['role'] == 'buyer') { //buyer
                $role = 3;
            } else {

            }

            $verify = VerifyEmailcodes::where('email', $data['email'])->first();

            $data['password'] = $verify->password;

            $verify->status = 0;
            $verify->update();
            DB::beginTransaction();

            try {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'country' => $data['country'],
                    'block' => 0,
                    'verified' => 1,
                    'password' => Hash::make($data['password']),
                    'phone_number' => @$data['phone_number'],
                    'sign_date' => date('Y-m-d h:i:s'),
                ]);

                RoleUser::create([
                    'user_id' => $user->id,
                    'role_id' => $role,
                ]);
                DB::commit();

                $controller = new EmailsController;
                $array = [];

                $array['username'] = $data['name'];
                $array['receiver_address'] = $data['email'];
                $host = request()->getHost();
                $email_template =EmailTemplates:: where('email_type','welcome_email')->first();
                if ($role == 2) { //seller
                    $body = "https://" . $host . "/create";
                    $account_type = 'Seller';
                }if ($role == 3) { //buyer
                    $body = "https://" . $host . "/product";
                    $account_type = 'Buyer';
                }

                $array['data'] = array('name' => $array['username'], "body_detail" => $email_template->email_body,"body" => $body);
                $array['subject'] = $email_template->email_subject;

                $controller->welcome($array);

                $arrayAdmin['username'] = 'Admin';
                // $arrayAdmin['receiver_address'] = 'sales@mambodubai.com';
                $arrayAdmin['receiver_address'] = ['sales@mambodubai.com', 'sumanta@codeulas.com'];
                $arrayAdmin['data'] = array('account_type' => $account_type, 'username' => $data['name'], "body" => 'New user sign up');
                $arrayAdmin['subject'] = "New " . $account_type . " registerd in MamboDubai";
                $controller->welcomeAdmin($arrayAdmin);

                $useremail = $data['email'];
                return $user;
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }

    public function validatecode($role, $verify_codes)
    {

        $validate = VerifyEmailcodes::where('verify_code', $verify_codes)->first();

        $data['name'] = $validate['name'];
        $data['phone_number'] = $validate['phone'];
        $data['role'] = $role;
        $data['email'] = $validate['email'];
        $data['country'] = $validate['country'];

        if (@$validate) {
            if ($validate->verify_code == $verify_codes) {
                if ($validate->status == 1) {

                    $user = $this->create($data);
                    $useremail = $user->email;
                    preg_match('/^.?(.*)?.@.+$/', $useremail, $matches);
                    $useremail = str_replace($matches[1], str_repeat('*', strlen($matches[1])), $useremail);

                    return view('frontend.registerverify', compact('useremail'));
                } else {
                    return redirect()->route('login');
                }
            } else {
                $msg = "Verify codes is failed. ";
                $id = '';
                return view('auth.confirmverifycode', compact('useremail', 'role', 'id', 'msg'));
            }
        } else {
            return redirect()->route('login');

        }
    }

    public function sellerregister()
    {
        return view('auth.sellerregister');
    }

    public function emailverify()
    {
        Session::put('role', 'buyer');
        $role = "buyer";
        $email = '';
        return view('auth.emailverify', compact('role', 'email'));
    }

    public function emailverifyseller()
    {
        Session::put('role', 'seller');
        $role = "seller";
        $email = '';
        return view('auth.emailverify', compact('role', 'email'));
    }

    public function emailverifyforresend($email, $role)
    {
        $role = $role;

        return view('auth.emailverify', compact('role', 'email'));
    }

}
