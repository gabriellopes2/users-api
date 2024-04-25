<?php

namespace App\Http\Controllers;

use App\Http\Services\AutenticationService;
use App\Http\Services\UsersService;
use App\Models\EventsModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $ok = AutenticationService::verificaAutenticacao($request->bearerToken());
        if (!$ok)
        {
            return response()->json([
                "success" => false,
                "message" => "Não autorizado!",
                403
            ]);
        }
            
        $token = AutenticationService::login();
        $result = UsersService::register($request, $token);

        return json_decode($result);
    }
}