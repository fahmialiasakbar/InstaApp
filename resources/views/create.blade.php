
    @extends('lipiadmin')
    @section('content')
    <br>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Add Brand</h4>
            </div>
            <div class="panel-body">
                <form action="{{url('brands/insert')}}" method="post">
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control" required>
                    </div>                  
                    <div class="form-group">
                        <input type="submit" name="send" id="send" value="Save" class="btn btn-success">{!!csrf_field()!!}                       
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection