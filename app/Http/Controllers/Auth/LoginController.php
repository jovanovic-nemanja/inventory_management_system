<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\RoleUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/inventoryboard';

    /**
      * Redirect the user to the Google authentication page.
      *
      * @return \Illuminate\Http\Response
      */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
      * Redirect the user to the Google authentication page.
      *
      * @return \Illuminate\Http\Response
      */
    public function redirectToProvidergoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleFacebookCallback()

    {

        try {

            $user = Socialite::driver('facebook')->user();

            $create['name'] = $user->getName();

            $create['email'] = $user->getEmail();

            $create['facebook_id'] = $user->getId();

            $createdUser = User::where('email', $create['email'])->first();
            if(empty($createdUser)){
            $userModel = new User;

            $createdUser = $userModel->addNew($create);
            }else{
            $createdUser->facebook_id = $create['facebook_id'];
            $createdUser->update();
            }
            Auth::loginUsingId($createdUser->id);


            return redirect()->to('/');


        } catch (Exception $e) {


            return redirect('login');


        }

    }

    public function redirectToFacebook()

    {

        return Socialite::driver('facebook')->redirect();

    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return redirect('auth/github');
        }
$main_categorys = Category::where('parent', 0)->get();
        $sub_categorys = Category::whereRaw("parent != 0")->get();
        // check if they're an existing user
        $existingUser = User::where('github_id', $user->id)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $role = Session::get('role');
            if (@$role) {
                $newUser                  = new User;
                $newUser->name            = $user->name;
                $newUser->email           = $user->email;
                $newUser->sign_date           = date('Y-m-d');
                $newUser->github_id       = $user->id;
                $newUser->save();

                if ($role == "buyer") { //Buyer case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 3,
                    ]);
                }if ($role == "seller") { //Seller case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 2,
                    ]);
                }

                auth()->login($newUser, true);
            }else{
                $msg = "We have not this github account!";
                return view('auth/login', compact('msg'));
            }
        }

        return redirect()->to('/');
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackgoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            // $role = Session::get('role');
            $role = "buyer";
            if (@$role) {
                $newUser                  = new User;
                $newUser->name            = $user->name;
                $newUser->email           = $user->email;
                $newUser->sign_date       = date('Y-m-d');
                $newUser->google_id       = $user->id;
                $newUser->save();

                if ($role == "buyer") { //Buyer case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 3,
                    ]);
                }if ($role == "seller") { //Seller case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 2,
                    ]);
                }

                auth()->login($newUser, true);
            }else{
                $msg = "We have not this google account!";
                return view('auth/login', compact('msg'));
            }
        }
        return redirect()->to('/');
    }

    public function redirectTo(){
        // User role
        // dd(auth()->user()->email);
        if (auth()->user()->email == 'admin@inventoryboard.com') {
            return '/inventoryboard';
        }

        else if(auth()->user()->hasRole('seller')) {
            return '/sellerdashboard';
        }
        else if (auth()->user()->hasRole('buyer')) {
            return '/buyerdashboard';
        }
        
        else if (auth()->user()->hasRole('admin')) {
            return '/admin';
        }
        else if (auth()->user()->hasRole('manager')) {
            return '/manager';
        }
    }




    public function redirectToLinkedin()

    {

        return Socialite::driver('linkedin')->redirect();
        // return Socialite::driver('linkedin')->scopes(['r_liteprofile', 'r_emailaddress'])->redirect();
    }


    public function handleLinkedinCallback()

    {

        try {

            $user = Socialite::driver('linkedin')->user();

        } catch (Exception $e) {
            $msg = "We have not this linkedin account!";
            return redirect('/login');

        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            // $role = Session::get('role');
            $role = "buyer";
            if (@$role) {
                $newUser                  = new User;
                $newUser->name            = $user->name;
                $newUser->email           = $user->email;
                $newUser->sign_date       = date('Y-m-d');
                $newUser->linkedin_id       = $user->id;
                $newUser->save();

                if ($role == "buyer") { //Buyer case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 3,
                    ]);
                }if ($role == "seller") { //Seller case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 2,
                    ]);
                }

                auth()->login($newUser, true);
            }else{
                $msg = "We have not this linkedin account!";
                return view('auth/login', compact('msg'));
            }
        }
        return redirect()->to('/');




    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
}
