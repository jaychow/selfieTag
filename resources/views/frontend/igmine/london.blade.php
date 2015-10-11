@extends('frontend.layouts.master')

@section('content')
    {!! csrf_field() !!}
    <div class="row">
        @foreach($images as $image)
            <div class="img-item text-center col-xs-6 col-sm-3 col-md-2 tag-img {{($image->is_selfie) ? 'active' : ''}}" data-id="{{$image->id}}">
                <img class="img-responsive" src="{{$image->low_res}}" />
            </div>
        @endforeach

    </div>
    <div class="row">
        <div class="text-center col-md-12">
            {!! $images->render() !!}
        </div>
    </div>
@endsection

@section('after-scripts-end')
    @include('frontend.scripts.image-tag')
@stop