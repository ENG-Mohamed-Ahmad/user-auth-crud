<?php
namespace App\Traits;

trait GeneralTrait {

    public function responseData($msg=null, $status=null, $data=[]) {
        $response = [
            'msg' => $msg,
            'status' => $status,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function successResponseData($data=[]) {
        $response = [
            'msg' => 'success',
            'status' => 200,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function createdResponseData($data=[]) {
        $response = [
            'msg' => 'Created Successfully!',
            'status' => 201,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function updatedResponseData($data=[]) {
        $response = [
            'msg' => 'Updated Successfully!',
            'status' => 204,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function emptyResponseData($data=[]) {
        $response = [
            'msg' => 'No Content',
            'status' => 204,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function notFoundResponseData($data=[]) {
        $response = [
            'msg' => 'Not Found',
            'status' => 404,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function serverResponseError($data=[]) {
        $response = [
            'msg' => 'Server Error',
            'status' => 500,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function unauthenticatedResponse($data=[]) {
        $response = [
            'msg' => 'Unauthorized!',
            'status' => 401,
            'data' => $data,
        ];
        return response()->json($response);
    }
    
}