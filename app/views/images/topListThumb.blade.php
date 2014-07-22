@if ($height > $width)
<img class="lazy" data-original="{{$image}}" src="{{asset('/img/grey.gif')}}" width="50" height="auto" alt="">
@else
<img class="lazy" data-original="{{$image}}" src="{{asset('/img/grey.gif')}}" height="50" width="auto" alt="">
@endif