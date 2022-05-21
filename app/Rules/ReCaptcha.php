<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReCaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify",[
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $value
        ]);

        Log::channel('custom')->debug("Recaptcha response rule: " . $response);

          

        return $response->json()["success"];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The Google recaptcha is required');
    }
}
