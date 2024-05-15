@extends('layouts.app')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
          <h1 class="mb-0 bread">My Cart</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-cart">
          <div class="container">
            <form action="{{route('checkout')}}" method="GET">
              @csrf
              <div class="row">
              <div class="col-md-12 ftco-animate">
                  <div class="cart-list">
                      <table class="table" id="cart_item_table">
                          <thead class="thead-primary">
                            <tr class="text-center">
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Product name</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $value = [];
                            ?>
                            @foreach ($add_to_cart as $item)
                                <tr class="text-center">
                                  <td class="product-remove"><a id="product-remove_btn" onclick="product_remove_btn({{$item->Cart_id}})"><span class="ion-ios-close"></span></a></td>
                                  
                                  <td class="image-prod"><div class="img" style="background-image:url({{$item->Item_image}});"></div></td>
                                  
                                  <td class="product-name">
                                      <h3>{{$item->Item_name}}</h3>
                                      <!-- <p>Far far away, behind the word mountains, far from the countries</p> -->
                                  </td>
                                  
                                  <td class="price">Rs. {{$item->Item_price}} <input type="hidden" name="item_price[]" id="item_price" value="{{$item->Item_price}}"></td>
                                  
                                  <td class="quantity">
                                      <div class="input-group mb-3">
                                        <input type="hidden" name="pro_input_id[]" id="pro_input_id" value="{{$item->Product_id}}">
                                      <input type="text" name="quantity[]" id="cart_qty{{$item->Cart_id}}" onchange="quntity_change('{{$item->Cart_id}}')" class="quantity form-control input-number" value="{{$item->Quntity}}" min="1" max="100">
                                    </div>
                                </td>
                                  
                                  <td class="total">Rs.{{$item->Item_price * $item->Quntity}} <input type="hidden" name="item_total_price[]" id="item_total_price" value="{{$item->Item_price * $item->Quntity}}"></td>
                                </tr><!-- END TR-->

                                <?php 
                                  $value[] = $item->Item_price * $item->Quntity;
                                  

                                ?>

                            @endforeach
                                <?php 
                                $total_value = array_sum($value)+150; 
                                $value_val = array_sum($value);
                                $value = number_format(array_sum($value), 2);
                                
                                ?>
                        
                           
                          </tbody>
                        </table>
                    </div>
              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                
                  <div class="cart-total mb-3">
                      <h3>Coupon Code</h3>
                      <p>Enter your coupon code if you have one</p>
                <div class="form-group">
                    <label for="">Coupon code</label>
                  <input type="text" id="promo_code_input" name="promo_code_input" class="form-control text-left px-3" placeholder="">
                  <i id="promo_validate_error" style="color: red"></i>
                </div>
                  </div>
                  <p><a id="promotion_code_apply_btn" class="btn btn-primary text-white py-3 px-4">Apply Coupon</a></p>
              </div>
             
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div id="cart_summery_div">
                  <div class="cart-total mb-3">
                      <h3>Cart Totals</h3>
                      <p class="d-flex">
                          <span>Subtotal</span>
                          <span id="sub_price">Rs. {{$value}}</span>
                          <input type="hidden" id="sub_total_value" name="sub_total_value" value="{{$value_val}}">
                      </p>
                      <p class="d-flex">
                          <span>Delivery</span>
                          <span>Rs. 150.00 <input type="hidden" name="dilivery_amount" id="dilivery_amount" value="150"></span>
                      </p>
                      <p class="d-flex">
                          <span id="discount_span" style="display: none">Discount</span>
                          <span id="promo_discount"></span>
                          <input type="hidden" name="promo_discount_amount" id="promo_discount_amount">
                      </p>
                      <hr>
                      <p class="d-flex total-price">
                          <span>Total</span>
                          <span id="total_amount">Rs. {{number_format($total_value, 2)}}</span>
                          <input type="hidden" name="total_amount_input" id="total_amount_input" value="{{$total_value}}">
                      </p>
                  </div>

                   
                </div>
                  <button type="submit" class="btn btn-success py-3 px-4" style="background-color: #82ae46"><span class="btn_text_design" style="color: white;">Proceed to Checkout</span></button>
              
                   
                </div>
            </form>
          </div>
          </div>
      </section>

    

@endsection
