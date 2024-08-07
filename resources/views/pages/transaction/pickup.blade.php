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
                        <span class="card-label fw-bold fs-3 mb-1">Pickup</span>
                        <span class="text-muted fw-semibold fs-7">Sudah Selesai</span>
                    </h3>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th>Jadwal</th>
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
                                      <span class="">{{ $item->schedule->date }}</span>
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
<div class="modal fade" tabindex="-1" id="info{{ $item->id }}">
  <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Informasi</h5>
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
              <h4 class="my-5">Informasi Petugas</h4>
              <table class="table table-row-dashed fw-normal">
                <tbody>
                    <tr>
                      <td>Nama Petugas</td>
                      <td>:</td>
                      <td>
                        {{ $item->schedule->user->name }}
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Penugasan</td>
                      <td>:</td>
                      <td>
                        {{ $item->schedule->date }}
                      </td>
                    </tr>
                </tbody>
              </table>
              @if ($item->category->id == 1)
              <h4 class="my-5">Item Sampah</h4>
              <table class="table table-bordered">
                <thead>
                  <tr class="fw-bold fs-6 text-gray-800">
                    <th>Produk</th>
                    <th>Berat</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($item->item as $data)
                  <tr>
                    <td>{{ $data->product_name }}</td>
                    <td>{{ $data->weight }}</td>
                    <td>Rp. {{ number_format($data->price, 0, ',', '.') }} </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" class="text-end fw-bold">Total</td>
                    <td>{{ number_format($item->item->sum('price'), 0, ',', '.') }}</td>
                  </tr>
                </tbody>
              </table>
              @endif
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
