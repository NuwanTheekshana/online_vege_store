@extends('layouts.admin_app')

@section('content')


<div class="container" style="margin-bottom: 100%;">
   
    <div class="card mt-4">
        <div class="card-header">{{ __('Insert Items') }}</div>
          <div class="card-body">

            <form action="{{url('/item_add')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="item_name" class="col-sm-4 col-form-label">Item Name <i style="color:red;">*</i></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}"  id="item_name" name="item_name" placeholder="Item Name">
                    
                      @error('item_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    
                    </div>
                </div>

                <div class="form-group row">
                  <label for="item_dept" class="col-sm-4 col-form-label">Item Description <i style="color:red;">*</i></label>
                  <div class="col-sm-8">
                    <textarea name="item_dept" id="item_dept" class="form-control @error('item_dept') is-invalid @enderror" value="{{ old('item_dept') }}" cols="8" rows="3" placeholder="Item Description"></textarea>
                  
                  @error('item_dept')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  
                  </div>
              </div>

              <div class="form-group row">
                <label for="item_qty" class="col-sm-4 col-form-label">Item Quntity <i style="color:red;">*</i></label>
                <div class="col-sm-2">
                  <input type="number" class="form-control @error('item_qty') is-invalid @enderror" value="{{ old('item_qty') }}"  id="item_qty" name="item_qty" placeholder="Qty">
                
                @error('item_qty')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                
                
                </div>
                <div class="col-sm-3">
                  <select class="form-control @error('item_qty_type') is-invalid @enderror" value="{{ old('item_qty_type') }}"  id="item_qty_type" name="item_qty_type">
                    <option>Select Quntity Type</option>
                    <option value="Kilograms (Kg)">Kilograms (Kg)</option>
                    <option value="Grams (g)">Grams (g)</option>
                    <option value="PCs">PCs</option>
                    <option value="bottles">bottles</option>
                  </select>

                  @error('item_qty_type')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror

                </div>
              </div>

                <div class="form-group row">
                    <label for="unit_price" class="col-sm-4 col-form-label">Unit Price <i style="color:red;">*</i></label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control @error('unit_price') is-invalid @enderror" value="{{ old('unit_price') }}"  id="unit_price" name="unit_price" placeholder="Unit Price">
                    
                      @error('unit_price')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    
                    </div>
                </div>

                <div class="form-group row">
                  <label for="item_category" class="col-sm-4 col-form-label">Item Category <i style="color:red;">*</i></label>
                  <div class="col-sm-4">
                    <select class="form-control @error('item_category') is-invalid @enderror" value="{{ old('item_category') }}"  id="item_category" name="item_category">
                      <option>Select Item Category</option>
                      <option value="Vegetable">Vegetable</option>
                      <option value="Fruit">Fruit</option>
                    </select>
                  
                    @error('item_category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  
                  </div>
              </div>

              <div class="form-group row">
                <label for="item_image" class="col-sm-4 col-form-label">Item Image<i style="color:red;">*</i></label>
                <div class="col-sm-8">
                  <div class="custom-file mt-2">
                    <input type="file" class="custom-file-input @error('item_image') is-invalid @enderror" id="item_image" name="item_image" accept="image/*">
                    <label class="custom-file-label" for="item_image">Choose file</label>
                  </div>

                  @error('item_image')
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





</div>


<script>
  $('#item_image').on('change',function(){
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).next('.custom-file-label').html(fileName);
  })
</script>


@endsection