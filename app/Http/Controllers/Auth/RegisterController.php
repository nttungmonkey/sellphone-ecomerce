<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Account;
use App\Role;
use App\Http\Controllers\Controller;
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {

        return '/'; // return dynamicaly generated URL.
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
        $message = array(
            'acc_user_register.required' => 'Please enter a username',
            'acc_user_register.unique' => 'Username has already been taken',
            'acc_user_register.min' => 'Username has at least 6 characters',
            'acc_user_register.max' => 'Username has up to 255 character',
            'acc_password_register.min' => 'Password has at least 6 characters',
            'acc_user_register.max' => 'Password has up to 255 characters',
            'same' => 'The password and confirm password must match.',

        );

        $validator =  Validator::make($data, [
            'acc_user_register' => ['required', 'string', 'max:255', 'min:6', 'unique:account,acc_user'],
            'acc_password_register' => ['required', 'string', 'min:6', 'required_with:acc_password_register_confirmation', 'same:acc_password_register_confirmation'],
            'acc_password_register_confirmation' => ['required', 'min:6'],
        ], $message);

        $validator->setAttributeNames([
            'acc_user_register' => 'acc_user',
            'acc_password_register' => 'acc_password',
        ]);

        return $validator;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $account =  Account::create([
            'acc_user' => $data['acc_user_register'],
            'acc_password' => bcrypt($data['acc_password_register']),          
        ]);

        return $account;
    }
}
