@extends('layouts.app')

@section('content')
    <h1>{{session('status')}}</h1>
      
    {{-- <h2 style="margin-left: 30px; margin-top:20px">All Product</h2> --}}
    @foreach($data as $key => $d)
    <div class="content row" style="padding: 30px; padding-top:0px">
        <div class="card col-sm-1 col-md-3 col-lg-3" style="background-color: #f8fafc"> 
        </div>
        
          {{-- <a href="{{url('detail/'.$d->id_product)}}"> --}}
            <div class="card col-sm-10 col-md-6 col-lg-6" style="padding:12px"> 
                <a href="{{url('profile/'.$d->user_id)}}">
                    <span class="username">{{ $d->name }}</span>
                </a>
                <img class="image" src="{{ $d->image }}"/>
                {{-- <div class="title">
                  <a href="{{url('detail/'.$d->id_product)}}">
                    <h5 class="title-text">{{ $d->product_name }}<h5>
                  </a>
                </div> --}}
                <div class="row">
                    <div class="col-8 icons-left">
                        {{-- {{ $d->is_liked}} --}}
                        @if ($d->is_liked == 0)
                            <div class="icon-like">    
                                <i class="fa fa-heart-o icon-post" id="{{ $d->id }}"></i>
                            </div>
                        @else
                            <div class="icon-like">    
                                <i class="fa fa-heart icon-red icon-post"></i>
                            </div>
                        @endif

                        <a href="{{url('detail/'.$d->id)}}">
                            <div class="icon-comment">
                                <i class="fa fa-comment-o icon-post"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="likes">
                    {{ $d->likes }} likes
                </div>
                <div class="content">{{ $d->content }}</div>
                <div class="comments">
                    <a href="{{url('detail/'.$d->id)}}">
                        View comments
                    </a>
                </div>
            </div>
          {{-- </a> --}}
        </div>
        @endforeach
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(".fa-heart-o").click(function(e){
                $(this).addClass("icon-red").removeClass("fa-heart-o").addClass("fa-heart");
                var postid = $(this).attr("id");
                // alert(postid);
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url:'/like',
                    data:{post_id:postid},
                    success:function(data){
                    }
                });
            });
        });  
    </script>
@endsection
