@extends('layouts.admin_app')

@section('content')


<div class="container" style="margin-bottom: 100%;">
 


    <div class="card">
        <div class="card-header">{{ __('Items details') }}</div>
        <div class="card-body">
     <div class="row">

              <table id="find_claims_tbl" class="table table-responsive-sm table-responsive-md table-responsive-lg table-hover table-outline mt-3">
                <thead>
                    <tr>
                        <th style="text-align: center">Item Image</th>
                        <th style="text-align: center">Item Name</th>
                        <th style="text-align: center">Item Price</th>
                        <th style="text-align: center">Item Quntity</th>
                        <th style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($product as $item)
                  <tr>
                    <td style="text-align: center"><img src="{{asset($item->Item_image)}}" alt="" style="width: 100px;height: 100px;"></td>
                    <td style="text-align: center">{{$item->Item_name}}</td>
                    <td style="text-align: center">{{$item->Item_price}}</td>
                    <td style="text-align: center">{{$item->Item_qty}} {{$item->Item_qty_type}}</td>
                    <td>
                        <center>
                         
                            <button class="btn btn-success" style="background-color: green" data-toggle="modal" data-target="#item_edit{{$item->Product_id}}"><i class="fa fa-edit"></i>&nbsp; Edit</button>
                            <button class="btn btn-danger" style="background-color: red" data-toggle="modal" data-target="#item_remove{{$item->Product_id}}"><i class="fa fa-trash"></i>&nbsp; Remove</button>
                        </center>
                        
                    </td>
                </tr>
                  
                    
                                              <!--remove Modal -->
                  <div id="item_remove{{$item->Product_id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">{{$item->Item_name}}</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body">
                          <form action="{{url('product_remove')}}" method="POST">
                            @csrf
                            <p>Are you sure you want to delete this item ?</p>

                            <input type="hidden" name="rem_itm_id" id="rem_itm_id" value="{{$item->Product_id}}">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="background-color: green">Delete</button>
                          </div>



                          </form>   
                      </div>

                    </div>
                  </div>        

                        <!--update Modal -->
        <div id="item_edit{{$item->Product_id}}" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                        
                            <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{$item->Item_name}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                        </div>
                        <div class="modal-body">
                                <form action="{{route('update_product_details')}}" method="post" enctype="multipart/form-data">
                                  @csrf
                        
                                  <input type="hidden" name="item_id" id="item_id" value="{{$item->Product_id}}">
                                  <div class="form-group row">
                                    <label for="update_item_name" class="col-sm-4 col-form-label">Item Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control @error('update_item_name') is-invalid @enderror" value="{{$item->Item_name}}"  id="update_item_name" name="update_item_name" placeholder="Item Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                  <label for="update_item_category" class="col-sm-4 col-form-label">Item Category <i style="color:red;">*</i></label>
                                  <div class="col-sm-4">
                                    <select class="form-control @error('update_item_category') is-invalid @enderror" id="update_item_category" name="update_item_category">
                                      <option value="{{$item->Item_category}}">{{$item->Item_category}}</option>
                                      <option>Select Item Category</option>
                                      <option value="Vegetable">Vegetable</option>
                                      <option value="Fruit">Fruit</option>
                                    </select>
                                  
                                  </div>
                              </div>
                          
                                <div class="form-group row">
                                    <label for="update_unit_price" class="col-sm-4 col-form-label">Unit Price</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control @error('update_unit_price') is-invalid @enderror" value="{{$item->Item_price}}"  id="update_unit_price" name="update_unit_price" placeholder="Unit Price">
                                    </div>
                                </div>

                                <div class="form-group row">
                                  <label for="update_unit_quntity" class="col-sm-4 col-form-label">Unit Quntity ({{$item->Item_qty_type}})</label>
                                  <div class="col-sm-2">
                                    <input type="number" class="form-control @error('update_unit_quntity') is-invalid @enderror" value="{{$item->Item_qty}}"  id="update_unit_quntity" name="update_unit_quntity" placeholder="Unit Quntity">
                                  </div>
                              </div>
                          
                                <div class="form-group row">
                                    <label for="update_item_image" class="col-sm-4 col-form-label">Item Image</label>
                                    <div class="col-sm-8">
                                      <input type="file" class="form-control-file" id="update_item_image" name="update_item_image">
                                    </div>
                                </div>
                          
                                <div class="form-group">
                                  <button type="submit" class="btn btn-success float-right" style="background-color: green">update</button>
                              </div>

                                </form>

                              </div>
                            </div>
                        
                          </div>
                        </div>          
                        
                        @endforeach
                </tbody>
            </table>

          </div>
        </div>
      </div>



</div>





@endsection