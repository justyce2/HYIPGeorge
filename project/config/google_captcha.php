<?php

return [
    'site_key' => env('GOOGLE_CAPTCHA_SITE_KEY'),
    'secret_key' => env('GOOGLE_CAPTCHA_SECRET_KEY'),
    'gc_verification_url' => env('GOOGLE_CAPTCHA_VERIFICATION_URL'),
    'error_codes' => [
        "missing-input-secret" => "The secret parameter is missing.",
        "invalid-input-secret" => "The secret parameter is invalid or malformed.",
        "missing-input-response" => "The response parameter is missing.",
        "invalid-input-response" => "The response parameter is invalid or malformed.",
        "bad-request" => "The request is invalid or malformed.",
        "timeout-or-duplicate" => "The response is no longer valid: either is too old or has been used previously.",
    ],

];
