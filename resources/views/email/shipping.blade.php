<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order confirmation</title>
    <style>
        
        img {

        width:30%;
        margin-left: 2rem

        } 
        table { 
        margin: 3rem;
        }
    </style>
</head>
<body>
    <h1>{{__('Heden Watercolor - Order confirmation')}}</h1>
    <p>
        {{('Thank you very much for your purchasing, the details of the order are shown below.')}}
    </p>
    <table>
        <tr>
            <th>{{__('Image')}}</th>
            <th>{{__('Price')}}</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td><img src={{ asset($product->img_path_jpg) }} alt="{{__('Product image')}}"></td>
            <td>@if ($currency == "eur")
                {{$product->price_eur}}
                @else
                {{$product->price_nok}}
            @endif</td>
        <tr/>
        @endforeach
        <tr>
            <td>{{__('Shipping')}}</td>
            <td>{{$shipping_price}}</td>
        </tr>
        <tr>
            <td>
                {{__('Total price')}}
            </td>
            <td>
                {{$totalPrice}}
            </td>
        </tr>

    </table>

    <p>{{__('The order will be shipped to the following address:')}}</p>

    <h2>{{__('Shipping Address')}}</h2>
    
    {{__('Full name')}}: {{$address->full_name}} <br>
    {{__('Address Line 1')}}: {{$address->line1}} <br>
    {{__('Address Line 2')}}: {{$address->line2}} <br>
    {{__('Postal Code')}}: {{$address->postal_code}} <br>
    {{__('Province')}}: {{$address->province}} <br>
    {{__('City')}}: {{$address->city}} <br>
    {{__('Country')}}: {{$country}} <br>

    <h2>{{__('Shipping Address')}}</h2>

    {{__('Full name')}}: {{$billingAddress->full_name}} <br>
    {{__('Address Line 1')}}: {{$billingAddress->line1}} <br>
    {{__('Address Line 2')}}: {{$billingAddress->line2}} <br>
    {{__('Postal Code')}}: {{$billingAddress->postal_code}} <br>
    {{__('Province')}}: {{$billingAddress->province}} <br>
    {{__('City')}}: {{$billingAddress->city}} <br>
    {{__('Country')}}: {{$billingCountry}} <br>


    <p>
        {{__('If you detect any problem or error in the data displayed, please contact with ' ) . " " . env('ADMIN_EMAIL')}}
    </p>

</body>
</html>