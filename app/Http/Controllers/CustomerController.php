<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class CustomerController extends Controller
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


    // works
    public function store(Request $request)
    {

        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            } else {
                $customer = $request->all();
                return Customer::create($customer);
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