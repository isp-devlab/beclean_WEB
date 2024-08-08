@extends('layouts.app')

@section('content')

<div class="row g-5 g-xl-8" onload="initMap()">
    <div class="col-xl-12 mb-8">
      <div id="map" style="height: 500px; width: 100%;"></div>
    </div>
</div>


@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCR_mdca5DgO6PU2s98-Ld_GX2aVOo4B8"></script>
<script>
  function initMap() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              var userLocation = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
              };

              var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 12,
                  center: userLocation
              });

              var directionsService = new google.maps.DirectionsService();
              var directionsRenderer = new google.maps.DirectionsRenderer();
              directionsRenderer.setMap(map);

              var request = {
                  origin: userLocation,
                  destination: {lat: {{ $schedule->transaction->latitude }}, lng: {{ $schedule->transaction->longitude }}},
                  travelMode: 'DRIVING'
              };

              directionsService.route(request, function(result, status) {
                  if (status == 'OK') {
                      directionsRenderer.setDirections(result);
                  }
              });
          }, function() {
              handleLocationError(true, map.getCenter());
          });
      } else {
          handleLocationError(false, map.getCenter());
      }
  }

  function handleLocationError(browserHasGeolocation, pos) {
      alert(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
  }
</script>
@endsection
