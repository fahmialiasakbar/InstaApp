@extends('layouts.app')

@section('content')
    <h1>{{session('status')}}</h1>
      
    {{-- <h2 style="margin-left: 30px; margin-top:20px">All Product</h2> --}}
    <div class="content row" style="padding: 30px; padding-top:0px">
        <div class="card col-sm-1 col-md-3 col-lg-3" style="background-color: #f8fafc"> 
        </div>
        
        @foreach($data as $key => $d)
            <div class="card col-sm-10 col-md-6 col-lg-6 card-post" id="{{ $d->id }}" style="padding:12px"> 
                <a href="{{url('profile/'.$d->user_id)}}">
                    <span class="username">{{ $d->name }}</span>
                </a>
                <img class="image" src="{{ $d->image }}"/>
                <div class="row">
                    <div class="col-8 icons-left">
                        @if ($isLiked == 0)
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
                    {{ $likes }} likes
                </div>
                <div class="price">Rp.{{ $d->content }}</div>
                <div class="list-comment">
                    {{-- <a href="{{url('detail/'.$d->id)}}">
                        {{ $comments }} comments
                    </a> --}}
                    @foreach($comments as $key => $d)
                        <div class="comment" style=" padding:top: 10px"> 
                            <span class="comment-username">{{ $d->name }}</span>
                            <span class="comment-content">{{ $d->comment }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="input-comment">
                    <input id="comment-text" type="text" placeholder="Add comment....."/>
                    <span id="btn-send">Send</span>
                </div>
            </div>
        @endforeach
      </div>
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
                        location.reload();
                    }
                });
            });

            $('#btn-send').click(function(e){
                var postid = $(".card-post").attr("id");
                var comment = $("#comment-text").val();    
                // alert(comment);
                // e.preventDefault();

                $.ajax({
                    type:'POST',
                    url:'/comment',
                    data:{post_id:postid, comment:comment},success:function(data){
                        // $("#comment-text").val('');
                        location.reload();
                    }
                });
            });
        });  
    </script>
@endsection
