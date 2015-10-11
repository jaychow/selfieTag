@extends('frontend.layouts.master')

@section('content')
    {!! csrf_field() !!}
    <div class="row full-height">
        <div id="map"></div>
    </div>

@endsection

@section('footer')
    <div class="row full-height">
        <div class="text-center col-md-12">
            <h4>InstaCity &copy; 2015</h4>
        </div>
    </div>
@endsection
@section('after-styles-end')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKoGzI8HTVCGmsj4-8zRSvrS-29Cm3AN4&libraries=visualization&sensor=true_or_false">
    </script>
@stop
@section('after-scripts-end')

    <script>
        // If you're adding a number of markers, you may want to drop them on the map
        // consecutively rather than all at once. This example shows how to use
        // window.setTimeout() to space your markers' animation.

        var neighborhoods = [
            @foreach($images as $image)
              {
                position: {
                    lat:{{$image->lat}},
                    lng:{{$image->lon}}
                },
                icon: '{{$image->thumbnail}}'
              },
            @endforeach
        ];

        var heatmapData = [
            @foreach($images as $image)
            new google.maps.LatLng({{$image->lat}}, {{$image->lon}}),
            @endforeach
        ]

        var markers = [];
        var map;
        var styleArray = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: 51.511620, lng: -0.117492},
                styles: styleArray
            });

            var heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatmapData
            });
            heatmap.setMap(map);

            google.maps.event.addListenerOnce(map, 'idle', function(){
                drop();
            });

            google.maps.event.addListener(map, 'zoom_changed', function() {
                for(i=0; i< markers.length; i++ ) {
                    var zoom = 10*((map.getZoom()/13)*3);
                    console.log(map.getZoom());
                    console.log(zoom);

                    var icon = markers[i].getIcon();
                    var url = icon.url;
                    markers[i].setIcon(new google.maps.MarkerImage(
                            url,
                            new google.maps.Size(150, 150),
                            new google.maps.Point(0, 0),
                            new google.maps.Point(zoom/2, zoom/2),
                            new google.maps.Size(zoom, zoom))
                    );
                }
            });
        }

        function drop() {
            clearMarkers();
            for (var i = 0; i < neighborhoods.length; i++) {
                addMarkerWithTimeout(neighborhoods[i].position,neighborhoods[i].icon, i * 100);
            }
        }

        function addMarkerWithTimeout(position, icon, timeout) {
            console.log(position);
            console.log(icon);

            var image = {
                url: icon,
                size: new google.maps.Size(150,150),
                origin: new google.maps.Point(0,0),
                anchor:new google.maps.Point(5,5),
                scaledSize: new google.maps.Size(10,10)


            }

            window.setTimeout(function() {
                markers.push(new google.maps.Marker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    icon: image,

                }));
            }, timeout);
        }

        function clearMarkers() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }

        $(document).ready(function() {
            initMap();

        });



    </script>

@stop