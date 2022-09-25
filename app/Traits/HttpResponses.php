<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data, $message=null, $code = 200){
        return response()->json([
            'status' => 'Request successful.',
            'message' => $message,
            'data' =>$data
        ], $code);
    }

    protected function error($data, $message=null, $code = 200){
        return response()->json([
            'status' => 'An error occurred.',
            'message' => $message,
            'data' =>$data
        ], $code);
    }
}


