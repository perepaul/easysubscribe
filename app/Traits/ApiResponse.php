<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    private function respond($message = '', $data = null, $errors = null, $status = 200)
    {
        $response['message'] = $message;

        if (!empty($data)) {
            $response['data'] = $data;
        }

        if (!empty($errors)) {
            $response['data'] = $data;
        }
        return response()->json($response, $status);
    }

    private function success($message = "success", $data = [])
    {
        return $this->respond($message, $data);
    }

    private function serverError($message = "Server error")
    {
        return $this->respond($message, null, null, 500);
    }

    private function badRequest($message = "Bad request")
    {
        return $this->respond($message, null, null, 400);
    }
}
