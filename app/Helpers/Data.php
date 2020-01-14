<?php

namespace App\Helpers;

use Hamcrest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use File;
use Faker\Provider\Image;

class Data
{
    /**
     * create function to upload file
     * @return $data
     * */
    public static function uploadFile($file, $folder, $msg = 'Het bestand %file% is succesvol opgeleverd')
    {
        $suc = false;
        if($file->isValid()){
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $fileName = Auth::user()->name. '_' . time()  . '_' . $name;
            $fileName = self::normalizeString($fileName);

            Storage::put(
              $folder . '/' . $fileName,
              File::get($file)
            );
            $suc = true;

            $msg = str_replace('%file%', $name, $msg);

            $data = array(
                'success' => $suc,
                'file' => $folder . '/' . $fileName,
                'name' => $fileName,
                'ext' => $extension,
                'msg' => $suc ? $msg : 'er is een fout opgetreden bij het opslaan van het bestand'
            );

            // sending back with message
            return $data;

        }


    }

    /**
     * create function normalizing strings
     * @return $str
     * */
    public static function normalizeString($str = '')
    {
        $str = strip_tags($str);
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        return $str;
    }
}
