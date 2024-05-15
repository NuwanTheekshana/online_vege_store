
@extends('layouts.app')

@section('content')


  <section class="ftco-section">
    <div class="container">
      <form action="{{route('order_place')}}" method="POST">
        @csrf
      <div class="row justify-content-center">
        <div class="col-xl-7 ftco-animate">
                      <form action="#" class="billing-form">
                          <h3 class="mb-4 billing-heading">Billing Details</h3>
                <div class="row align-items-end">
                    <div class="col-md-6">
                  <div class="form-group">
                      <label for="firstname">Firt Name</label>
                    <input type="text" class="form-control" name="firstname" value="{{ Auth::user()->F_name }}" placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" name="lastname" value="{{ Auth::user()->L_name }}" placeholder="">
                  </div>
              </div>
              <div class="w-100"></div>
                 
                  <div class="w-100"></div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="streetaddress">Street Address</label>
                      <input type="text" class="form-control" name="streetaddress" value="{{ Auth::user()->Address }}" placeholder="House number and street name">
                    </div>
                  </div>
                  <div class="w-100"></div>
                  <div class="col-md-6">
                      <div class="form-group">
                      <label for="towncity">Town / City</label>
                    <input type="text" class="form-control" name="city" value="{{ Auth::user()->City }}" placeholder="">
                  </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="postcodezip">Postcode / ZIP *</label>
                          <input type="text" class="form-control" name="zipcode" value="{{ Auth::user()->ZIP_Code }}" placeholder="">
                  </div>
                  </div>
                  <div class="w-100"></div>
                  <div class="col-md-6">
                  <div class="form-group">
                      <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="contact_num" value="{{ Auth::user()->Contract_No }}" placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="emailaddress">Email Address</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="">
                  </div>
              </div>
              <div class="w-100"></div>
              
              </div>
            </form><!-- END -->
                  </div>
                  <div class="col-xl-5">
            <div class="row mt-5 pt-3">
                <div class="col-md-12 d-flex mb-5">
                    <div class="cart-detail cart-total p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Cart Total</h3>
                        <p class="d-flex">
                                  <span>Subtotal</span>
                                  <span>Rs. {{number_format($price_data['sub_total_value'], 2)}}</span>
                                  <input type="hidden" name="subtotal" id="subtotal" value="{{$price_data['sub_total_value']}}">
                              </p>
                              <p class="d-flex">
                                  <span>Delivery</span>
                                  <span>Rs. {{number_format($price_data['dilivery_amount'], 2)}}</span>
                                  <input type="hidden" name="dilivery_amount" id="dilivery_amount" value="{{$price_data['dilivery_amount']}}">
                              </p>

                              @if ($price_data['promo_discount_amount'] != 0)
                              <p class="d-flex">
                                <span>Discount</span>
                                <span>Rs. {{number_format($price_data['promo_discount_amount'], 2)}}</span>
                              </p>
                              @endif

                              <input type="hidden" name="promo_discount_amount" id="promo_discount_amount" value="{{$price_data['promo_discount_amount']}}">
                              <input type="hidden" name="promotion_code" id="promotion_code" value="{{$price_data['promo_code_input']}}">
                              <hr>
                              <p class="d-flex total-price">
                                  <span>Total</span>
                                  <span>Rs. {{number_format($price_data['total_amount_input'], 2)}}</span>
                                  <input type="hidden" name="total_amount_input" id="total_amount_input" value="{{$price_data['total_amount_input']}}">
                              </p>
                              </div>
                </div>
                <div class="col-md-12">
                    <div class="cart-detail p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Payment Method</h3>
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <div class="radio">
                                             <label><input type="radio" name="payment_option" value="VISA/MASTER" class="mr-2"> Visa / Master</label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <div class="radio">
                                             <label><input type="radio" name="payment_option" value="Cash" class="mr-2"> Cash on Delivery</label>
                                          </div>
                                      </div>
                                  </div>
                                
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <div class="checkbox">
                                             <label><input type="checkbox" name="agree_input" value="true" class="mr-2"> I have read and accept the terms and conditions</label>
                                          </div>
                                      </div>
                                  </div>

                                                                
                                    {{-- items data --}}

                                    @foreach ($price_data['pro_input_id'] as $item_list => $value)
                                    <input type="hidden" name="item_price[]" value="{{$price_data['item_price'][$item_list]}}">
                                    <input type="hidden" name="item_total_price[]" value="{{$price_data['item_total_price'][$item_list]}}">
                                    <input type="hidden" name="pro_input_id[]" value="{{$price_data['pro_input_id'][$item_list]}}">
                                    <input type="hidden" name="quantity[]" value="{{$price_data['quantity'][$item_list]}}">
                                    @endforeach


                                  <p><button type="submit" class="btn btn-primary py-3 px-4" >Place an order</button></p>
                              </div>
                </div>
            </div>
        </div> <!-- .col-md-8 -->
      </div>



        </form>
    </div>
  </section> <!-- .section -->

      <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
      <div class="row d-flex justify-content-center py-5">
        <div class="col-md-6">
            <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
            <span>Get e-mail updates about our latest shops and special offers</span>
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <form action="#" class="subscribe-form">
            <div class="form-group d-flex">
              <input type="text" class="form-control" placeholder="Enter email address">
              <input type="submit" value="Subscribe" class="submit px-3">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  @endsection