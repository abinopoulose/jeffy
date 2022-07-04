<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;





 public function ai()
    {

        $files = array(
            "prog.py" => Storage::get('myfiles/prog.py'),
            "prog2.py" => Storage::get('myfiles/prog2.py')
         );


        $pid = Http::post('https://7c4c8575.compilers.sphere-engine.com/api/v4/submissions?access_token=8617797e8aa5b87b86878c267c0f1fae', 
        [
            'access_token' => '8617797e8aa5b87b86878c267c0f1fae',
            'files' => $files,
            'compilerId' => '116'
            
        ]);     
            $a = "https://7c4c8575.compilers.sphere-engine.com/api/v4/submissions/";
            $a.= $pid["id"]; 
            $a.= "/output?access_token=8617797e8aa5b87b86878c267c0f1fae"; 
            $b= $pid["id"]; 
            sleep(2);
            $response = Http::get( $a);
      
        return view('welcome')->with(['output_data'=> $response]);
    }







}