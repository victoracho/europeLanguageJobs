<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use App\Models\User;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        foreach ($result as $key => $dat) {
            $response[$key] = $dat;
        }


        return response()->json($response,);
    }

    public function getUserData(User $user, $token)
    {
        if ($user) {
            $success['user'] = $user;
            $success['role'] = $role;
            $success['token'] = $token;
            return $success;
        }
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 401)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
