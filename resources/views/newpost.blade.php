@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>New Post</h4>
            </div>
            
            <div class="panel-body">
                <form action="{{url('post/insert')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="content">Content</label>
                        {{-- <input type="text" name="description" id="description" class="form-control"> --}}
                        <textarea name="content" id="content" class="form-control" required></textarea>
                    </div>                  
                    <div class="form-group">
                        <label for="picture">Picture</label><br>
						<input type="file" name="picture" id="picture" required>
					</div>        
                    <div class="form-group">
                        <input type="submit" name="send" id="send" value="Post" class="btn btn-success">{!!csrf_field()!!}                       
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection