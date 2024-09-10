@extends('layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                  <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('fund.withdraw.pending') }}">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('fund.withdraw.mutation') }}">Mutasi</a>
                    </li>
                  </ul>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                              <th>Tanggal</th>
                                <th>Pengguna</th>
                                <th>Bank</th>
                                <th>Penarikan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendings as $pending)
                                <tr>
                                    <td>
                                      <span class="">{{ $pending->created_at }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $pending->user->name }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $pending->bank_name }}</span> <br>
                                      <span class=" fw-bold">{{ $pending->account_number }}</span> ({{ $pending->account_name }})
                                    </td>
                                    <td>
                                        <span class="">
                                            Rp. {{ number_format($pending->sum('debit'), 0, ',', '.') }}
                                        </span>                                   
                                    </td>
                                    <td>
                                      <button class="btn btn-success btn-icon btn-withdraw btn-sm" id="{{ route('fund.withdraw.pending.aprove', $pending->id) }}">
                                        <i class="ki-duotone ki-check fs-2 btn-withdraw"></i>
                                      </button>
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

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
      if (event.target.classList.contains('btn-withdraw')) {
        var link = event.target.id;
        var myModal = new bootstrap.Modal(document.getElementById('check'));
        myModal.show();
        document.querySelector('.yes').addEventListener('click', function() {
          window.location.replace(link);
        });
      }
    });
  });
</script>

<div class="modal modal-delete" id="check" data-bs-backdrop="static">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content shadow rounded ">
      <div class="modal-body p-4 text-center py-8">
        <h5 class="mb-2">Konfirmasi</h5>
        <p class="mb-0">Kamu sudah mengirimkan tarik tunai pengguna?</p>
      </div>
      <div class="modal-footer flex-nowrap p-0">
        <button type="button" class="yes btn btn-lg btn-secondary bg-transparent text-dark fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" >Sudah</button>
        <button type="button" class="btn btn-lg btn-secondary bg-transparent text-dark fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal" aria-label="Close">Belum</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
    $("#kt_datatable_horizontal_scroll").DataTable({
        "scrollX": false
    });
</script>
@endsection
