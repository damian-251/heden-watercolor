<div class="d-flex justify-content-center my-3">
    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.public') }}"></div>
</div>
@if ($errors->has('g-recaptcha-response'))
<span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
@endif