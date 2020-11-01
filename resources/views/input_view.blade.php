@extends('template.template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ url('/image-deploy/upload') }}" method="post" enctype="multipart/form-data" > <!-- entender -> multipart/form-data   -->
            {{ csrf_field() }} <!-- entender -> csrf_field() -->
            <h3>Input</h3>
            
            <input type="file" name="images[]" multiple id="input"><br><br>
            
            <input type="submit" value="Input">
            <input type="reset" value="reset">
        </form>
@endsection