@foreach($homeContent as $content)
    @php
        $data = json_decode($content->data,true);
    @endphp
    @include('frontend::home.include.__'.$content->code,['data' => $data])
@endforeach
