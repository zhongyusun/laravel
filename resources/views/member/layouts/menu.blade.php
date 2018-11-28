<div class="col-sm-3" id="left_menu">
    <div class="card">
        <div class="card-block text-center pt-5">
            <div class="avatar avatar-xxl">
                <a href="{{route('member.user.edit',[$user,'type'=>'icon'])}}">
                    <img src="{{$user->icon}}" class="avatar-img rounded-circle">
                </a>
            </div>
            @if(auth()->user())
            @can('isNotMine',$user)
            {{--@auth()--}}
            <div class="card-footer text-muted mt-3">
                <a class="btn btn-white btn-block btn-xs" href="{{route('member.attention',$user)}}">
                    @if($user->fans->contains(auth()->user()))
                        <i class="fa fa-plug" aria-hidden="true"></i> 取消关注
                    @else
                        <i class="fa fa-plus" aria-hidden="true"></i> 关注 TA
                    @endif
                </a>
            </div>
            {{--@endauth--}}
            @endcan
            @else
                <div class="card-footer text-muted mt-3">
                <a class="btn btn-white btn-block btn-xs" href="{{route('member.attention',$user)}}">
                        <i class="fa fa-plus" aria-hidden="true"></i> 关注 TA
                </a>
                </div>
            @endif
            <div class="text-center mt-4">
                <a href="#!">
                    <h3 class="text-secondary">{{$user->name}}</h3>
                </a>
            </div>
        </div>
        <div class="card-body text-center pt-1 pb-2">
                @can('isMine',$user)
                <div class="nav flex-column nav-pills ">
                    <a href="{{route('member.user.edit',[$user,'type'=>'password'])}}" class="nav-link text-muted {{active_class(if_route(['member.user.edit']) && if_query('type','password'),'active','')}}">
                        修改密码
                    </a>
                </div>
                <div class="nav flex-column nav-pills ">
                    <a href="{{route('member.user.edit',[$user,'type'=>'name'])}}" class="nav-link text-muted {{active_class(if_route(['member.user.edit']) && if_query('type','name'),'active','')}}">
                        修改昵称
                    </a>
                </div>
                <div class="nav flex-column nav-pills ">
                    <a href="{{route('member.my_collect',[$user,'type'=>'article'])}}" class="nav-link text-muted {{active_class(if_route(['member.my_collect']))}}">
                        我的收藏
                    </a>
                </div>
                @endcan
            <div class="nav flex-column nav-pills ">
                <a href="{{route('member.my_fans',$user)}}" class="nav-link text-muted {{active_class(if_route(['member.my_fans']))}}">
                    粉丝列表
                </a>
                <a href="{{route('member.my_following',$user)}}" class="nav-link text-muted {{active_class(if_route(['member.my_following']))}}">
                    关注列表
                </a>
                <a href="{{route('member.notify',$user)}}" class="nav-link text-muted {{active_class(if_route(['member.notify']))}}">
                    消息中心
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body text-center">
            <div class="nav flex-column nav-pills">
                <a href="{{route('member.my_like',[$user,'type'=>'article'])}}" class="nav-link text-muted {{active_class(if_route(['member.my_like']), 'active', '')}}">
                    @can('isMine',$user)
                        我的点赞
                    @else
                        他的点赞
                    @endcan
                </a>
                <a href="" class="nav-link
                                    text-muted">
                    文档管理
                </a>
                <a href="" class="nav-link
                                    text-muted">
                    会员时长
                </a>
            </div>
        </div>
    </div>
</div>
@push('css')
    <style>
        #left_menu .active{
            color: white !important;
        }
    </style>
@endpush