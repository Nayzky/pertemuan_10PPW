<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function createFile(){
        Storage::disk("local") -> put ("file.txt", "Contents");
    }

    public function getFile(){
        $exists = Storage::disk('local') -> exists('file.txt');
        if ($exists){
            $contents = Storage::get("file.txt");
        }
        echo $contents;
    }
    public function downloadFile(){
        // echo Storage::url("file.txt");
        return Storage::download("file.txt");
    }
    public function copyFile(){
        return Storage::copy("file.txt", "new/file.txt");
    }
    public function moveFile(){
        Storage::move("file.txt", "new/file.txt");
    }

    // if($request->hasFile("photo")){
    //     $filenameWithExt = $request->file('photo')->getClientOriginalName();
    //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //     $extension = $request->file('photo')->getClientOriginalExtension();
    //     $filenameSimpan = $filename . '_' . time() . '.' . $extension;
    // }   
    
}