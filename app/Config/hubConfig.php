<?php

namespace App\Config;

/*
|--------------------------------------------------------------------------
| Availables adapters
|--------------------------------------------------------------------------
|
| This value is the name of your application, which will be used when the
| framework needs to place the application's name in a notification or
| other UI elements where an application name needs to be displayed.
|
*/
return [
    new App\Http\Adapters\hotelLegsServiceAdapter(),

    // add more here while integrating more APIS...
];