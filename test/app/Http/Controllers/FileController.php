<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(){

        //storage definisce su quale disco vuole copiare
        Storage::disk('local')  
            //primo parametro nome del file, secondo parametro stringa da inserire, me lo ha inserito in storage
            ->put('file.txt', 'Contents');
    }
}
