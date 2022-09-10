<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponserTrait{

    public function successResponse($data, $httpCode = Response::HTTP_OK){
        $data = [
            ...[
                'status' => true,
                'status_message' => Response::$statusTexts[$httpCode] ?? null,
                'status_code' => $httpCode,
            ],
            ...$data,
        ];
        return new JsonResponse($data, $httpCode);
    }

    public function errorResponse($data, $httpCode){
        $data = [
            ...[
                'status' => false,
                'status_message' => Response::$statusTexts[$httpCode] ?? null,
                'status_code' => $httpCode,
            ],
            ...$data,
        ];
        return new JsonResponse($data, $httpCode);
    }
}