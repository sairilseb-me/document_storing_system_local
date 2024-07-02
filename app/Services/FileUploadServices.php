<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Services\Utils;

class FileUploadServices 
{
    use Utils;
    
    private $disk = 'Files';

    public function upload(UploadedFile $file)
    {
        try {
            $filename = 'ict_' . date('YmdHis'). '_' . (str_replace(' ', '_', $file->getClientOriginalName())) ;
            $path = $file->storeAs(
                $this->disk,
                $filename,
                'nas'
            );

            return $path;
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
       
    }
}



?>
