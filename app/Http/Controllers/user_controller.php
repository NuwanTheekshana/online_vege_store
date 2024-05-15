<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subscribe_tbl;
use Hash;
use Auth;
use DB;
use Mail;

class user_controller extends Controller
{
    public function registeruser(Request $request)
    {
        $this->validate($request, [
            'f_name' => 'required|string|max:50',
            'l_name' => 'required|string|max:50',
            'dob' => 'required|date|max:30',
            'nic' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:30',
            'zip_code' => 'required|string|max:30',
            'email' => 'required|email|max:100|unique:users',
            'contact_no' => 'required|string|max:12',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $userregister = array(
            'F_name' => $request->f_name,
            'L_name' => $request->l_name,
            'DOB' => $request->dob,
            'NIC' => $request->nic,
            'Address' => $request->address,
            'City' => $request->city,
            'ZIP_Code' => $request->zip_code,
            'email' => $request->Email,
            'Contract_No' => $request->contact_no,
            'password' => Hash::make($request->password),
        );

        DB::connection('mysql')->table('users')->insert($userregister);

        return redirect('/');
    }

    public function customer_subscribe(Request $request)
    {
        $email = $request->email;
        $user_id = Auth::user()->id;
        $datetime = date('Y-m-d H:i:s');
        $ipaddress = $_SERVER['REMOTE_ADDR'];

        $this->validate($request, [
            'email' => 'required|email|max:100|unique:users',
        ]);

        $subscribe_data = array(
            'email' => $email,
            'datetime' => $datetime,
            'ipaddress' => $ipaddress,
        );

        subscribe_tbl::insert($subscribe_data);

        $data = array(
            'order_details' => 'subscribe',
        );

        Mail::send('Mail.subscribe_mail', $data,
        function($message)use($data, $email) {
        $message->to($email, 'Online Vege Store')
        ->from('apekama.online@gmail.com' , 'Online Vege Store')
        ->subject('Online Vege Store');
        });

        return redirect()->back()->with('success', 'Thank you for subscribing..!');

    }
}
