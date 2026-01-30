<?php

use Illuminate\Support\Facades\Crypt;

if(!function_exists('api_success')){
    function api_success($success = true, $message, $data = null,$code=200){
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}

if(!function_exists('api_error')){
    function api_error($success = false, $message,$code=400){
        return response()->json([
            'success' => $success,
            'message' => $message,
        ], $code);
    }
}

if(!function_exists('encrypt_id')){
    function encrypt_id($id) {
        return base64_encode($id);
    }
}

if(!function_exists('decrypt_id')){
    function decrypt_id($encryptedId) {
        return base64_decode($encryptedId);
    }
}
