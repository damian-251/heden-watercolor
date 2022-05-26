@extends('layouts.app')

@section('title')
    {{__('Portfolio')}}
@endsection

@section('styles')
<link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
@endsection

@section('content')


<h1>Shipping policy</h1>

<p>All orders are processed within 1 to 4 business days (excluding weekends and holidays) after receiving your order confirmation email. You will receive another notification when your order has shipped. 
</p>

<h2>Domestic Shipping Rates and Estimates</h2>

For calculated shipping rates: Shipping charges for your order will be calculated and displayed at checkout. 

For simple flat rate shipping: We offer $X flat rate shipping to [list countries]. 

Shipping option
	

Estimated delivery time
	

Price

Option 1
	

X to X business days
	

$X

Option 2
	

X to X business days
	

$X

Option 3
	

X to X business days
	

$X
Local delivery

If you offer local delivery or in-store pickup to customers in your area, you can dedicate a section of your shipping policy page to explain the process or create a separate shipping page specifically for local customers. 

Free local delivery is available for orders over $X within [area of coverage]. For orders under $X, we charge $X for local delivery.

Deliveries are made from [delivery hours] on [available days]. We will contact you via text message with the phone number you provided at checkout to notify you on the day of our arrival. 

You can list out the ZIP/postal codes you service and/or consider embedding a map here so customers can easily see if they are within your local delivery range.
In-store pickup

You can skip the shipping fees with free local pickup at [list the locations where in-store pickup is available]. After placing your order and selecting local pickup at checkout, your order will be prepared and ready for pick up within X to X business days. We will send you an email when your order is ready along with instructions. 

Our in-store pickup hours are [store hours] on [available days of the week]. Please have your order confirmation email with you when you come.
International Shipping

We offer international shipping to the following countries: [list of countries]. 

If relevant you can also include countries you don’t ship to: At this time, we do not ship to [list of countries]. 

If you’re using calculated shipping rates: Shipping charges for your order will be calculated and displayed at checkout. 

If you offer multiple international shipping options, you can list them in a table as well. You can include broader delivery timelines (e.g. 8 to 20 days) for international shipping since expectations can vary greatly depending on the destination.

Shipping option
	

Estimated delivery time
	

Price

Option 1
	

X to X business days
	

$X

Option 2
	

X to X business days
	

$X

Option 3
	

X to X business days
	

$X

 

Your order may be subject to import duties and taxes (including VAT), which are incurred once a shipment reaches your destination country. [Your Company] is not responsible for these charges if they are applied and are your responsibility as the customer.
How do I check the status of my order?

When your order has shipped, you will receive an email notification from us which will include a tracking number you can use to check its status. Please allow 48 hours for the tracking information to become available. 

If you haven’t received your order within X days of receiving your shipping confirmation email, please contact us at support@email.com with your name and order number, and we will look into it for you.

Include a link for customers to track their order if available.
Shipping to P.O. boxes

Some carriers have limitations around shipping to P.O. Boxes. If one of your carriers falls into this group, you should look up their policy and communicate it to your customers here. 
Refunds, returns, and exchanges

Summarize your return policy here and link out to your full return policy page if you have one. 

We accept returns up to X days after delivery, if the item is unused and in its original condition, and we will refund the full order amount minus the shipping costs for the return. 

In the event that your order arrives damaged in any way, please email us as soon as possible at support@email.com with your order number and a photo of the item’s condition. We address these on a case-by-case basis but will try our best to work towards a satisfactory solution.

If you have any further questions, please don't hesitate to contact us at support@email.com.

@endsection