<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order confirmation</title>
    <style>
        img {
            margin: 0 auto;
            width: 30%;
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

    {{-- //TODO Falta poner la direacción de envío --}}

    <p>
        {{__('If you detect any problem or error in the data displayed, contact' ) . " " . env('ADMIN_EMAIL')}}
    </p>

</body>
</html>