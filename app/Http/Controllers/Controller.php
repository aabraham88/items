<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data = [], $message = '', $statusCode = Response::HTTP_OK)
    {
        return Response::create([
            'data' => $data,
            'message' => $message,
        ])->setStatusCode($statusCode);
    }

    public function error($message, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        return Response::create([
            'message' => $message,
        ])->setStatusCode($statusCode);
    }
}
