@if ($isSmall)
<style>
    .small-avatar-wrap {
        width: 30px; 
        height: 30px;
        position: relative;
    }
    .small-avatar-wrap .avatar { 
        vertical-align: middle; 
        width: 30px; 
        height: 30px; 
        border:1px solid #f0f0f0;
        border-radius: 50%;
    }

    .small-avatar-wrap span {
        position: absolute;
        bottom: 0;
        right: 0;
        background: green;
        border-radius: 100%;
        color:#fff;
        width: 10px;
        height: 10px;
        text-align: center;
        font-size: 5px;
        line-height: 10px;
    }
</style>

<div class="small-avatar-wrap">
    <img src="{{$user->avatar}}" alt="Avatar" class="avatar">
    @if ($user->hasPermission('user_verified'))
        <span><i class="fas fa-check"></i></span>
    @endif
</div>
@else
<style>
    .avatar-wrap {
        width: 45px; 
        height: 45px;
        position: relative;
    }
    .avatar { 
        vertical-align: middle; 
        width: 45px; 
        height: 45px; 
        border:1px solid #f0f0f0;
        border-radius: 50%;
    }

    .avatar-wrap span {
        position: absolute;
        bottom: 0;
        right: 0;
        background: green;
        border-radius: 100%;
        color:#fff;
        width: 15px;
        height: 15px;
        text-align: center;
        font-size: 10px;
        line-height: 15px;
    }
</style>

<div class="avatar-wrap">
    <img src="{{$user->avatar}}" alt="Avatar" class="avatar">
    @if ($user->hasPermission('user_verified'))
        <span><i class="fas fa-check"></i></span>
    @endif
</div>
@endif
