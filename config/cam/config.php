<?php

use Illuminate\Support\Carbon;

return [
    'website-date' => Carbon::createFromDate(2021, 7, 17),
    'website-version' => 'v1.1.2',

    'signing-email' => [
        'address' => 'me@federicomonaco.it',
        'subject' => 'Signing the Colorblind Accessibility Manifesto',
        'body'    => htmlentities(
                "Hi,\n" .
                      "I would like to sign the Colorblind Accessibility Manifesto.\n" .
                      "[INSERT YOUR FULL NAME BELOW]"
                     )
    ]
];
