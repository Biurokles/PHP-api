<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    function show()
    {
        $url = "http://api.nbp.pl/api/exchangerates/tables/A/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_response = curl_exec($ch);
        curl_close($ch);
        $server_response = json_decode($server_response,true);
        echo "<pre>"; print_r($server_response); echo"</pre>";
    }

}
