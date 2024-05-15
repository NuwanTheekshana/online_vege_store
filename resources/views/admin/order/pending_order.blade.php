@extends('layouts.admin_app')

@section('content')


<div class="container" style="margin-bottom: 100%;">
    <center>

        <div class="card">
            <div class="card-header">{{ __('Pending Order Details') }}</div>
            <div class="card-body">
         <div class="row">
    
                  <table id="pending_order_tbl" class="table table-responsive-sm table-responsive-md table-responsive-lg table-hover table-outline mt-3">
                    <thead>
                        <tr>
                            <th style="text-align: center">Order Id</th>
                            <th style="text-align: center">Customer Name</th>
                            <th style="text-align: center">Customer Address</th>
                            <th style="text-align: center">Contact No</th>
                            <th style="text-align: center">Total Amount</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($pending_orders as $orders)
                      <tr>
                        <td style="text-align: center">{{$orders->Order_id}}</td>
                        <td style="text-align: center">{{$orders->customer_name}}</td>
                        <td style="text-align: center">{{$orders->dilivery_address}}, {{$orders->dilivery_city}}</td>
                        <td style="text-align: center">{{$orders->customer_contact_no}}</td>
                        <td style="text-align: center">{{number_format($orders->total_price, 2)}}</td>
                        <td>
                            <center>
                                <button class="btn btn-success" style="background-color: green" data-toggle="modal" data-target="#orders_complete{{$orders->Order_id}}"><i class="fa fa-edit"></i>&nbsp; Complete</button>
                                <button class="btn btn-danger" style="background-color: red" data-toggle="modal" data-target="#orders_remove{{$orders->Order_id}}"><i class="fa fa-trash"></i>&nbsp; Reject</button>
                            </center>
                            
                        </td>
                    </tr>
                      
                        
                                                  <!--remove Modal -->
                      <div id="orders_remove{{$orders->Order_id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
    
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Order Reject</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                              <form action="{{url('product_remove')}}" method="POST">
                                <input type="hidden" id="order_reject_id" value="{{$orders->Order_id}}">
                                <textarea name="reject_remark" class="form-control mb-3" id="reject_remark" cols="5" rows="5" placeholder="Enter your reason"></textarea>
                                        
                                        <button type="button" id="order_reject_btn" class="btn btn-success" style="background-color: green">Order Reject</button>
                                        <button class="btn btn-danger" style="background-color: red" class="close" data-dismiss="modal">Close</button>
    
                              </form>   
                          </div>
    
                        </div>
                      </div>      
                    </div>      
    
                            <!--update Modal -->
                        <div id="orders_complete{{$orders->Order_id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                
                                    <!-- Modal content-->
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Order Complete</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" id="order_complete_id" value="{{$orders->Order_id}}">
                                        <textarea name="complete_remark" class="form-control mb-3" id="complete_remark" cols="5" rows="5" placeholder="Enter your remark"></textarea>
                                        
                                        <button type="button" id="order_complete_btn" class="btn btn-success" style="background-color: green">Order Complete</button>
                                        <button class="btn btn-danger" style="background-color: red" class="close" data-dismiss="modal">Close</button>
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


    </center>


</div>


<script>
    $('#order_complete_btn').click(function () 
    {
        var id = $('#order_complete_id').val();
        var complete_remark = $('#complete_remark').val();

        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("admin/compete_order_update")}}',
        data:{id:id, complete_remark:complete_remark},
            success:function(data){
                $.bootstrapGrowl('<span class = "fa fa-info-circle"></span>&nbsp;&nbsp;&nbsp;Success&nbsp;!&nbsp;'+data.success,
                {
                    type: 'success',
                    width: 500,
                    delay: 3000,  
                });
                window.scrollTo({ top: 0, behavior: 'smooth' });
                $("#pending_order_tbl tbody").load(" #pending_order_tbl tbody > *");
                $('#orders_complete'+id).modal('hide');
            },
            error: function(response){
                var errors = response.responseJSON.errors;

                if (errors) 
                {
                    $.bootstrapGrowl('<i><span class = "glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;&nbsp;Warning!&nbsp;Something wrong. Please try again..!</i>',
                            {
                                type: 'danger',
                                width: 400,
                                delay: 10000,
                            });
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        return false;  
                }
            }
        });
    });
</script>

<script>
    $('#order_reject_btn').click(function () 
    {
        var id = $('#order_reject_id').val();
        var reject_remark = $('#reject_remark').val();

        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("admin/reject_order_update")}}',
        data:{id:id, reject_remark:reject_remark},
            success:function(data){
                $.bootstrapGrowl('<span class = "fa fa-info-circle"></span>&nbsp;&nbsp;&nbsp;Success&nbsp;!&nbsp;'+data.success,
                {
                    type: 'success',
                    width: 500,
                    delay: 3000,  
                });
                window.scrollTo({ top: 0, behavior: 'smooth' });
                $("#pending_order_tbl tbody").load(" #pending_order_tbl tbody > *");
                var id = $('#order_reject_id').val();
                $('#orders_remove'+id).modal('hide');
            },
            error: function(response){
                var errors = response.responseJSON.errors;

                if (errors) 
                {
                    $.bootstrapGrowl('<i><span class = "glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;&nbsp;Warning!&nbsp;Something wrong. Please try again..!</i>',
                            {
                                type: 'danger',
                                width: 400,
                                delay: 10000,
                            });
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        return false;  
                }
            }
        });
    });
</script>


@endsection