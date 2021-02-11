<?php

namespace App\Helper;

use Storage;

class GeneralHelper{

    static function uploadAttachment($request,$fileName = 'file', $path = 'patients')
    {
        if ($request) {
            $newName = $fileName . '.' . $request->file($fileName)->extension();
            Storage::disk('public')->putFileAs($path, $request->file($fileName), $newName);
            return $path . '/' . $newName;
        }
        return null;
    }

    static function deleteAttachment($path)
    {
        return Storage::disk('public')->delete($path);
    }

}