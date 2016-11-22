<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transaction;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class TransactionController extends Controller
{

    public function __construct()
    {
        // how do I make a token work only for a specific route?
        // it works everywhere exept index
        $this->middleware('jwt.auth', ['except' => ['index']]);

        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('storage/logs/app.log', Logger::WARNING));

        // add records to the log
        $log->addWarning('CustomerController API REST called');
    }


    // add  new transaction for customer
    // POST to route http://localhost:7000/api/transaction?token=&cnp=8904328903&name=Tadziu
    public function store(Request $request)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            } else {

                $transaction = new Transaction();
                $transaction->customer_id = $request->customer_id;
                $transaction->amout = $request->customer_id;

                //dd($transaction);

                return response()->json($transaction->save()); // returns true or false

            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

    }
}
