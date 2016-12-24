<div class="marketing">

  @if($topjuals->count())
      <h4 class="text-center">Top Comment From FJB</h4>
      <hr>
  @endif

  @foreach($topjuals as $topjual)
    <div class="col-md-3">
      <div class="media">
        <a href="/{{$topjual->user->getName()}}" class="pull-left">
            <img src=" {{$topjual->user->getAvatar()}} " alt="" class="media-object img-circle" onerror="this.style.display='none'">
            <img src="{{asset('/img/users/'.$topjual->user->getAvatar() )}}" class="media-object img-circle" onerror="this.style.display='none'">
        </a>        
        <a href="/{{$topjual->user->getName()}}"> {{$topjual->user->getName()}} </a><br>
        <small class="pull-right">{{$topjual->created_at->diffForHumans()}}</small>
        <p class="pull-left">{{$topjual->tag->name}}</p>
      </div>
          <div class="media">
          @if(count($topjual->galery) > 0)
          <!-- ===== Photo Slide ===== -->
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              @if(count($topjual->galery) >= 1)
                <div class="item active">
                  <img src="{{ asset('/img/fjb/'.$topjual->getNameImg()->img ) }}">
                </div>
              @endif
              @if(count($topjual->galery) > 1)
                @foreach($topjual->galery as $galery)
                    <div class="item">
                        <img src="{{ asset('/img/fjb/'.$galery->img ) }}" class="img-rounded img-responsive">
                    </div>
                @endforeach
              @endif
            </div>
          </div>
          <style>.carousel-inner > .item > img,.carousel-inner > .item > a > img { width: auto; margin: auto;} </style>
          <!-- ===== End Photo SLide == -->
          @endif
          </div>

      <a href="/barang-di-jual/{{$topjual->slug}} ">{{$topjual->title}}</a>
      <p>{{$topjual->deskripsi}}</p>
      <div class="panel-footer"><a href="/barang-di-jual/{{$topjual->slug}} ">{{$topjual->countComments()}} comment</a></div>
    </div>
  @endforeach

</div>