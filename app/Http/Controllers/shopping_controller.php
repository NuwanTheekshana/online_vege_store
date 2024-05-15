<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shopping_cart_tbl;
use App\Models\product_tbl;
use App\Models\promotion_tbl;
use App\Models\order_tbl;
use App\Models\order_item_tbl;
use App\Models\whishlist_tbl;
use Auth;
use DB;
use Mail;
use PDF;

class shopping_controller extends Controller
{
    public function add_to_cart_count()
    {
        $user_id = Auth::user()->id;
        $add_to_cart_count = shopping_cart_tbl::where('User_id', $user_id)->where('Status', '1')->distinct('Product_id')->count();

        return $add_to_cart_count;
    }

    public function shopping()
    {
        $add_to_cart_count = $this->add_to_cart_count();
        $all_products = product_tbl::where('Status', '1')->get();
        $vege_products = product_tbl::where('Status', '1')->where('Item_category', 'Vegetable')->get();
        $fruit_products = product_tbl::where('Status', '1')->where('Item_category', 'Fruit')->get();

        return view('shopping.shopping')
        ->with('all_products', $all_products)
        ->with('vege_products', $vege_products)
        ->with('fruit_products', $fruit_products)
        ->with('add_to_cart_count', $add_to_cart_count);
    }

    public function whishlist()
    {
        $add_to_cart_count = $this->add_to_cart_count();
        $user_id = Auth::user()->id;
        $whishlist = DB::table('whishlist_tbls')
                        ->select('whishlist_tbls.*', 'product_tbls.*')
                        ->join('product_tbls', 'product_tbls.Product_id', '=', 'whishlist_tbls.product_id')
                        ->where('whishlist_tbls.user_id', $user_id)
                        ->where('whishlist_tbls.remove_status', '0')
                        ->get();

        return view('shopping.whishlist')
        ->with('whishlist', $whishlist)
        ->with('add_to_cart_count', $add_to_cart_count);
    }

    public function online_payment()
    {
        return view('payment.online_payment');
    }

    public function lodding_page()
    {
        return view('payment.lodding_page');
    }

    public function cart()
    {
        $user_id = Auth::user()->id;
        $add_to_cart_count = $this->add_to_cart_count();
        $add_to_cart = DB::table('shopping_cart_tbls')
                        ->select('shopping_cart_tbls.*', 'product_tbls.*')
                        ->join('product_tbls', 'product_tbls.Product_id', '=', 'shopping_cart_tbls.Product_id')
                        ->where('shopping_cart_tbls.User_id', $user_id)
                        ->where('shopping_cart_tbls.Status', '1')
                        ->distinct('shopping_cart_tbls.Product_id')
                        ->get();

        $calculate_total = DB::SELECT('select sum(shopping_cart_tbls.Quntity*product_tbls.Item_price) as total from shopping_cart_tbls,product_tbls WHERE shopping_cart_tbls.Product_id=product_tbls.Product_id and shopping_cart_tbls.Status = 1')[0];


        return view('shopping.cart')
        ->with('add_to_cart_count', $add_to_cart_count)
        ->with('calculate_total', $calculate_total)
        ->with('add_to_cart', $add_to_cart);
    }

    public function checkout(Request $request)
    {
        $add_to_cart_count = $this->add_to_cart_count();
        $price_data = $request->all();
        // dd($price_data);
        return view('shopping.checkout')
        ->with('price_data', $price_data)
        ->with('add_to_cart_count', $add_to_cart_count);
    }

    public function product_details($id)
    {
        $view_product = product_tbl::find($id);
        $related_products = product_tbl::where('Status', '1')->where('Product_id', '!=', $id)->get();

        $add_to_cart_count = $this->add_to_cart_count();

        return view('shopping.product_details')
        ->with('view_product', $view_product)
        ->with('related_products', $related_products)
        ->with('add_to_cart_count', $add_to_cart_count);
    }

    public function add_to_cart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $user_id = Auth::user()->id;
        $datetime = date('Y-m-d H:i:s');
        
        $errors = [
            'quantity.required' => 'Item Quntity is Required.',
          ];
          
        $this->validate($request, [
            'quantity' => 'required|numeric',
        ],$errors);

        $find_cart_id = shopping_cart_tbl::where('User_id', $user_id)->where('Status', '1')->where('Product_id', $id)->value('Cart_id');
        
        if ($find_cart_id) {
            $update_cart = shopping_cart_tbl::find($find_cart_id);
            $get_quntity = $update_cart->Quntity;
            $total_quntity = $get_quntity+$quantity;
            $update_cart->Quntity = $total_quntity;
            $update_cart->update();
        }
        else
        {
            $data = array(
                'User_id' => $user_id,
                'Product_id' => $id,
                'Quntity' => $quantity,
                'date_time' => $datetime,
            );
            shopping_cart_tbl::insert($data);
        }
        
        $cart_count = shopping_cart_tbl::where('User_id', $user_id)->where('Status', '1')->distinct('Product_id')->count();
        
        return response()->json(['success'=>'Item added to your cart..!', 'cart_count' => $cart_count]);
    }

    public function remove_cart_item(Request $request)
    {
        $id = $request->id;
        $user_id = Auth::user()->id;
        $datetime = date('Y-m-d H:i:s');

        $remove_cart_item = shopping_cart_tbl::find($id);
        $remove_cart_item->Status = '0';
        $remove_cart_item->update();

        $cart_count = shopping_cart_tbl::where('User_id', $user_id)->where('Status', '1')->distinct('Product_id')->count();
        
        return response()->json(['success'=>'Item removed from your cart..!', 'cart_count' => $cart_count]);
    }

    public function validate_promotion_code(Request $request)
    {
        $promo_code = $request->promo_code_input;
        $sub_total_value = $request->sub_total_value;
        $dilivery_amount = $request->dilivery_amount;
        $today = date('Y-m-d');

        $get_promo_count = promotion_tbl::where('promo_code', $promo_code)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('Status', '1')->count();
        $get_promo_value = promotion_tbl::where('promo_code', $promo_code)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('Status', '1')->value('promo_discount');

        if ($get_promo_count == 0) 
        {
            return response()->json(['error'=>'Invalid Promotion Code..!']);
        }
        else
        {
            $get_total = $sub_total_value+$dilivery_amount;
            $promotion_value = $get_total*$get_promo_value/100;
            $final_total = $get_total-$promotion_value;

            return response()->json(['final_total'=>$final_total, 'get_promo_value'=>$get_promo_value, 'promotion_value'=>$promotion_value]);
        }

    }

    public function change_cart_itme_quntity(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;

        $update_quntity = shopping_cart_tbl::find($id);
        $update_quntity->Quntity = $qty;
        $update_quntity->update();
        
        return response()->json(['success'=>'Quntity updated..!']);
    }

    public function order_place(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->F_name." ".Auth::user()->L_name;
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $fullname = $request->firstname." ".$request->lastname;
        $streetaddress = $request->streetaddress;
        $city = $request->city;
        $zipcode = $request->zipcode;
        $contact_num = $request->contact_num;
        $email = $request->email;
        $promotion_code = $request->promotion_code;
        $promo_discount_amount = $request->promo_discount_amount;
        $datetime = date('Y-m-d H:i:s');

        // order amount
        $subtotal = $request->subtotal;
        $total_amount_input = $request->total_amount_input;
        $payment_option = $request->payment_option;
        $agree_input = $request->agree_input;
        $dilivery_amount = $request->dilivery_amount;
        

        // order item details
        $item_price = $request->item_price;
        $item_total_price = $request->item_total_price;
        $pro_input_id = $request->pro_input_id;
        $quantity = $request->quantity;

        
        if ($promotion_code == null) 
        {
            $promotion_code = "";
            $promo_discount_amount = "0";
        }
        if ($payment_option == "VISA/MASTER") 
        {
            $order_status = "Initiate";
        }
        elseif ($payment_option == "Cash") 
        {
            $order_status = "Pending";
        }
        
        $errors = [
            'firstname.required' => 'First name is required.',
            'lastname.required' => 'Last name is required.',
            'streetaddress.required' => 'Address is required.',
            'city.required' => 'City is required.',
            'zipcode.required' => 'ZIP code is required.',
            'contact_num.required' => 'Contact number is required.',
            'email.required' => 'Email is required.',
            'subtotal.required' => 'Something wrong. Please try again..!',
            'total_amount_input.required' => 'Something wrong. Please try again..!',
            'payment_option.required' => 'Something wrong. Please try again..!',
            'agree_input.required' => 'Please agree to all the terms and conditions before placing the order..!',
            'dilivery_amount.required' => 'Something wrong. Please try again..!',
          ];
          
        $this->validate($request, [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'streetaddress' => 'required|max:255',
            'city' => 'required|max:50',
            'zipcode' => 'required|max:20',
            'contact_num' => 'required|numeric',
            'email' => 'required|email',
            'subtotal' => 'required',
            'total_amount_input' => 'required',
            'payment_option' => 'required',
            'payment_option' => 'required',
            'dilivery_amount' => 'required',
            'agree_input' => 'required',
        ],$errors);

        $order_data = array(
            'user_id' => $user_id,
            'payment_method' => $payment_option,
            'subtotal_price' => $subtotal,
            'dilivery_fee' => $dilivery_amount,
            'discount' => $promo_discount_amount,
            'total_price' => $total_amount_input,
            'promotion_code' => $promotion_code,
            'customer_name' => $fullname,
            'customer_contact_no' => $contact_num,
            'dilivery_address' => $streetaddress,
            'dilivery_city' => $city,
            'dilivery_zip_code' => $zipcode,
            'order_datetime' => $datetime,
            'order_status' => $order_status,
        );
            order_tbl::insert($order_data);
            $get_last_id = order_tbl::count('Order_id');
            // $next_order_id = $get_last_id +1;

        // order item data insert
        foreach ($pro_input_id as $key => $value) {
            $order_item[] = array(
                'order_id' => $get_last_id,
                'product_id' => $pro_input_id[$key],
                'quntity' => $quantity[$key],
                'unit_price' => $item_price[$key],
                'total_price' => $item_total_price[$key],
                'user_id' => $user_id,
            );

            order_item_tbl::insert($order_item);
        }

        DB::update('update shopping_cart_tbls set Status = 0 where User_id ='.$user_id.' and Status = 1');
       
        $find_order = order_tbl::find($get_last_id);
        $get_order_items = order_item_tbl::where('remove_status', '0')->where('order_id', $get_last_id)->get();
        
        $get_order_items = DB::table('order_item_tbls')
                           ->select('order_item_tbls.*', 'product_tbls.*')
                           ->join('product_tbls', 'product_tbls.Product_id', '=', 'order_item_tbls.product_id')
                           ->where('remove_status', '0')
                           ->where('order_id', $get_last_id)
                           ->get();
        // dd($find_order);

        if ($payment_option == "VISA/MASTER") 
        {
            return view('payment.online_payment')->with('total_amount', $total_amount_input)->with('next_order_id', $get_last_id);
        }
        elseif ($payment_option == "Cash") 
        {
            $data = array(
                'order_no' => $get_last_id,
                'order_details' => $find_order,
                'order_items_data' => $get_order_items,
            );
        
            $pdf = PDF::loadView('pdf.invoice_pdf', $data);
            $pdf->setPaper('A4', 'Portrait');
            // return $pdf->stream();
            $invoice_pdf = 'Vegefoods-'.$get_last_id.".pdf";
            
            $get_user_emails = Auth::user()->email;
            
            Mail::send('Mail.customer_order_mail', $data,
            function($message)use($data, $get_user_emails, $invoice_pdf, $pdf) {
            $message->to($get_user_emails, 'Online Vege Store')
            ->from('apekama.online@gmail.com' , 'Online Vege Store')
            ->subject('Online Vege Store')
            ->attachData($pdf->output(), $invoice_pdf);
            });

            return redirect('lodding_page');
        }

    }

    public function payment_success(Request $request)
    {
        $order_id = $request->order_id;

        $update_payment = order_tbl::find($order_id);
        $update_payment->order_status = "Pending";
        $update_payment->update();

        $find_order = order_tbl::find($order_id);
        $get_order_items = order_item_tbl::where('remove_status', '0')->get();

        $data = array(
            'order_details' => $find_order,
            'order_items_data' => $get_order_items,
        );

        $data = array(
            'order_no' => $order_id,
            'order_details' => $find_order,
            'order_items_data' => $get_order_items,
        );
    
        $pdf = PDF::loadView('pdf.invoice_pdf', $data);
        $pdf->setPaper('A4', 'Portrait');
        // return $pdf->stream();
        $invoice_pdf = 'Vegefoods-'.$order_id.".pdf";
        
        $get_user_emails = Auth::user()->email;
        
        Mail::send('Mail.customer_order_mail', $data,
        function($message)use($data, $get_user_emails, $invoice_pdf, $pdf) {
        $message->to($get_user_emails, 'Online Vege Store')
        ->from('apekama.online@gmail.com' , 'Online Vege Store')
        ->subject('Online Vege Store')
        ->attachData($pdf->output(), $invoice_pdf);
        });

        return redirect('lodding_page');
    }

    public function add_whishlist(Request $request)
    {
        $id = $request->id;
        $user_id = Auth::user()->id;
        $datetime = date('Y-m-d H:i:s');

        $add_whishlist = array(
            'product_id' => $id,
            'user_id' => $user_id,
            'date_time' => $datetime,
        );

        whishlist_tbl::insert($add_whishlist);

        return response()->json(['success'=>'Your whishlist update successfully..!']);
    }
}
