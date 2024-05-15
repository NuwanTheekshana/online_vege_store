<script>
    $('.quantity-right-plus').click(function () 
    {
        var quantity = $('#quantity').val();
        var plus = parseInt(quantity) + 1;
        $('#quantity').val(plus);
    });

    $('.quantity-left-minus').click(function () 
    {
        var quantity = $('#quantity').val();
        var plus = parseInt(quantity) - 1;
        if (quantity == 1)
        {$('#quantity').val(1);}
        else{$('#quantity').val(plus);}
    });
</script>


<script>
    function add_to_cart_function(id) {
        var quantity = $('#quantity').val();

        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("/add_to_cart")}}',
        data:{id:id, quantity:quantity},
            success:function(data){
                $('#shopping_count').text(data.cart_count);
                $.bootstrapGrowl('<span class = "fa fa-info-circle"></span>&nbsp;&nbsp;&nbsp;Success&nbsp;!&nbsp;'+data.success,
                {
                    type: 'success',
                    width: 500,
                    delay: 3000,  
                });
                window.scrollTo({ top: 0, behavior: 'smooth' });

            },
            error: function(response){
                var errors = response.responseJSON.errors;
                var quantity = response.responseJSON.errors.quantity;

                if (quantity) 
                {
                    $.bootstrapGrowl('<i><span class = "glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;&nbsp;Warning!&nbsp;'+quantity+'</i>',
                            {
                                type: 'danger',
                                width: 400,
                                delay: 10000,
                            });
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        return false;  
                }

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
    }
</script>

<script>
    function items_add_to_cart_function(id) {
        var quantity = 1;

        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("/add_to_cart")}}',
        data:{id:id, quantity:quantity},
            success:function(data){
                $('#shopping_count').text(data.cart_count);
                alert(data.success);
            },
            error: function(response){
                var errors = response.responseJSON.errors;
                var quantity = response.responseJSON.errors.quantity;

                if (quantity) 
                {
                    $.bootstrapGrowl('<i><span class = "glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;&nbsp;Warning!&nbsp;'+quantity+'</i>',
                            {
                                type: 'danger',
                                width: 400,
                                delay: 10000,
                            });
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        return false;  
                }

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
    }
</script>


<script>
    function product_remove_btn(id) 
    {
        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("/remove_cart_item")}}',
        data:{id:id},
            success:function(data){
                $('#shopping_count').text(data.cart_count);
                $.bootstrapGrowl('<span class = "fa fa-info-circle"></span>&nbsp;&nbsp;&nbsp;Success&nbsp;!&nbsp;'+data.success,
                {
                    type: 'success',
                    width: 500,
                    delay: 3000,  
                });
                window.scrollTo({ top: 0, behavior: 'smooth' });
                $("#cart_item_table tbody").load(" #cart_item_table tbody > *");
                $("#cart_summery_div").load(" #cart_summery_div > *");

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
    }
</script>

<script>
    $('#promotion_code_apply_btn').click(function () 
    {
        var promo_code_input = $('#promo_code_input').val();
        var sub_total_value = $('#sub_total_value').val();
        var dilivery_amount = $('#dilivery_amount').val();

        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("/validate_promotion_code")}}',
        data:{promo_code_input:promo_code_input, sub_total_value:sub_total_value, dilivery_amount:dilivery_amount},
            success:function(data){
                console.log(data.final_total);
                
                if (data.error) 
                {
                    $('#promo_validate_error').text("** "+data.error);
                    $('#promo_discount').text("");
                    $('#promo_discount_amount').val(0);
                    $('#discount_span').hide();
                    var sub_total_value = $('#sub_total_value').val();
                    var dilivery_amount = $('#dilivery_amount').val();
                    var total = parseInt(sub_total_value)+parseInt(dilivery_amount);
                    console.log(total);
                    $('#total_amount').text("Rs. "+total.toFixed(2));
                    $('#total_amount_input').val(data.final_total);
                    return false;
                }
                else
                {
                    $('#discount_span').show();
                    $('#promo_discount').text("Rs. "+data.promotion_value.toFixed(2));
                    $('#promo_discount_amount').val(data.promotion_value);
                    var sub_total_value = $('#sub_total_value').val();

                    $('#total_amount').text("Rs. "+data.final_total.toFixed(2));
                    $('#total_amount_input').val(data.final_total);
                }
                

                // $("#cart_item_table tbody").load(" #cart_item_table tbody > *");
                

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
    function quntity_change(id) 
    {
        var qty = $('#cart_qty'+id).val();

        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("/change_cart_itme_quntity")}}',
        data:{id:id, qty:qty},
            success:function(data){
                console.log(data.success);
                $("#cart_item_table tbody").load(" #cart_item_table tbody > *");
                $("#cart_summery_div").load(" #cart_summery_div > *");
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
    }
</script>

<script>
    function whishlist_function(id) 
    {
        $.ajax({
        type:'POST',
        headers: 
        {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        url:'{{url("/add_whishlist")}}',
        data:{id:id},
            success:function(data){
                alert(data.success);
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
    }
</script>