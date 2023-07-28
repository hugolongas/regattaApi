<?php

namespace App\Services;

class Service
{
    public function OkResult($data){
        $response = [
            'result' => true,
            'data' => $data
        ];
        return $response;
    }

    public function FailResponse($mess){
        $response = [
            'result' => false,
            'data' => $mess
        ];
        return $response;
    }
}