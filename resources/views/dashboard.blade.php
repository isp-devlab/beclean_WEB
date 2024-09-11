@extends('layouts.app')

@section('style')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
@endsection

@section('content')
<div class="row g-5 g-xl-8">
  <div class="col-xl-12 mb-2">
    <div class="card">
      <div class="p-5 d-flex border-transparent bgi-no-repeat bgi-position-x-end bgi-size-cover" style="background-size: auto 100%; background-image: url(https://preview.keenthemes.com/metronic8/demo4/assets/media/misc/taieri.svg)">          
          <div class="m-0">
              <div class="position-relative fs-2x z-index-2 fw-bold ms-5">
                  <span class="me-2">
                      Halo, <br>
                      <span class="position-relative d-inline-block text-danger">
                          <span class="text-danger opacity-75-hover">{{ Auth::user()->name }}</span>    
                      </span>  
                  </span>                                             
              </div>
          </div>
      </div>
      {{-- @if (Auth::user()->role == 'driver')
      <div class="row">
        <div class="col mb-5 ms-5">
          <div class="border border-gray-300 border-dashed rounded w-100 py-3 px-4 mt-3 bg-primary">
            <div class="d-flex align-items-center">
              <div class="fs-2 fw-bold counted text-white">6/12</div>
            </div>
            <div class="fs-7 text-white">Tugas Hari Ini</div>
          </div>                 
        </div>
      </div>
      @endif --}}
    </div>
  </div>

  @if (Auth::user()->role == 'admin')
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
  @endif
</div>  

@if (Auth::user()->role == 'driver')
<div class="row mt-5">
  <div class="col-12">
    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 d-flex justify-content-around">
      <li class="nav-item">
          <a class="nav-link fw-bold active" data-bs-toggle="tab" href="#kt_tab_pane_1">Sampah {{ $category[0]->name }}</a>
      </li>
      <li class="nav-item">
          <a class="nav-link fw-bold" data-bs-toggle="tab" href="#kt_tab_pane_2">Sampah {{ $category[1]->name }}</a>
      </li>
  </ul>
  
  <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
        @forelse ($scheduleRecycle as $item)
        <a href="#" data-bs-toggle="modal" data-bs-target="#confirm{{ $item->id }}">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <span class="fw-bold fs-5">
                    {{ $item->transaction->transaction->user->name }}
                  </span>
                  <br>
                  <span class="text-gray-500">
                    {{ $item->transaction->address }}
                  </span>
                </div>
                <i class="ki-duotone ki-right text-dark fs-1 ps-2">
                </i>
              </div>
            </div>
          </div>
        </a>
        @empty
          <div class="text-center mt-5 pt-5">
            <span class="text-gray-500 pt-5 mt-5">~ Tidak ada tugas ~</span>
          </div>
        @endforelse
      </div>
      <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
        @forelse ($scheduleCompose as $item)
          <a href="#" data-bs-toggle="modal" data-bs-target="#confirm2{{ $item->id }}">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <span class="fw-bold fs-5">
                      {{ $item->transaction->user->name }}
                    </span>
                    <br>
                    <span class="text-gray-500">
                      {{ $item->transaction->address }}
                    </span>
                  </div>
                  <i class="ki-duotone ki-right text-dark fs-1 ps-2">
                  </i>
                </div>
              </div>
            </div>
          </a>
        @empty
          <div class="text-center mt-5 pt-5">
            <span class="text-gray-500 pt-5 mt-5">~ Tidak ada tugas ~</span>
          </div>
        @endforelse
      </div>
  </div>
  </div>
</div>
@endif

@foreach ($scheduleRecycle as $item)
<div class="modal fade" tabindex="-1" id="confirm{{ $item->id }}">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $item->transaction->transaction_code }}</h5>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-row-dashed fw-normal">
                <tbody>
                  <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>
                      @if ($item->transaction->category->id == 1)
                        <div class="badge badge-light-success fw-bold">{{ $item->transaction->category->name }}</div>
                      @else
                        <div class="badge badge-light-primary fw-bold">{{ $item->transaction->category->name }}</div>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Cutomer</td>
                    <td>:</td>
                    <td>
                      {{ $item->transaction->user->name }}
                    </td>
                  </tr>
                  <tr>
                    <td>No. HP</td>
                    <td>:</td>
                    <td>
                      {{ $item->transaction->user->phone }}
                    </td>
                  </tr>
                  <tr>
                    <td>Alamat </td>
                    <td>:</td>
                    <td>
                      {{ $item->transaction->address }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>  
            <div class="mt-5">
              <form action="{{ route('dashboard.pickup.add') }}" method="POST" class="d-flex justify-content-center " id="form">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button type="button" class="btn btn-light w-100 mx-3" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary w-100 mx-3">
                  <span class="indicator-label">Mulai</span>
                  <span class="indicator-progress" style="display: none;">Loading... 
                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
              </form>
            </div>
          </div>
      </div>
  </div>
</div>
@endforeach

@foreach ($scheduleCompose as $item)
<div class="modal fade" tabindex="-1" id="confirm2{{ $item->id }}">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $item->transaction->transaction_code }}</h5>
          </div>
          <div class="modal-body">
            <div class="table-responsive mt-4">
              <table class="table table-row-dashed fw-normal">
                <tbody>
                  <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>
                      @if ($item->transaction->category->id == 1)
                        <div class="badge badge-light-success fw-bold">{{ $item->transaction->category->name }}</div>
                      @else
                        <div class="badge badge-light-primary fw-bold">{{ $item->transaction->category->name }}</div>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Cutomer</td>
                    <td>:</td>
                    <td>
                      {{ $item->transaction->user->name }}
                    </td>
                  </tr>
                  <tr>
                    <td>No. HP</td>
                    <td>:</td>
                    <td>
                      {{ $item->transaction->user->phone }}
                    </td>
                  </tr>
                  <tr>
                    <td>Alamat </td>
                    <td>:</td>
                    <td>
                      {{ $item->transaction->address }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>  
            <div class="mt-5">
              <form action="{{ route('dashboard.pickup.add') }}" method="POST" class="d-flex justify-content-center " id="form">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button type="button" class="btn btn-light w-100 mx-3" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary w-100 mx-3">
                  <span class="indicator-label">Mulai</span>
                  <span class="indicator-progress" style="display: none;">Loading... 
                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
              </form>
            </div>
          </div>
      </div>
  </div>
</div>
@endforeach
@endsection

<!-- HTML untuk modal Bootstrap -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <div class="d-flex">
            <h5 class="modal-title" id="modalTitle">Event Details</h5>
            <span id="category" class="ms-3">vv</span>
          </div>
          <p id="modalStart"></p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <h6>Customer</h6>
          <table class="table table-row-dashed fs-7">
            <tbody>
              <tr>
                <td>Nama Cutomer</td>
                <td>:</td>
                <td id="nama">
                </td>
              </tr>
              <tr>
                <td>No. HP</td>
                <td>:</td>
                <td id="hp">
                </td>
              </tr>
              <tr>
                <td>Alamat </td>
                <td>:</td>
                <td id="alamat">
                </td>
              </tr>
            </tbody>
          </table>
          <h6 class="mt-5">Petugas</h6>
          <table class="table table-row-dashed fs-7">
            <tbody>
              <tr>
                <td>Nama Petugas</td>
                <td>:</td>
                <td id="petugas">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@section('script')
<script>
  document.getElementById('form').addEventListener('submit', function() {
    var submitButton = document.getElementById('kt_sign_in_submit');
    submitButton.querySelector('.indicator-label').style.display = 'none';
    submitButton.querySelector('.indicator-progress').style.display = 'inline-block';
    submitButton.setAttribute('disabled', 'disabled');
  });
</script>
@if (Auth::user()->role == 'admin')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
              @foreach ($schedule as $event)
                {
                    title: '{{ $event->transaction->transaction_code }}',
                    start: '{{ $event->date }}',
                    extendedProps: {
                        petugas: '{{ $event->user->name }}',
                        nama: '{{ $event->transaction->user->name }}',
                        hp: '{{ $event->transaction->user->phone }}',
                        category: `{!! $event->transaction->category->id == 1 ? 
                                    "<div class='badge badge-light-success fw-bold'>" . $event->transaction->category->name . "</div>" : 
                                    "<div class='badge badge-light-primary fw-bold'>" . $event->transaction->category->name . "</div>" !!}`,
                        alamat: '{{ $event->transaction->address }}'
                    },
                    backgroundColor: '{{ $event->transaction->category->id == 1 ? "#50cd89" : "#009ef7" }}',
                    borderColor: '{{ $event->transaction->category->id == 1 ? "#50cd89" : "#009ef7" }}'
                },
              @endforeach
            ],
            eventClick: function(info) {
                // Set informasi ke dalam modal
                document.getElementById('modalTitle').textContent = info.event.title;
                document.getElementById('modalStart').textContent = info.event.start.toLocaleDateString();
                document.getElementById('category').innerHTML = info.event.extendedProps.category;
                document.getElementById('petugas').textContent = info.event.extendedProps.petugas;
                document.getElementById('nama').textContent = info.event.extendedProps.nama;
                document.getElementById('hp').textContent = info.event.extendedProps.hp;
                document.getElementById('alamat').textContent = info.event.extendedProps.alamat;

                // Tampilkan modal
                var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                eventModal.show();
            }
        });

        calendar.render();
    });
</script>

@endif
@endsection