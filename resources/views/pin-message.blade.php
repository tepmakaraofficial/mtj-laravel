@if (!empty($datas))
    <style>
        .message{
            color: green;
            padding:1%;
        }
        .dark .message{
            color: #4bc48b;
            padding:1%;
        }
    </style>
    <marquee width="100%" direction="left" scrollamount="3">
        @foreach ($datas as $item)
            <a href="{{$item['url']}}" class="message" >{{$item['title']}}</a>
        @endforeach
    </marquee>
@endif