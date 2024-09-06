@extends('layouts.app')
@section('style')
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
      #map { height: 200px; }
  </style>
@endsection
@section('content')

<div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Pending</span>
                        <span class="text-muted fw-semibold fs-7">Belum Terjadwal</span>
                    </h3>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th>Kode Transaksi</th>
                                <th>tanggal</th>
                                <th>Kategori</th>
                                <th>Customer</th>
                                <th>Alamat</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $item)
                                <tr>
                                    <td>
                                      <span class="">{{ $item->transaction_code }}</span>
                                    </td>
                                    <td>
                                        <span class="">{{ $item->created_at }}</span>
                                    </td>
                                    <td>
                                      @if ($item->category->id == 1)
                                        <div class="badge badge-light-success fw-bold">{{ $item->category->name }}</div>
                                      @else
                                      <div class="badge badge-light-primary fw-bold">{{ $item->category->name }}</div>
                                      @endif
                                    </td>
                                    <td>
                                        <span class="">{{ $item->user->name }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $item->address }}</span>
                                    </td>
                                    <td class="text-end">
                                      <a href="#"  data-bs-toggle="modal" data-bs-target="#jadwalkan{{ $item->id }}" class="btn btn-light-primary btn-sm">
                                        <i class="ki-duotone ki-calendar-add">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        </i>
                                        Jadwalkan</a>
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#info{{ $item->id }}" class="btn btn-primary btn-sm btn-icon">
                                        <i class="ki-duotone ki-information-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        </i>
                                      </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($transaction as $item)
<div class="modal fade" tabindex="-1" id="jadwalkan{{ $item->id }}">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('transaction.pending.addSchedule', $item->id) }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Buat Jadwal {{ $item->transaction_code }}</h5>
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
            </div>
          </div>

          <div class="modal-body">
              <div class="mb-8">
                <label for="" class="required fw-bold">Petugas</label>
                  <select class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Petugas" name="driver" required>
                    <option></option>
                    @foreach ($driver as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="mb-8  ">
                <label for="" class="required fw-bold">Tanggal</label>
                <input class="form-control form-control-solid" type="date" name="date" required>
              </div>
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
  </div>
</div>
@endforeach

@foreach ($transaction as $item)
<div class="modal fade" tabindex="-1" id="info{{ $item->id }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">{{ $item->transaction_code }}</h5>
              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                  <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
              </div>
          </div>
          <div class="modal-body">
            <div id="map{{ $item->id }}" style="height: 400px;"></div>
            <div class="table-responsive mt-4">
              <h4 class="my-5">Informasi Customer</h4>
              <table class="table table-row-dashed fw-normal">
                <tbody>
                    <tr>
                      <td>Kategori</td>
                      <td>:</td>
                      <td>
                        @if ($item->category->id == 1)
                          <div class="badge badge-light-success fw-bold">{{ $item->category->name }}</div>
                        @else
                          <div class="badge badge-light-primary fw-bold">{{ $item->category->name }}</div>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Cutomer</td>
                      <td>:</td>
                      <td>
                        {{ $item->user->name }}
                      </td>
                    </tr>
                    <tr>
                      <td>No. HP</td>
                      <td>:</td>
                      <td>
                        {{ $item->user->phone }}
                      </td>
                    </tr>
                    <tr>
                      <td>Alamat </td>
                      <td>:</td>
                      <td>
                        {{ $item->address }}
                      </td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var modalElement = document.getElementById('info{{ $item->id }}');
    modalElement.addEventListener('shown.bs.modal', function () {
        var map = L.map('map{{ $item->id }}').setView([5.1843, 97.1451], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([{{ $item->latitude }}, {{ $item->longitude }}]).addTo(map);
        marker.bindPopup("{{ $item->address }}").openPopup();
    });
});
</script>
@endforeach


@endsection

@section('script')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    $("#kt_datatable_horizontal_scroll").DataTable({
        "scrollX": false
    });
</script>
@endsection
