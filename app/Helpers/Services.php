<?php

namespace App\Helpers;


class Services
{

    public function updateIsReadMessage($data)
    {
        $data->is_admin_read = '1';
        $data->save();
    }

    public function removeFileFromUpload($value, $path)
    {
        if ($value) {
            $filePath = public_path($path . basename($value));
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}
