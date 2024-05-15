<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product_tbl;
use Auth;
use DB;

class product_controller extends Controller
{
    public function item_add(Request $request)
    {
        $item_name = $request->item_name;
        $item_dept = $request->item_dept;
        $item_qty = $request->item_qty;
        $item_category = $request->item_category;
        $item_qty_type = $request->item_qty_type;
        $unit_price = $request->unit_price;
        $item_image = $request->file('item_image');
        $user_id = Auth::user()->id;
        $datetime = date('Y-m-d H:i:s');
 
        $errors = [
            'item_name.required' => 'Item name is required.',
            'unit_price.required' => 'Unit price is required.',
            'item_qty.required' => 'Item Quantity is required.',
            'item_category.required' => 'Item Category is required.',
            'item_image.dimensions' => 'The category image has invalid image dimensions.',
            'item_image.size' => 'The category image must be max:500 kilobytes.',
            'item_image.image' => 'The category image must be an image.',
            'item_image.mimes' => 'The category image must be a file of type: jpeg, png, jpg, gif, svg.',
          ];
          
          
        $this->validate($request, [
            'item_name' => 'required|string|max:50',
            'unit_price' => 'required|numeric',
            'item_qty' => 'required|numeric',
            'item_category' => 'required|string|max:50',
            'item_image' => 'required|dimensions:max_width=1000,max_height=800|image|mimes:jpeg,png,jpg,gif,svg',
        ],$errors);

        $item_images_val = rand().'.'.$item_image->getClientOriginalExtension();
        $image_filepath = "img/items/"; 
        $image_filepath_org = $image_filepath.$item_images_val;
        $item_image->move(public_path($image_filepath),$item_images_val);

        $data = array(
            'Item_name' => $item_name,
            'Item_dept' => $item_dept,
            'Item_qty' => $item_qty,
            'Item_qty_type' => $item_qty_type,
            'Item_category' => $item_category,
            'Item_price' => $unit_price,
            'item_image' => $image_filepath_org,
            'Admin_user_id' => $user_id,
            'Item_insert_date' => $datetime,
        );
        product_tbl::insert($data);
        
        return redirect()->back()->with('success', 'Product added successfully..!');
    }

    public function update_product_details(Request $request)
    {
        $id = $request->item_id;
        $update_item_name = $request->update_item_name;
        $update_item_category = $request->update_item_category;
        $update_unit_price = $request->update_unit_price;
        $update_unit_quntity = $request->update_unit_quntity;
        $update_item_image = $request->file('update_item_image');



        $errors = [
            'update_item_name.required' => 'Item name is required.',
            'update_item_category.required' => 'Item category is required.',
            'update_unit_price.required' => 'Unit price is required.',
            'item_qty.required' => 'Item Quantity is required.',
            'item_image.dimensions' => 'The category image has invalid image dimensions.',
            'item_image.size' => 'The category image must be max:500 kilobytes.',
            'item_image.image' => 'The category image must be an image.',
            'item_image.mimes' => 'The category image must be a file of type: jpeg, png, jpg, gif, svg.',
          ];
          
          
        $this->validate($request, [
            'update_item_name' => 'required|string|max:50',
            'update_item_category' => 'required|string|max:50',
            'update_unit_price' => 'required|numeric',
            'update_unit_quntity' => 'required|numeric',
            'update_item_image' => 'dimensions:max_width=1000,max_height=800|image|mimes:jpeg,png,jpg,gif,svg',
        ],$errors);

        $update_product = product_tbl::find($id);
        if ($update_item_image != null) {
            $item_images_val = rand().'.'.$update_item_image->getClientOriginalExtension();
            $image_filepath = "img/items/"; 
            $image_path = $image_filepath.$item_images_val;
            $update_item_image->move(public_path($image_filepath),$item_images_val);
        }
        else
        {
            $image_path = $update_product->Item_image;
        }

        $update_product->Item_name = $update_item_name;
        $update_product->Item_category = $update_item_category;
        $update_product->Item_price = $update_unit_price;
        $update_product->Item_qty = $update_unit_quntity;
        $update_product->Item_image = $image_path;
        $update_product->update();
        
        return redirect()->back()->with('success', 'Product update successfully..!');

    }

    public function product_remove(Request $request)
    {
        $id = $request->rem_itm_id;
        $remove_product = product_tbl::find($id);
        $remove_product->Status = 0;
        $remove_product->update();

        return redirect()->back()->with('success', 'Product remove successfully..!');
    }

}
