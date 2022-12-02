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
        try {
            $queries = array();
            parse_str($_SERVER['QUERY_STRING'], $queries);

            $name = $queries['coin'];
            $response = Http::withoutVerifying()->get('https://api.coingecko.com/api/v3/coins/'.$name);
            $check = DB::select('select * from coins where name = ?', [$response['name']]);

            $coin = Coin::updateOrCreate(
                ['name' => $response['name']],
                ['price' => $response['market_data']['current_price']['brl']]
            );

            return response()->json([
                'name' => $coin['name'],
                'price' => $coin['price']
            ]);
        } catch (Exception $e) {
            return response()->json(['ErrorMessage' => 'Dados inválidos']) ;
        }

    }

    public function coinPriceByDate (Request $request) {
        try {
            $queries = array();
            parse_str($_SERVER['QUERY_STRING'], $queries);
    
            $name = $queries['coin'];
            $datetime = $queries['date'];
            $response = Http::withoutVerifying()->get('https://api.coingecko.com/api/v3/coins/'.$name.'/history?date='.$datetime);

            return response()->json([
                'name' => $response['name'],
                'price' => $response['market_data']['current_price']['brl'],
                'date' => $datetime
            ]) ;
        } catch (Exception $e) {
            return response()->json(['ErrorMessage' => 'Dados inválidos']) ;
        }
    }
}