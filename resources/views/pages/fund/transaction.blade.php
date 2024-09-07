@extends('layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Transaksi</span>
                        <span class="text-muted fw-semibold fs-7">Dana Keluar</span>
                    </h3>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th>Kode Transaksi</th>
                                <th>Tanggal</th>
                                <th>Petugas</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>
                                        <span class="">{{ $transaction->transaction_code }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $transaction->schedule->date }}</span>
                                    </td>
                                    <td>
                                      <span class="">{{ $transaction->schedule->user->name }}</span>
                                    </td>
                                    <td>
                                        <span class="">
                                            Rp. {{ number_format($transaction->item->sum('price'), 0, ',', '.') }}
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
