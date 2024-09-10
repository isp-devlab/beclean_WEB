@extends('layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                  <div class="card-title">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('fund.withdraw.pending') }}">Pending</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link active"  href="{{ route('fund.withdraw.mutation') }}">Mutasi</a>
                      </li>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                              <th>Tanggal Penarikan</th>
                              <th>Tanggal Pencairan</th>
                                <th>Pengguna</th>
                                <th>Bank</th>
                                <th>Penarikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mutations as $mutation)
                                <tr>
                                    <td>
                                      <span class="">{{ $mutation->created_at }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $mutation->updated_at }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $mutation->user->name }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $mutation->bank_name }}</span> <br>
                                      <span class=" fw-bold">{{ $mutation->account_number }}</span> ({{ $mutation->account_name }})
                                    </td>
                                    <td>
                                        <span class="">
                                            Rp. {{ number_format($mutation->sum('debit'), 0, ',', '.') }}
                                        </span>                                   
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

@endsection

@section('script')
<script>
    $("#kt_datatable_horizontal_scroll").DataTable({
        "scrollX": false
    });
</script>
@endsection
