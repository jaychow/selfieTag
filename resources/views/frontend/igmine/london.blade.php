@extends('frontend.layouts.master')

@section('content')
    {!! csrf_field() !!}
    <div class="main-grid">
        <div class="row">
            @foreach($images as $image)
                <div class="col-xs-6 col-sm-3 col-md-2 img-item-container">
                    <div class="img-item text-center tag-img {{($image->is_selfie) ? 'active' : ''}}" data-id="{{$image->id}}">
                        <img class="img-responsive" src="{{$image->low_res}}" />
                    </div>
                    <div class="text-center">
                        <a href="{{$image->link}}" class="btn btn-primary btn-block" target="_blank">
                            View Image <i class="fa fa-photo"></i>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@section('footer')
    <div class="row">
        <div class="text-center col-md-12">
            @if($append)
            {!! $images->appends($append)->render() !!}
            @else
            {!! $images->render() !!}
            @endif
        </div>
    </div>
@endsection

@section('after-scripts-end')
    @include('frontend.scripts.image-tag')
@stop