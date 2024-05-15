<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_user_tbl;
use App\Models\product_tbl;
use App\Models\promotion_tbl;
use App\Models\order_tbl;
use Hash;
use Auth;

class admin_controller extends Controller
{
    public function admin_login()
    {
        return view('admin.auth.login');
    }

    public function admin_register()
    {
        return view('admin.auth.admin_register');
    }

    public function admin_user_register(Request $request)
    {
        $f_name = $request->f_name;
        $l_name = $request->l_name;
        $nic = $request->nic;
        $email = $request->email;
        $contact_no = $request->contact_no;
        $password = $request->password;
        $permission = $request->permission;

        $this->validate($request, [
            'f_name' => 'required|string|max:50',
            'l_name' => 'required|string|max:50',
            'nic' => 'required|string|max:30',
            'contact_no' => 'required|string|max:12',
            'email' => 'required|email|unique:admin_user_tbls',
            'permission' => 'required|string|max:30',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin_user = array(
            'F_name' => $f_name,
            'L_name' => $f_name,
            'NIC' => $nic,
            'email' => $email,
            'Contract_No' => $contact_no,
            'Permission' => $permission,
            'password' => Hash::make($password),
        );

        admin_user_tbl::insert($admin_user);

        return redirect('/admin/login');
    }

    public function adminhome()
    {
        $pending_order_count = order_tbl::where('order_status', 'Pending')->where('remove_status', '0')->count();
        $reject_order = order_tbl::where('order_status', 'Reject')->where('remove_status', '0')->count();
        $complete_order = order_tbl::where('order_status', 'Complete')->where('remove_status', '0')->count();
        
        $count = array(
            'pending_order_count'=>$pending_order_count,
            'reject_order'=>$reject_order,
            'complete_order'=>$complete_order,
        );
        return view('admin.adminhome')->with('count', $count);
    }

    public function admin_login_user(Request $request)
    {
        $data = $request->only('email', 'password');
        
        // auth check user details. if include same issues
        if (Auth::attempt($data)) {
            return redirect('/admin/adminhome');
        }

       return redirect()->back()->withInput($request->email);
    }

    public function admin_add_product()
    {
        return view('admin.product.add_product');
    }

    public function admin_find_product()
    {
        $product = product_tbl::where('Status', '1')->get();
        return view('admin.product.find_product')->with('product', $product);
    }

    public function add_promotion()
    {
        $date = date('Y-m-d H:i:s');
        $get_promo_data = promotion_tbl::where('Status', '1')->where('end_date', '>=', $date)->get();
        return view('admin.options.add_promotions')->with('get_promo_data', $get_promo_data);
    }

    public function promo_add(Request $request)
    {
        $promo_name = $request->promo_name;
        $promo_dept = $request->promo_dept;
        $promo_disc = $request->promo_disc;
        $promo_type = $request->promo_type;
        $start_date = $request->promo_start_date;
        $end_date = $request->promo_end_date;
        $promo_code =  substr(md5(mt_rand()), 0, 7);
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->F_name." ".Auth::user()->L_name;


        $this->validate($request, [
            'promo_name' => 'required|string|max:50',
            'promo_dept' => 'required|string',
            'promo_disc' => 'required|string|max:50',
            'promo_type' => 'required|string|max:30',
            'promo_start_date' => 'required|date|max:30',
            'promo_end_date' => 'required|date|max:30',
        ]);

        $admin_user = array(
            'promo_code' => $promo_code,
            'promo_name' => $promo_name,
            'promo_description' => $promo_dept,
            'promo_discount' => $promo_disc,
            'promo_type' => $promo_type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'promo_added_user_id' => $user_id,
            'promo_added_user_name' => $user_name,
        );

        promotion_tbl::insert($admin_user);

        return redirect()->back()->with('success', 'Promotion added successfully..!');
    }

    public function update_promotion_details(Request $request)
    {
        $promo_id = $request->promo_id;
        $promo_name = $request->update_promo_name;
        $promo_dept = $request->update_promo_discription;
        $promo_disc = $request->update_promo_discount;
        $promo_type = $request->update_promo_type;
        $start_date = $request->update_promo_start_date;
        $end_date = $request->update_promo_end_date;
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->F_name." ".Auth::user()->L_name;


        $this->validate($request, [
            'update_promo_name' => 'required|string|max:50',
            'update_promo_discription' => 'required|string',
            'update_promo_discount' => 'required|string|max:50',
            'update_promo_type' => 'required|string|max:30',
            'update_promo_start_date' => 'required|date|max:30',
            'update_promo_end_date' => 'required|date|max:30',
        ]);

        $update_promo = promotion_tbl::find($promo_id);
        $update_promo->promo_name = $promo_name;
        $update_promo->promo_description = $promo_dept;
        $update_promo->promo_discount = $promo_disc;
        $update_promo->promo_type = $promo_type;
        $update_promo->start_date = $start_date;
        $update_promo->end_date = $end_date;
        $update_promo->update();

        return redirect()->back()->with('success', 'Promotion added successfully..!');
  
    }

    public function pending_orders()
    {
        $pending_orders = order_tbl::where('order_status', 'Pending')->where('remove_status', '0')->get();

        return view('admin.order.pending_order')->with('pending_orders', $pending_orders);
    }

    public function compete_order_update(Request $request)
    {
        $id = $request->id;
        $complete_remark = $request->complete_remark;

        $update_order = order_tbl::find($id);
        $update_order->admin_remark = $complete_remark;
        $update_order->order_status = "Complete";
        $update_order->update();

        return response()->json(['success'=>'Request order completed..!']);
    }

    public function reject_order_update(Request $request)
    {
        $id = $request->id;
        $reject_remark = $request->reject_remark;

        $update_order = order_tbl::find($id);
        $update_order->admin_remark = $reject_remark;
        $update_order->order_status = "Reject";
        $update_order->update();

        return response()->json(['success'=>'Request order rejected..!']);
    }

    
}
