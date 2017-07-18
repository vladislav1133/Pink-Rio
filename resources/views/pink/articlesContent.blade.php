<div id="content-blog" class="content group">
    @if($articles)
        @foreach($articles as $art)
            <div class="sticky hentry hentry-post blog-big group">
                <!-- post featured & title -->
                <div class="thumbnail">
                    <!-- post title -->
                    <h2 class="post-title"><a href="{{route('articles.show',['alias'=>$art->alias])}}">{{$art->title}}</a></h2>
                    <!-- post featured -->
                    <div class="image-wrap">
                        <img src="{{asset(env('THEME'))}}/images/articles/{{$art->img->max}}" alt="001" title="001" />
                    </div>
                    <p class="date">
                        <span class="month">{{$art->created_at->format('M')}}</span>
                        <span class="day">{{$art->created_at->format('d')}}</span>
                    </p>
                </div>
                <!-- post meta -->
                <div class="meta group">
                    <p class="author"><span>by <a href="#" title="Posts by {{$art->user->name}}" rel="author">{{$art->user->name}}</a></span></p>
                    <p class="categories"><span>In: <a href="{{route('articlesCategory',['categoryAlias'=>$art->category->alias])}}" title="View all posts in {{$art->category->title}}" rel="category tag">{{$art->category->title}}</a></span></p>
                    <p class="comments"><span><a href="{{route('articles.show',['alias'=>$art->alias])}}#respond" title="Comment on Section shortcodes &amp; sticky posts!">{{count($art->comments)?count($art->comments):'0' }} {{Lang::choice('site.comments',count($art->comments))}} </a></span></p>
                </div>
                <!-- post content -->
                <div class="the-content group">
                    {!! $art->desc !!}
                    <p><a href="{{route('articles.show',['alias'=>$art->alias])}}" class="btn   btn-beetle-bus-goes-jamba-juice-4 btn-more-link">→ {{Lang::get('site.read_more')}}</a></p>
                </div>
                <div class="clear"></div>
            </div>
        @endforeach

    <div class="general-pagination group">
        @if($articles->lastPage()>1)

            @if($articles->currentPage()!==1)
                <a href="{{$articles->url(($articles->currentPage())-1)}}">{{Lang::get('pagination.previous')}}</a>
            @endif

                @for($i=1;$i<=$articles->lastPage();$i++)

                    @if($articles->currentPage()==$i)
                    <a class="selected" disabled >{{$i}}</a>
                    @else
                        <a href="{{$articles->url($i)}}">{{$i}}</a>
                    @endif
                @endfor

                @if($articles->currentPage()!==$articles->lastPage())
                    <a href="{{$articles->url(($articles->currentPage())+1)}}">{{Lang::get('pagination.next')}}</a>
                @endif

        @endif

    </div>
    @else
        {!! Lang::get('site.empty_articles')!!}
    @endif
</div>