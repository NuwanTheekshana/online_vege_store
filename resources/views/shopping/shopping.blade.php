@extends('layouts.app')

@section('content')


<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
          <h1 class="mb-0 bread">Products</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-10 mb-5 text-center">
                  <ul class="product-category">
                      <li><button class="btn btn-success active" data-toggle="collapse" data-target="#collapseAll" aria-expanded="true" aria-controls="collapseOne">All</button></li>
                      <li><button class="btn btn-success" data-toggle="collapse" data-target="#collapseVege" aria-expanded="false" aria-controls="collapseTwo">Vegetables</button></li>
                      <li><button class="btn btn-success" data-toggle="collapse" data-target="#collapseFriut" aria-expanded="false" aria-controls="collapseTwo">Fruits</button></li>
                  </ul>
              </div>
          </div>
            
            <div id="accordion">
                <div id="collapseAll" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($all_products as $all_items)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{url('product_details')}}/{{$all_items->Product_id}}" class="img-prod"><img class="img-fluid" src="{{$all_items->Item_image}}" alt="All Product {{$all_items->Product_id}}">
                                {{-- <span class="status">30%</span> --}}
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{url('product_details')}}/{{$all_items->Product_id}}">{{$all_items->Item_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <span class="price-sale">Rs.{{number_format($all_items->Item_price,2)}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{url('product_details')}}/{{$all_items->Product_id}}" title="View Product" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                          <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a onclick="items_add_to_cart_function('{{$all_items->Product_id}}');" title="Add to Cart" class="buy-now d-flex justify-content-center align-items-center mx-1" style="cursor: pointer;">
                                          <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a onclick="whishlist_function('{{$all_items->Product_id}}');" title="Add to Wishlist" class="heart d-flex justify-content-center align-items-center " style="cursor: pointer;">
                                          <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                      </div>
                                </div>
                            </div>
                        </div>

                    </div> 
                    @endforeach
                </div>
              
                    </div>
                </div>
            
                {{-- vegetables --}}
                <div id="collapseVege" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($vege_products as $vege_items)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{url('product_details')}}/{{$vege_items->Product_id}}" class="img-prod"><img class="img-fluid" src="{{$vege_items->Item_image}}" alt="Vege Product {{$vege_items->Product_id}}">
                                {{-- <span class="status">30%</span> --}}
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{url('product_details')}}/{{$vege_items->Product_id}}">{{$vege_items->Item_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <span class="price-sale">Rs.{{number_format($vege_items->Item_price,2)}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{url('product_details')}}/{{$vege_items->Product_id}}" title="View Product" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                          <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a onclick="items_add_to_cart_function('{{$vege_items->Product_id}}');" title="Add to Cart" class="buy-now d-flex justify-content-center align-items-center mx-1" style="cursor: pointer;">
                                          <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a onclick="whishlist_function('{{$vege_items->Product_id}}');" title="Add to Wishlist" class="heart d-flex justify-content-center align-items-center " style="cursor: pointer;">
                                          <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                      </div>
                                </div>
                            </div>
                        </div>

                    </div> 
                    @endforeach
                </div>

                    </div>
                </div>


                {{-- fruits --}}
                <div id="collapseFriut" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        
                        <div class="row">
                            @foreach ($fruit_products as $fruit_items)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{url('product_details')}}/{{$fruit_items->Product_id}}" class="img-prod"><img class="img-fluid" src="{{$fruit_items->Item_image}}" alt="Fruit Product {{$fruit_items->Product_id}}">
                                {{-- <span class="status">30%</span> --}}
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{url('product_details')}}/{{$fruit_items->Product_id}}">{{$fruit_items->Item_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <span class="price-sale">Rs.{{number_format($fruit_items->Item_price,2)}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{url('product_details')}}/{{$fruit_items->Product_id}}" title="View Product" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                          <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a onclick="items_add_to_cart_function('{{$fruit_items->Product_id}}');" title="Add to Cart" class="buy-now d-flex justify-content-center align-items-center mx-1" style="cursor: pointer;">
                                          <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a onclick="whishlist_function('{{$fruit_items->Product_id}}');" title="Add to Wishlist" class="heart d-flex justify-content-center align-items-center" style="cursor: pointer;">
                                          <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                      </div>
                                </div>
                            </div>
                        </div>

                    </div> 
                    @endforeach
                </div>


                    </div>
                </div>

          </div>

              {{-- <div class="col-md-6 col-lg-3 ftco-animate">
                  <div class="product">
                      <a href="{{url('product_details')}}/1" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">
                          <span class="status">30%</span>
                          <div class="overlay"></div>
                      </a>
                      <div class="text py-3 pb-4 px-3 text-center">
                          <h3><a href="{{url('product_details')}}/1">Bell Pepper</a></h3>
                          <div class="d-flex">
                              <div class="pricing">
                                  <p class="price"><span class="mr-2 price-dc">Rs.120.00</span><span class="price-sale">Rs.80.00</span></p>
                              </div>
                          </div>
                          <div class="bottom-area d-flex px-3">
                              <div class="m-auto d-flex">
                                  <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                      <span><i class="ion-ios-menu"></i></span>
                                  </a>
                                  <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                      <span><i class="ion-ios-cart"></i></span>
                                  </a>
                                  <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                      <span><i class="ion-ios-heart"></i></span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
               --}}
{{-- 
          <div class="row mt-5">
        <div class="col text-center">
          <div class="block-27">
            <ul>
              <li><a href="#">&lt;</a></li>
              <li class="active"><span>1</span></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&gt;</a></li>
            </ul>
          </div>
        </div>
      </div> --}}


      </div>
  </section>


@endsection
