<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shipping confirmation</title>
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
    <h1>{{__('Shipping confirmation - Heden Watercolor')}}</h1>
    <p>
        {{('Thank you very much for your purchasing, you order has been sent to the following address.')}}
    </p>

    <h2>{{__('Shipping Address')}}</h2>
    
    {{__('Full name')}}: {{$address->full_name}} <br>
    {{__('Address Line 1')}}: {{$address->line1}} <br>
    {{__('Address Line 2')}}: {{$address->line2}} <br>
    {{__('Postal Code')}}: {{$address->postal_code}} <br>
    {{__('Province')}}: {{$address->province}} <br>
    {{__('City')}}: {{$address->city}} <br>
    {{__('Country')}}: {{$country}} <br>

    @if ($comment != null)
    <p>
        {{__('Comments')}}
    </p>
    {{$comment}}
    @endif

    <p>
        {{__('If you detect any problem or error in the data displayed, please contact with ' ) . " " . config('services.email.admin')}}
    </p>

</body>
</html>