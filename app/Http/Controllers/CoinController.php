<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use \Exception;
use App\Models\Coin;

class CoinController extends Controller
{
    public function coinPrice(Request $request) {
            $name = $request->query('coin');
            $response = Http::withoutVerifying()->get('https://api.coingecko.com/api/v3/coins/'.$name);

            $coin = Coin::updateOrCreate(
                ['name' => $response['name']],
                ['price' => $response['market_data']['current_price']['brl']]
            );

            return response()->json([
                'name' => $coin['name'],
                'price' => $coin['price']
            ]);

    }

    public function coinPriceByDate (Request $request) {
        try {
            $name = $request->query('coin');
            $datetime = $request->query('date');
            $response = Http::withoutVerifying()->get('https://api.coingecko.com/api/v3/coins/'.$name.'/history?date='.$datetime);

            return response()->json([
                'name' => $response['name'],
                'price' => $response['market_data']['current_price']['brl'],
                'date' => $datetime
            ]) ;
        } catch ( Exception $e) {
            return response()->json(['ErrorMessage' => 'Dados inválidos']) ;
        }
    }
}