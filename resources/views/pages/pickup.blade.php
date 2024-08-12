@extends('layouts.app')

@section('style')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCR_mdca5DgO6PU2s98-Ld_GX2aVOo4B8&libraries=places"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  /* Ensure the body and html are full height */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  /* Make the map div take full viewport height */
  #map {
    height: 85vh;
    width: 100%;
  }
</style>
@endsection

@section('content')
<div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div id="map" class="rounded-4"></div>
      <div class="fixed-bottom mb-5 mx-5 shadow-lg">
        <div class="card bg-primary shadow-lg">
          <div class="card-body text-white">
            <h1 class="text-white">{{ $schedule->transaction->user->name }}</h1>
            <span>{{ $schedule->transaction->user->phone }}</span>
            <p class="fs-5 fw-bold">{{ $schedule->transaction->address }}</p>
            <div class="text-end">
              @if ($schedule->transaction->product_category_id == 1) 
                <button class="btn btn-light btn-sm ps-5 pe-5" data-bs-toggle="modal" data-bs-target="#input">Input Sampah</button>
              @else
                <button class="btn btn-success btn-sm ps-5 pe-5 btn-confirm" id="{{ route('dashboard.pickup.selesai', $schedule->id) }}">Selesaikan Pekerjaan</button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal bg-body" tabindex="-1" id="input">
  <div class="modal-dialog modal-fullscreen">
      <form action="{{ route('dashboard.pickup.selesai.post', $schedule->id) }}" method="POST" class="modal-content shadow-none">
        @csrf
          <div class="modal-header">
              <h5 class="modal-title">Produk Item</h5>

              <!--begin::Close-->
              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
              </div>
              <!--end::Close-->
          </div>

          <div class="modal-body">
              <!--begin::Repeater-->
              <div id="kt_docs_repeater_basic">
                <!--begin::Form group-->
                <div class="form-group">
                    <div data-repeater-list="kt_docs_repeater_basic">
                        <div data-repeater-item>
                            <div class="form-group row d-flex align-items-end justify-content-around">
                                <div class="col-6">
                                    <label class="form-label">Produk:</label>
                                    <select class="form-select select2-element mb-2 mb-md-0" name="product" data-control="select2" data-placeholder="Select an option">
                                      <option></option>
                                      @foreach ($product as $product)
                                          
                                      <option value="{{ $product->id }}">{{ $product->name }}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Berat:</label>
                                    <input type="text" class="form-control mb-2 mb-md-0" name="weight"  placeholder="0" />
                                </div>
                                <div class="col-3 pb-3">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-icon btn-light-danger">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group mt-5">
                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary w-100">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Add
                    </a>
                </div>
                <!--end::Form group-->
              </div>
              <!--end::Repeater-->
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Salesaikan Pekerjaan</button>
          </div>
      </form>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
  function initializeSelect2() {
      $('.select2-element').select2({
          width: '100%',
          placeholder: "Select an option",
          allowClear: true
      });
  }

  $('#kt_docs_repeater_basic').repeater({
    initEmpty: false,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        $(this).slideDown();
        initializeSelect2(); // Re-initialize select2 on new elements
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
  });

  $(document).ready(function() {
      initializeSelect2(); // Initialize select2 on document ready
  });
</script>
<script>
  function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 5.1843, lng: 97.1451},
          zoom: 12
      });

      var latDes = {{$schedule->transaction->latitude}};
      var lngDes = {{$schedule->transaction->longitude}};

      var directionsService = new google.maps.DirectionsService();
      var directionsRenderer = new google.maps.DirectionsRenderer();

      directionsRenderer.setMap(map);

      // Use geolocation to get the user's current position
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              var origin = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
              };

              var destination = {lat: latDes, lng: lngDes};
              var waypts = []; // Initialize waypoints array

              directionsService.route({
                  origin: origin,
                  destination: destination,
                  waypoints: waypts,
                  optimizeWaypoints: true,
                  travelMode: google.maps.TravelMode.DRIVING
              }, function(response, status) {
                  if (status === google.maps.DirectionsStatus.OK) {
                      directionsRenderer.setDirections(response);
                  } else {
                      window.alert('Directions request failed due to ' + status);
                  }
              });
          }, function() {
              handleLocationError(true, map.getCenter());
          });
      } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, map.getCenter());
      }
  }

  function handleLocationError(browserHasGeolocation, pos) {
      window.alert(browserHasGeolocation ? 
                   'Error: The Geolocation service failed.' :
                   'Error: Your browser doesn\'t support geolocation.');
  }

  google.maps.event.addDomListener(window, 'load', initMap);
</script>
@endsection
