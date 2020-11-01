@extends('template.template')

@section('content')
    
    total: {{count($array)}}<br><br>
    
    @foreach($array as $image)
        
        <!--
        <input type="checkbox" name="checkbox[]" value="{$image->name}"><br>
        -->
        name: {{$image->name}}<br>
        extension: {{$image->extension}}<br>
        width: {{$image->width}}<br>
        heigth: {{$image->heigth}}<br>
        size: {{$image->size}}<br>
        path: {{$image->path}}<br>
   
        
        <img src="{{Storage::disk('s3')->url($image->path)}}" alt="" width="200" height="200">
        
        <br> 
        
    @endforeach
    
    
    <a href=' {{ url("image-deploy/deploy") }} '>Deploy</a> 
    <a href=' {{ url("image-deploy/cancel") }} '>Cancelar</a>
                           
@endsection