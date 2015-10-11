@extends('frontend.layouts.master')

@section('content')
    {!! csrf_field() !!}
    <div class="row">
        @foreach($images as $image)
            <div class="img-item text-center col-xs-6 col-sm-3 col-md-2 tag-img active" data-id="{{$image->id}}">
                <img class="img-responsive" src="{{$image->low_res}}" />
            </div>
        @endforeach

    </div>
@endsection

@section('after-scripts-end')
    @include('frontend.scripts.selfie-tag')
@stop