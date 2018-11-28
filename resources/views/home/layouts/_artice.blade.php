<div class="list-group-item px-0">

    <div class="row">
        <div class="col-auto">
            <!-- Avatar -->
            <div class="avatar avatar-sm">
                <img src="{{$article->causer->icon}}" alt="..." class="avatar-img rounded-circle">
            </div>

        </div>
        <div class="col ml--2">

            <!-- Content -->
            <div class="small text-muted">
                <a href="{{route('member.user.show',$article->causer)}}"> <strong class="text-body">{{$article->causer->name}}</strong></a>
                @if($article->description=='created')
                发布了
                @else
                    更新了
                @endif
                <a href="{{route('home.article.show',$article->subject)}}">
                    <strong class="text-body">{{$article->subject->title}}</strong>
                </a>
            </div>

        </div>
        <div class="col-auto">

            <small class="text-muted">
                {{$article->created_at->diffForHumans()}}
            </small>

        </div>
    </div> <!-- / .row -->

</div>