<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Storage;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public  function storeFile($folderName,$file){
        try{
            return Storage::disk('website')->put($folderName, $file);
        }catch(\Exception $e){
            return '';
        }//end trycatch.
    }//end storeImage function.


}
