<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Util
{
    public static function getGlobalServer($variableName) {
        if (isset($_SERVER[$variableName])) {
            return $_SERVER[$variableName];
        }
        return null;
    }

    public static function saveImage($image, $path = "") {
        $typeFile = ImageConfigUpload::getImageMimeType(base64_decode($image));
        $typeFile = $typeFile == 'jpeg' ? '.jpg' : ( $typeFile == 'gif' ? '.gif' : '.png' );
        $imageName = $path . '/' . Str::random(16) . $typeFile;
        Storage::disk(Constant::PUBLIC_UPLOAD_STORAGE)->put($imageName, base64_decode($image));
        return asset('/upload/'.$imageName);
    }

    public static function getNow($format = "Y-m-d H:i:s") {
        return date($format);
    }

    public static function checkValidBase64($str) {
        return is_numeric(strpos($str, 'http')) || is_numeric(strpos($str, '.png')) || is_numeric(strpos($str, '.jpg'));
    }
}
