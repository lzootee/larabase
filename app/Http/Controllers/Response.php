<?php

namespace App\Http\Controllers;

class Response
{
    public static function apiJson($data, $code = "200") {
        return response()->json([
            'result' => 0,
            'now_dt' => date('Y-m-d H:i:s'),
            'data' => $data,
            'err_cd' => null,
            'err_msg' => null
        ],$code);
    }

    public static function apiError($msg, $code = "500") {
        return response()->json([
            'result' => 0,
            'now_dt' => date('Y-m-d H:i:s'),
            'data' => null,
            'err_cd' => 500,
            'err_msg' => $msg
        ],$code);
    }

    public static function json($data, $code = "200") {
        return response()->json($data, $code);
    }

    public static function error($msg, $code = "500") {
        return response()->json($msg, $code);
    }

    public static function apiJsonVersion($data, $version, $code = 200) {
        if ($code == 200) {
            return response()->json([
                'result' => 0,
                'now_dt' => date('Y-m-d H:i:s'),
                'data' => $data,
                'version' => $version,
                'err_cd' => null,
                'err_msg' => null
            ], $code);
        } else {
            return Response::json([
                'result' => 0,
                'now_dt' => date('Y-m-d H:i:s'),
                'data' => null,
                'version' => $version,
                'err_cd' => $code,
                'err_msg' => $data
            ], $code);
        }
    }
}