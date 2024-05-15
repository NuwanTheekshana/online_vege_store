@extends('layouts.app')

@section('content')


    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Wishlist</span></p>
        <h1 class="mb-0 bread">My Wishlist</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                          <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>Product List</th>
                            <th>&nbsp;</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @for ($i = 0; $i < count($whishlist); $i++)
                          <tr class="text-center">
                            <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
                            
                            <td class="image-prod"><div class="img" style="background-image:url({{$whishlist[$i]->Item_image}});"></div></td>
                            
                            <td class="product-name">
                                <h3>{{$whishlist[$i]->Item_name}}</h3>
                                <p>{{$whishlist[$i]->Item_dept}}</p>
                            </td>
                            
                            <td class="price">Rs. {{number_format($whishlist[$i]->Item_price, 2)}}</td>
                            
                            <td class="quantity">
                                <div class="input-group mb-3">
                                 <input type="text" name="quantity" class="quantity form-control input-number" value="{{$whishlist[$i]->quntity}}" min="1" max="500">
                              </div>
                          </td>
                          <?php 
                              $value = $whishlist[$i]->Item_price * $whishlist[$i]->quntity;
                          ?>
                            <td class="total">Rs. {{number_format($value, 2)}}</td>
                          </tr><!-- END TR-->
                          @endfor
                        </tbody>
                      </table>
                  </div>
            </div>
        </div>
        </div>
    </section>


@endsection
