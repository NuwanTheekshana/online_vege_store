<center>
    <img src="{{asset('img/logo.jpg')}}" alt="">
</center>

<h1>Invoice</h1>

    <p style="display: inline;float: left;">
        <b>Company Address</b>
        <br><br>
        Customer Name :{{$order_details->customer_name}}
        <br>
        Delivery to : {{$order_details->dilivery_address}}
        <br>
        City : {{$order_details->dilivery_city}}
        <br>
        ZIP Code : {{$order_details->dilivery_zip_code}}
        <br>
        Contact No : {{$order_details->customer_contact_no}}
    </p>

    <p style="display: inline;float: right;">
        <b>Delivery Address</b>
        <br><br>
        Customer Name :{{$order_details->customer_name}}
        <br>
        Delivery to : {{$order_details->dilivery_address}}
        <br>
        City : {{$order_details->dilivery_city}}
        <br>
        ZIP Code : {{$order_details->dilivery_zip_code}}
        <br>
        Contact No : {{$order_details->customer_contact_no}}
    </p>



    <br>

    <table style="width: 100%;margin-top: 30%;" class="table table-bordered">
        <thead style="background-color: rgb(194, 193, 193);">
        <tr style="line-height: 10px;font-size: 14px;">
            <th  style="text-align: center;">Id</th>
            <th style="text-align: center;">Description</th>
            <th style="text-align: center;">QTY</th>
            <th style="text-align: center;">Unit Price</th>
            <th style="text-align: center;">Total</th>
        </tr>
        </thead>
        <tbody> 
        @for ($i = 0; $i < count($order_items_data); $i++)
        <tr style="font-size: 12px;">
            <td style="text-align: center;width: 10%;border-bottom-color: transparent;">{{ $i }}</td>
            <td style="width: 50%;border-bottom-color: transparent;padding-left: 2px;">{{$order_items_data[$i]->Item_name}}</td>
            <td style="text-align: center;width: 5%;border-bottom-color: transparent;">{{$order_items_data[$i]->quntity}} {{$order_items_data[$i]->Item_qty_type}}</td>
            <td style="text-align: center;width: 15%;border-bottom-color: transparent;">{{$order_items_data[$i]->unit_price}}</td> 
            <td style="text-align: center;width: 20%;text-align: right;border-bottom-color: transparent;padding-right: 2px;">{{$order_items_data[$i]->total_price}}</td>
            </tr>
        
             <tr style="font-size: 12px;">
                <td style="border-bottom-color: transparent;"></td>
                <td style="border-bottom-color: transparent;"></td>
                <td style="border-bottom-color: transparent;"></td>
                <td style="border-bottom-color: transparent;"></td>
            </tr>
        
        @endfor  

        <tr style="font-size: 12px;border-color: white;padding: 20%;">
            <td colspan="4" style="text-align: right;border: white;">SubTotal</td>
            <td style="text-align: center;font-weight: bold;border-color: transparent;text-align: right;padding-right: 2px;">Rs. {{number_format($order_details->subtotal_price, 2)}}</td>
        </tr>

        <tr style="font-size: 12px;border-color: white;padding: 20%;">
            <td colspan="4" style="text-align: right;border: white;">Delivery Fee</td>
            <td style="text-align: center;font-weight: bold;border-color: transparent;text-align: right;padding-right: 2px;">Rs. {{number_format($order_details->dilivery_fee, 2)}}</td>
        </tr>
     
        @if ($order_details->discount != "0.00")
        <tr style="font-size: 12px;border-color: white;padding: 20%;">
            <td colspan="4" style="text-align: right;border: white;">Discount</td>
            <td style="text-align: center;font-weight: bold;border-color: transparent;text-align: right;padding-right: 2px;">Rs. {{number_format($order_details->discount, 2)}}</td>
        </tr>
     
        @endif
      
    
       <tr style="font-size: 12px;">
            <td colspan="4" style="border-color: transparent;text-align: right">Total</td>
            <td style="text-align: center;font-weight: bold;border-color: transparent;border-bottom-style: double;text-align: right;padding-right: 2px;"><u style="text-decoration-line: underline;text-decoration-style: dotted;">Rs. {{number_format($order_details->total_price, 2)}}</u></td>
        </tr>
     
        </tbody>
       
    </table>
