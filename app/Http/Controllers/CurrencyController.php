<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

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
        $server_response = json_decode($server_response, true);


        foreach ($server_response[0]["rates"] as $slowo)
        {
            $b = Currency::where('uuid',$slowo['mid']);
            if($b->first())
            {
                $b->update(['exchange_rate'=>$slowo['mid']]);
            }
            else{
                $a = new Currency();
                $a->currency_code = $slowo['code'];
                $a->name = $slowo['currency'];
                $a->exchange_rate= $slowo['mid'];
                $a->save();
            }
        }
    }
}
