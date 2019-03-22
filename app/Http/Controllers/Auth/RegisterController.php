<?php

namespace FlowCp\Http\Controllers\Auth;

use FlowCp\LoginHelper;
use FlowCp\User;
use FlowCp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Where to redirect users after registration.
     *
     * @return void
     */
    protected function redirectTo() {
        session()->flash('success_message', __('auth.reg_success'));
        return '/home';
    }

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
            'userid' => ['required', 'string', 'max:23', 'unique:login'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:login'],
            'user_pass' => ['required', 'string', 'min:' . intval(config('flow.password_min_length')), 'max:23','confirmed'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'in:M,F'],
            'agree' => ['accepted']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \FlowCp\User
     */
    protected function create(array $data)
    {
        Cache::forget('account_count');

        return User::create([
            'userid' => $data['userid'],
            'email' => $data['email'],
            'user_pass' => LoginHelper::create()->hash($data['user_pass']),
            'birthdate' => $data['birthdate'],
            'sex' => $data['gender']
        ]);
    }
}
