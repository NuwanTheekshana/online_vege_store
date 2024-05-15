<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'f_name' => ['required', 'string', 'max:50'],
            'l_name' => ['required', 'string', 'max:50'],
            'dob' => ['required', 'date', 'max:30'],
            'nic' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:30'],
            'zip_code' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'contact_no' => ['required', 'string', 'max:12'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'F_name' => $data['f_name'],
            'L_name' => $data['l_name'],
            'DOB' => $data['dob'],
            'NIC' => $data['nic'],
            'Address' => $data['address'],
            'City' => $data['city'],
            'ZIP_Code' => $data['zip_code'],
            'email' => $data['email'],
            'Contract_No' => $data['contact_no'],
            'password' => Hash::make($data['password']),
            'user_type' => 'Customer',
        ]);
    }
}
