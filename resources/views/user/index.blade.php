@extends('layouts.app')

@section('url') http://fidawa.com/{{$user->name}} @stop
@section('title') {{$user->name}} @stop
@section('description') Diskusikan apa yang ingin anda tanyakan di forum. Cari barang atau pasang iklan anda di forum jual beli. @stop
@section('image') {{asset('/img/users/'.$user->img )}} @stop

@section('content')
<div class="panel panel-default">
    <div class="row">
        <div class="col-md-6">
            <div class="media" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px;">
                <span class="pull-left">
                    <img width="150px" src="{{$user->getAvatar()}}" class="img-responsive" onerror="this.style.display='none'">
                    <img width="150px" src="{{asset('/img/users/'.$user->getAvatar() )}}" class="img-responsive" onerror="this.style.display='none'">
                </span>
                <div class="media-body">
                    <h5 class="media-heading"><b>{{$user->getName()}}</b></h5>
                    <p>Joined :  {{$user->created_at->diffForHumans()}} </p>
                </div>
                <div class="fb-like" data-href="http://fidawa.com/{{$user->name}}" data-width="250" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
        </div>

        <div class="col-md-6">
            @if(Auth::check())
                @if(Auth::user()->id == $user->id)
                    <div class="panel-body">
                        <form class="form-inline" action="/edit-name/{{$user->id}}" method="post">
                        {{csrf_field()}}
                            <div class="form-group {{ $errors->has('edit_name') ? ' has-error' : '' }} ">
                                <input name="edit_name" class="form-control input-sm" type="text" placeholder="edit name">
                                @if($errors->has('edit_name'))
                                    <span class="help-block"> {{$errors->first('edit_name')}} </span>
                                @endif
                            </div>
                            <button class="btn btn-primary btn-sm" type="submit">edit name</button>
                        </form>
                        <hr>
                        <form class="form-inline" action="/edit-gravatar/{{$user->id}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }} ">
                                @include('layouts.partials.upload')
                                <br>
                                <button class="btn btn-primary btn-sm" type="submit">ubah foto profil</button>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
<hr>

<div class="row">

	<div class="col-md-3">
        @include('news.tags')
    </div>

    <div class="col-md-5">
        @if(!$threads->count())
            <p class="lead">{{$user->getName()}} Belum menulis sesuatu.</p>
            <hr>
        @endif
        @foreach($threads as $thread)
            <div class="media">
                <a href="/{{$thread->user->getName()}}" class="pull-left">
                    <img src=" {{$thread->user->getAvatar()}} " class="img-responsive img-circle" onerror="this.style.display='none'">
                    <img src="{{asset('/img/users/'.$thread->user->getAvatar() )}}" class="img-responsive img-circle" onerror="this.style.display='none'">
                </a>
                <div class="media-body">
                    <div class="media-heading">
                        <a href="/threads/{{$thread->slug}} ">{{str_limit($thread->title, 50)}}</a>
                        <br>
                        <a href="/tags/{{$thread->tag->name}}" class="btn btn-danger btn-xs" style="color: white !important;"><img id="icon" src="/background/tag.svg">{{$thread->tag->name}}</a>
                    </div>
                    <p> <small>{{$thread->created_at->diffForHumans()}}</small> by <a href="/{{$thread->user->getName()}}"> {{$thread->user->getName()}} </a> </p>
                    <hr>
                    <div class="fb-like" data-href="http://fidawa.com/{{$thread->slug}}" data-width="250" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                </div>
                <div class="panel-footer"><a href="/threads/{{$thread->slug}} ">{{$thread->countComments()}} comment</a></div>
            </div>
            <hr>
        @endforeach
        {{$threads->links()}}
    </div>
</div>
    
<div class="row">
    <div class="col-md-3">
        @include('news.jtags')
    </div>
    <div class="col-md-5">
        @if(!$juals->count())
            <p class="lead">{{$user->getName()}} Belum menulis sesuatu.</p>
            <hr>
        @endif
        @foreach($juals as $jual)
            <div class="media">
                <a href="/{{$jual->user->getName()}}" class="pull-left">
                    <img src=" {{$jual->user->getAvatar()}} " class="img-circle img-responsive" onerror="this.style.display='none'">
                    <img src="{{asset('/img/users/'.$jual->user->getAvatar() )}}" class="img-circle img-responsive" onerror="this.style.display='none'">
                </a>
                <div class="media-body">
                    <div class="media-heading">
                        <a href="/fjb/{{$jual->slug}}">{{str_limit($jual->title)}}</a>
                        <br>
                        <a href="/kategory/{{$jual->tag->name}}" class="btn btn-danger btn-xs" style="color: white !important;"><img id="icon" src="/background/tag.svg">{{$jual->tag->name}}</a>
                    </div>
                    <p> <small>{{$jual->created_at->diffForHumans()}}</small> by <a href="/{{$jual->user->getName()}}"> {{$jual->user->getName()}} </a> </p>
                    <hr>
                    <div class="fb-like" data-href="http://fidawa.com/{{$jual->slug}}" data-width="250" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                </div>
                <div class="panel-footer"><a href="/fjb/{{$jual->slug}} ">{{$jual->countComments()}} comment</a></div>
            </div>
            <hr>
        @endforeach
        {{$juals->links()}}
    </div>
    
</div>
@endsection
