<?php

namespace App\Services;

trait Utils
{
    public static function removeFormatInFile($filename)
    {
        $format_array = ['.docx', '.doc', '.pdf', '.xlsx', '.xlx', '.csv', '.txt'];
        return str_replace($format_array, '', $filename);
    }

    public static function dateFormatForSQL($date)
    {
        return date_format($date, 'Y-m-d H:i:s');
    }

}

?>