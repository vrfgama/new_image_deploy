<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Deploy extends Model
{
    protected $table='deploys';
    protected $updated_at= 'false';
    
    protected $fillable=[
        'qtd_images',
        'description'
    ];


    public function image(){
        return $this->hasMany(Image::class, 'deploy_id', 'id');
    }
}
