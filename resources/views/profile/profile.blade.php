@extends('layouts.app')
@section('content')
    <div class="container">            
        <h2 style="margin-top:20px">{{ $profile->name }}</h2>
        <h5>{{ $profile->email }}</h5>
        <div class="content row" style="padding: 3px; padding-top:0px">
            @foreach($posts as $key => $d)
                <div class="col-lg-6">

                    <a href="{{url('detail/'.$d->id)}}">
                        <div class="card" style="padding:15px 0px;"> 
                            <img class="image-grid" src="{{ $d->image }}"/>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>    
@endsection