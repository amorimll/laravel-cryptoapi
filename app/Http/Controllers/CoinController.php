<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CoinController extends Controller
{
    public function index() {
        $response = Http::withoutVerifying()->get('https://api.coingecko.com/api/v3/coins/bitcoin');

        return 'Preço atual em reais: '.$response['market_data']['current_price']['brl'];
    }
}
