@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
    <div class="panel panel-default" style="padding-left: 20px; padding-right: 20px;">
        <div class="panel-heading text-center">
            <h3><small><a href="/fjb/{{$jual->slug}} ">{{$jual->title}}</a></small></h3>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} ">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$jual->title}}">
                @if($errors->has('title'))
                    <span class="help-block"> {{$errors->first('title')}} </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('tag_id') ? ' has-error' : '' }} ">
                <label for="tag_id">Tag</label>
                <select name="tag_id" id="tag_id" class="form-control">
                    <option value="{{$jual->tag->id}}"> {{$jual->tag->name}} </option>
                    <option value="">Pilih tags anda</option>
                    @foreach($jtags as $jtag)
                        <option value=" {{$jtag->id}} "> {{$jtag->name}} </option>
                    @endforeach
                </select>
                @if($errors->has('tag_id'))
                    <span class="help-block"> {{$errors->first('tag_id')}} </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : '' }} ">
                <label for="deskripsi">Deskription</label>
                <textarea name="deskripsi" id="deskripsi" rows="10" class="form-control">{{$jual->deskripsi}}</textarea>
                @if($errors->has('deskripsi'))
                    <span class="help-block"> {{$errors->first('deskripsi')}} </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }} ">
            @if(count($jual->galery) > 0)
                <div class="media">
                    @foreach($jual->galery as $galery)
                        <li style="display: inline-block;">
                        <img src="{{ asset('/img/fjb/'.$galery->img)  }}" alt="{{$jual->tag->name}}" style="max-height:100px;max-width:150px;"><br>
                        <div class="text-center">
                            <a href="/fjb/{{$galery->id}}/delete"><img id="kategori" src="/background/delete.svg"></a>
                        </div>
                        </li>
                    @endforeach
                    <span class="help-block"><i>max 4 file</i></span>
                </div>
            @endif
            @if(count($jual->galery) < 4)
            <div class="media">
                <input type="file" name="img[]" class="file" id="media" multiple="multiple">
                <div class="input-group col-sm-9">
                    <span class="input-group-addon"><img id="icon" src="/background/upload.svg"></span>
                    <input type="text" class="form-control" disabled placeholder="Upload Image">
                    <span class="input-group-btn">
                        <button class="browse btn btn-primary" type="button">Browse</button>
                    </span>
                </div>                            
                @if($errors->has('img'))
                    <span class="help-block"> {{$errors->first('img')}} </span>
                @endif
                <span class="help-block" style="color: red;"><i>{{ Session::get('message') }}</i></span>
            </div>
            @endif
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm" value="update">
            </div>
        </form>
    </div>
    </div>
</div>
@endsection
