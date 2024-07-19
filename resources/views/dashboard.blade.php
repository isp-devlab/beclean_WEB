@extends('layouts.app')

@section('style')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
@endsection

@section('content')
<div class="row g-5 g-xl-8">
  <div class="col-xl-12 mb-2">
    <div class="card border-transparent bgi-no-repeat bgi-position-x-end bgi-size-cover " style="background-size: auto 100%; background-image: url(https://preview.keenthemes.com/metronic8/demo4/assets/media/misc/taieri.svg)">
      <div class="card-body d-flex ps-xl-15">          
          <div class="m-0">
              <div class="position-relative fs-2x z-index-2 fw-bold my-7">
                  <span class="me-2">
                      Halo, <br>
                      <span class="position-relative d-inline-block text-danger">
                          <span class="text-danger opacity-75-hover">{{ Auth::user()->name }}</span>    
                      </span>                     
                  </span>                                             
              </div>
          </div>
      </div>
    </div>
  </div>

  <div class="col-xl-12 mb-8">
    <div class="card card-flush">
      <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <div class="card-title">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Jadwal</span>
            <span class="text-muted fw-semibold fs-7">Jadwal Pengangkutan sampah</span>              
          </h3>
        </div>
      </div>
      <div class="card-body pt-0">
        <div id='calendar'></div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: [
              {
                  title: 'Event 1',
                  start: '2024-07-01'
              },
              {
                  title: 'Event 2',
                  start: '2024-07-05',
              },
              {
                  title: 'Event 3',
                  start: '2024-07-05',
              }
          ]
      });

      calendar.render();
  });
</script>
@endsection