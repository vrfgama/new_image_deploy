<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Image;
use App\Deploy;
use App\Http\Requests\ImageDeployValidate;
use Session;
use Redirect;


class UploadController extends Controller
{

    
    public function inputView(){
        return view('input_view');
    }


   
    public function upload(ImageDeployValidate $request){ 
      
                 
        for ($i=0; $i < count($request->allFiles()['images']) ; $i++) { 

                               
            $file= $request->allFiles()['images'][$i];
            $path= $file->getRealPath();

            $size= getimagesize($path);
            $byte= filesize($path); //bytes  -- verificar precisão
            

            $image= new Image();
            $image->name= $file->getClientOriginalName(); // retirar o .jpg
            $image->extension= $file->getClientOriginalExtension();
            
            if(!$size){
                $image->width= 0;  
                $image->heigth= 0;
            }else{
                $image->width= $size[0];  //largura
                $image->heigth= $size[1];  //altura
            }
            
            $image->size= $byte;
            $image->path= $file->storeAs('temp', $image->name, 's3');

            $array[]= $image;
                
        }
            

        Session::put('array', $array); // to do - melhorar forma de guardar informações iniciais das imagens

        return view('check',['array'=>$array]);

    }

    public function deploy(){

        
        $array= Session::get('array');

        $deploy= new Deploy();
        $deploy->qtd_images= count($array);
        $deploy->description= "";
        $deploy->save();

        
        foreach($array as $image){

           
            if(Storage::disk('s3')->exists('homolog/images/'.$this->folder($image->name).'/'.$image->name) && 
               Storage::disk('s3')->exists('homolog/images/thumbs/'.$this->folder($image->name).'/'.$image->name)){

                $this->delete($image->name);
            }

                        
            Storage::disk('s3')->copy('temp/'.$image->name, 'homolog/images/'.$this->folder($image->name).'/'.$image->name);
            Storage::disk('s3')->copy('temp/'.$image->name, 'homolog/images/thumbs/'.$this->folder($image->name).'/'.$image->name);
            

            $image->deploy_id= $deploy->id;
            $image->path= ""; // to do - retirar atributo path da migration
            $image->save();            
        }

        Session::forget('array');
            
        Storage::disk('s3')->deleteDirectory('temp/');
        
        return Redirect::to('image-deploy/input-view');   

    }


    //calcula a pasta
    public function folder($image){
        return intval( ((intval($image)-1) / 1000+1) );
    }

    public function delete($name){
        Storage::disk('s3')->delete('homolog/images/'.$this->folder($name).'/'.$name);
        Storage::disk('s3')->delete('homolog/images/thumbs/'.$this->folder($name).'/'.$name);   
    }

    //deleta diretório temporario com imagens
    public function cancel(){

        Storage::disk('s3')->deleteDirectory('temp/');
        return view('input_view');
    }


}
