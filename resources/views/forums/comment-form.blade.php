<style>
    .writer{
        margin-top: 2%;
    }
</style>
<div class="writer{{isset($forumsChat)?'_reply':''}}">
    <form action="/forums/post" method="post">
        {{ csrf_field() }}
        @if (isset($forumsChat))
            <input type="hidden" name="cat_id" value="{{$forumsChat->fk_cat}}">
            <input type="hidden" name="parent_id" value="{{$forumsChat->id}}">
        @else
            <input type="hidden" name="cat_id" value="{{$forumsCat->id}}">
        @endif
        <textarea name="post" id="content_writer{{isset($forumsChat)?'_reply':''}}"></textarea>
        <button type="submit" class="btn btn-primary float-end">{{translator(isset($forumsChat)?"Reply Now":"Post Now")}}</button>
    </form>
</div>
