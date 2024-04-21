<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Services\Utils;

class FileUploadServices 
{
    use Utils;
    
    private $disk = 'public';

    public function upload(UploadedFile $file, $directory = 'uploads')
    {
        try {
            $filename = 'ict_' . date('YmdHis'). '_' . (str_replace(' ', '_', $file->getClientOriginalName())) ;
            $path = $file->storeAs(
                $this->disk . '/' . $directory,
                $filename,
                'local'
            );

            

            return $path;
        } catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
       
    }
}



?>
