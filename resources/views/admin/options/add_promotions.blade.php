@extends('layouts.admin_app')

@section('content')


<div class="container" style="margin-bottom: 100%;">
   
    <div class="card mt-4">
        <div class="card-header">{{ __('Insert Items') }}</div>
          <div class="card-body">

            <form action="{{url('admin/promo_add')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="promo_name" class="col-sm-4 col-form-label">Promotion Name <i style="color:red;">*</i></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('promo_name') is-invalid @enderror" value="{{ old('promo_name') }}"  id="promo_name" name="promo_name" placeholder="Promotion Name">
                    
                      @error('promo_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    
                    </div>
                </div>

                <div class="form-group row">
                  <label for="promo_dept" class="col-sm-4 col-form-label">Promotion Description <i style="color:red;">*</i></label>
                  <div class="col-sm-8">
                    <textarea name="promo_dept" id="promo_dept" class="form-control @error('promo_dept') is-invalid @enderror" value="{{ old('promo_dept') }}" cols="8" rows="3" placeholder="Promotion Description"></textarea>
                  
                  @error('promo_dept')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  
                  </div>
              </div>

              <div class="form-group row">
                <label for="promo_disc" class="col-sm-4 col-form-label">Promotion Discount % <i style="color:red;">*</i></label>
                <div class="col-sm-2">
                  <input type="number" class="form-control @error('promo_disc') is-invalid @enderror" value="{{ old('promo_disc') }}"  id="promo_disc" name="promo_disc" placeholder="">
                
                @error('promo_disc')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                
                </div>
              </div>

                <div class="form-group row">
                    <label for="promo_type" class="col-sm-4 col-form-label">Promotion Type <i style="color:red;">*</i></label>
                    <div class="col-sm-4">
                        <select class="form-control @error('promo_type') is-invalid @enderror" value="{{ old('promo_type') }}"  id="promo_type" name="promo_type">
                            <option>Select Promotion Type</option>
                            <option value="Markerting">Markerting Promotion</option>
                            <option value="Season">Season Promotion</option>
                          </select>
                    
                      @error('promo_type')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    
                    </div>
                </div>

                <div class="form-group row">
                    <label for="promo_start_date" class="col-sm-4 col-form-label">Start Date / End Date <i style="color:red;">*</i></label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control @error('promo_start_date') is-invalid @enderror" value="{{ old('promo_start_date') }}"  id="promo_start_date" name="promo_start_date" placeholder="">
                    
                    @error('promo_start_date')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    
                    </div>

                    <label for="promo_end_date" class="col-sm-1 col-form-label">To</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control @error('promo_end_date') is-invalid @enderror" value="{{ old('promo_end_date') }}"  id="promo_end_date" name="promo_end_date" placeholder="">
    
                      @error('promo_end_date')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
    
    
    
                    </div>
                  </div>
    

    
                <div class="form-group">
                   <button type="submit" class="btn btn-success float-right" style="background-color: green">Submit</button>
                </div>
            </form>


          </div>
      </div>


      <div class="card mt-4">
          <div class="card-header">
              Availble Promotions
          </div>
          <div class="card-body">

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Valid Date</th>
                    <th scope="col">Promotion Code</th>
                    <th scope="col">Promotion Name</th>
                    <th scope="col">Promotion Type</th>
                    <th scope="col">Promotion Discount</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($get_promo_data as $data)
                    <tr>
                        <td>{{$data->start_date}} to {{$data->end_date}}</td>
                        <td>{{$data->promo_code}}</td>
                        <td>{{$data->promo_name}}</td>
                        <td>{{$data->promo_type}}</td>
                        <td>{{$data->promo_discount}} %</td>
                        <td>
                            <button class="btn btn-success" style="background-color: green" data-toggle="modal" data-target="#promotion_edit{{$data->id}}">Edit</button>
                            <button class="btn btn-danger" style="background-color: red" data-toggle="modal" data-target="#promotion_remove{{$data->id}}">Remove</button>
                        </td>
                    </tr>



                                              <!--remove Modal -->
                  <div id="promotion_remove{{$data->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">{{$data->promo_name}}</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body">
                          <form action="{{url('admin/promotion_remove')}}" method="POST">
                            @csrf
                            <p>Are you sure you want to delete this promotion ?</p>

                            <input type="hidden" name="rem_promo_id" id="rem_promo_id" value="{{$data->id}}">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="background-color: green">Delete</button>
                          </div>



                          </form>   
                      </div>

                    </div>
                  </div>        

                        <!--update Modal -->
        <div id="promotion_edit{{$data->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                        
                            <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{$data->promo_name}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                        </div>
                        <div class="modal-body">
                                <form action="{{route('update_promotion_details')}}" method="post">
                                  @csrf
                                    
                                  
                                  <input type="hidden" name="promo_id" id="promo_id" value="{{$data->id}}">
                                  
                                  <div class="form-group row">
                                    <label for="update_promo_code" class="col-sm-4 col-form-label">Promotion Code</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control @error('update_promo_code') is-invalid @enderror" value="{{$data->promo_code}}"  id="update_promo_code" name="update_promo_code" placeholder="Promotion Code" readonly>
                                    
                                      @error('update_promo_code')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                    </div>
                                </div>
                                  
                                  
                                  
                                  <div class="form-group row">
                                    <label for="update_promo_name" class="col-sm-4 col-form-label">Promotion Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control @error('update_promo_name') is-invalid @enderror" value="{{$data->promo_name}}"  id="update_promo_name" name="update_promo_name" placeholder="Promotion Name">
                                    
                                      @error('update_promo_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                    </div>
                                </div>
                          
                                <div class="form-group row">
                                    <label for="update_promo_discription" class="col-sm-4 col-form-label">Promotion Discription</label>
                                    <div class="col-sm-8">
                                    <textarea name="update_promo_discription" id="update_promo_discription" class="form-control @error('update_promo_discription') is-invalid @enderror" cols="8" rows="3" placeholder="Promotion Description">{{$data->promo_description}}</textarea>
                                    
                                  @error('update_promo_discription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                
                                </div>
                                </div>

                                <div class="form-group row">
                                  <label for="update_promo_discount" class="col-sm-4 col-form-label">Promotion Discount %</label>
                                  <div class="col-sm-2">
                                    <input type="number" class="form-control @error('update_promo_discount') is-invalid @enderror" value="{{$data->promo_discount}}"  id="update_promo_discount" name="update_promo_discount">
                                  
                                    @error('update_promo_discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                
                                </div>
                              </div>
                              

                              <div class="form-group row">
                                <label for="update_promo_type" class="col-sm-4 col-form-label">Promotion Type <i style="color:red;">*</i></label>
                                <div class="col-sm-6">
                                    <select class="form-control @error('update_promo_type') is-invalid @enderror" value=""  id="update_promo_type" name="update_promo_type">
                                        <option value="{{$data->promo_type}}">{{$data->promo_type}} Promotion</option>
                                        <option value="">Select Promotion Type</option>
                                        <option value="Markerting">Markerting Promotion</option>
                                        <option value="Season">Season Promotion</option>
                                      </select>
                                      
                                @error('update_promo_type')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                                
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <label for="update_promo_start_date" class="col-sm-4 col-form-label">Start Date / End Date <i style="color:red;">*</i></label>
                                <div class="col-sm-3">
                                  <input type="date" class="form-control @error('update_promo_start_date') is-invalid @enderror" value="{{$data->start_date}}"  id="update_promo_start_date" name="update_promo_start_date" placeholder="">
                                
                                @error('update_promo_start_date')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                                
                                </div>
            
                                <label for="update_promo_end_date" class="col-sm-1 col-form-label">To</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control @error('update_promo_end_date') is-invalid @enderror" value="{{$data->end_date}}"  id="update_promo_end_date" name="update_promo_end_date" placeholder="">
                
                                  @error('update_promo_end_date')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                             
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



          </div>
      </div>


</div>



@endsection