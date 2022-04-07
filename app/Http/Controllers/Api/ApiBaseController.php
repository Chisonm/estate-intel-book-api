<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiBaseController extends Controller
{
    /**
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function successResponse($data, $message,$code): JsonResponse
    {
        return response()->json(ResponseUtil::generateResponse(
            'SUCCESS',
            $message,
            $code,
            $data
        ), Response::HTTP_OK);
    }

    public function errorResponse($message, $statusCode): JsonResponse
    {
        return response()->json(ResponseUtil::generateError(
            'ERROR',
            $statusCode,
            $message,
            []
        ), Response::HTTP_BAD_REQUEST);
    }

    // validateRequest
    public function validateRequest($request, $rules)
    {
        $validator = \Validator::make($request->all(), $rules);
        // dd($validator); 
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
    }
}
