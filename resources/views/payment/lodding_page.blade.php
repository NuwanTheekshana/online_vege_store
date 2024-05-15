<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Checking</title>

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .spinner-border {
            width: 100px; 
            height: 100px;
            
            }

            body
        {
            background: url({{url('img/lodding_background.png')}}) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }


    </style>
</head>
<body onload="order_div_load();">

    
    <div id="placed_order" style="display: none;">
        <center>
            <img src="{{asset('img/success.webp')}}" alt="" style="margin-top: 10%;">
            <h4 class="mt-4 font-weight-bold" style="size: 50%">Your order has been placed successfully..!</h4>    
        </center>    
    </div>
    
    <div id="first">
        <center>
            <div class="spinner-border" style="color: orange;margin-top: 15%;"></div>

            <h4 class="mt-4 font-weight-bold" style="size: 50%">Checking your order...!</h4>
        </center>    
    </div>

   
    <script>
    function order_div_load()
    {
        setTimeout(() => {
            $('#first').hide();
            $('#placed_order').show();
        }, 2000);

        setTimeout(() => {
            window.location = "home";
        }, 4000);
    }
</script>



</body>
</html>