<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{

    public function signIn(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $authUser = Auth::user();
                // creamos un token de acceso
                $token =  $authUser->createToken('MyAuthApp')->plainTextToken;
                $data = $this->getUserData($authUser, $token);

                return $this->sendResponse($data, 'El usuario inicio sesion.');
            } else {
                return $this->sendError('Desautorizado.', ['error' => 'Desautorizado']);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logOut(Request $request)
    {
        try {
            if (auth()->user()->tokens()->delete()) {
                $success['logout'] = true;
                return $this->sendResponse($success, 'el usuario cerro su sesion.');
            } else {
                return $this->sendError('Desautorizado.', ['error' => 'Un error inesperado ocurrio.']);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
