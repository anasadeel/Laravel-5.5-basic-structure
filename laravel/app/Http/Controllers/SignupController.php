<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\Address;
use App\Functions\Functions;
use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

//use Illuminate\Contracts\Auth\Registrar;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Intervention\Image\Facades\Image as Image;

class SignupController extends Controller {

    // use AuthenticatesAndRegistersUsers;
    use AuthenticatesUsers;

    protected $loginPath = 'login';

    //public $mailchimp;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
        //$this->registrar = $registrar;
        //$this->listId = env('MAILCHIMP_LIST_ID');
        $this->middleware('guest', ['except' => 'success']);
        // $this->mailchimp = $mailchimp;
    }

    public function login() {
        return view('front.users.login');
    }

    public function register() {
        return view('front.users.register');
    }

    public function forgot_password() {
        return view('front.users.forgot');
    }

    public function postLogin(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (count($user) > 0) {
            if ($user->isConfirmed != 1) {
                Session::flash('danger', "You haven't activated your account yet!.");
                return redirect('login')->withInput();
            }
        }

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            // session_destroy();
            $role = Auth::user()->role_id;
            if ($role == 1) { //'admin'
                return redirect('admin');
            }
            if ($role == 3) { //non-paid
                return redirect('select-subscription');
            }
            return redirect()->intended('dashboard');
        }

        return redirect($this->loginPath)
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'email' => $this->sendFailedLoginResponse($request),
        ]);
    }

    public function store(Request $request) {

        $validation = array(
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|confirmed|min:6'
        );
        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        DB::beginTransaction();

        try {
            $confirmation_code = str_random(30);

            $user = new User();
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->role_id = 2;
            $user->password = bcrypt($request->password);
            $user->key = $confirmation_code;
            $user->save();

            Address::create(['user_id' => $user->id]);
            //Email sent to verify email address
            $subject = view('emails.confirm_email.subject');
            $body = view('emails.confirm_email.body', compact('confirmation_code'));
            Functions::sendEmail($request->email, $subject, $body);
            DB::commit();
            Session::flash('success', 'Thanks for signing up! Please check your email to activate your account.');
            return redirect()->back();
        } catch (Exception $ex) {
            DB::rollBack();
            $validator->errors()->add('error_db', 'Somthing went wrong try again');
            return redirect()->back();
        }
    }

    public function confirmEmail($confirmation_code) {
        if (!$confirmation_code) {
            return 'Error! Confirmation Key missing.';
        }
        $user = User::where('key', $confirmation_code)->first();
        if (!$user) {
            return 'Error! Confirmation Key missing.';
        }
        $user->isConfirmed = 1;
        $user->save();

//        //When new user confirmed registeration
//        $subjectRegister = view('emails.user_register.subject');
//        $bodyRegister = view('emails.user_register.body', compact('categories'));
//        Functions::sendEmail($user->email, $subjectRegister, $bodyRegister);

        return redirect('register/success/' . $user->id);
    }

    public function success($id) {
        $this->middleware('auth');
        $user = User::findOrFail($id);
        $data['user'] = $user;
        return view('front.users.register_success', $data);
    }

}
