 <div class="widget-first widget recent-posts">
        <h3>{{Lang::get('site.latest_projects')}}</h3>
        <div class="recent-post group">

                @if(!$portfolios->isEmpty())
                    @foreach($portfolios as $port)
                    <div class="hentry-post group">
                        <div class="thumb-img"><img style="width: 55px;" src="{{asset(env('THEME'))}}/images/projects/{{$port->img->mini}}" alt="001" title="001" /></div>
                        <div class="text">
                            <a href="{{route('portfolios.show',['alias'=>$port->alias])}}" title="{{$port->title}}" class="title">{{$port->title}}</a>
                            <p>{{str_limit($port->text,130)}}</p>
                            <a class="read-more" href="{{route('portfolios.show',['alias'=>$port->alias])}}">&rarr; {{Lang::get('site.read_more')}}</a>
                        </div>
                    </div>
                    @endforeach
                @endif
        </div>
    </div>


 @if(!$comments->isEmpty())
     <div class="widget-last widget recent-comments">
         <h3>{{Lang::get('site.latest_comments')}}</h3>
         <div class="recent-post recent-comments group">
             @foreach($comments as $com)
                 <div class="the-post group">
                     <div class="avatar">
                         @set($hash,($com->email)?md5($com->email):$com->user->email)
                         <img alt="" src="http://www.gravatar.com/avatar/{{$hash}}?d=mm&s=55" class="avatar" />
                     </div>
                     <span class="author"><strong><a href="#">{{isset($com->user)?$com->user->name:$com->name}}</a></strong> in</span>
                     <a class="title" href="{{route('articles.show',['alias'=>$com->article->alis])}}">{{$com->article->title}}</a>
                     <p class="comment">
                         {{$com->text}} <a class="goto" href="{{route('articles.show',['alias'=>$com->article->alis])}}">&#187;</a>
                     </p>
                 </div>
             @endforeach
         </div>
     </div>
 @endif
