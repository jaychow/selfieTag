@extends('frontend.layouts.master')

@section('content')
    {!! csrf_field() !!}
    <div class="row">
        @foreach($images as $image)
            <div class="col-xs-6 col-sm-3 col-md-4">
                <div class="img-item text-center tag-img {{($image->is_selfie) ? 'active' : ''}}" data-id="{{$image->id}}">
                    <img class="img-responsive" src="{{$image->low_res}}" />
                </div>
                <div class="text-center">
                    <a href="{{$image->link}}" class="btn btn-primary" target="_blank">
                        View Image <i class="fa fa-photo"></i>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('after-scripts-end')
    @include('frontend.scripts.selfie-tag')
@stop