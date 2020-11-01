<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Deploy;

class Image extends Model
{
    protected $table= 'images';
    protected $updated_at= 'false';

     
    protected $fillable=[
        'name',
        'size',
        'extension',
        'width',
        'heigth'              
    ];
    

    public function deploy(){
        return $this->belongsTo(Deploy::class, 'deploy_id', 'id');
    }

    
}
