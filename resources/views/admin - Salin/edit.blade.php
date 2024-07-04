@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">

        <!-- DataTales Example -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDIT STATUS TRANSAKSI | {{ $trx->id }}</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.save', $trx->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="">UBAH STATUS</label>
                                <select name="status" required id="" class="form-control">
                                    <option value="Pending" @if ($trx->status == 'Pending') selected @endif>Pending
                                    </option>
                                    <option value="Berhasil" @if ($trx->status == 'Berhasil') selected @endif>Berhasil
                                    </option>
                                    <option value="Canceled" @if ($trx->status == 'Canceled') selected @endif>Canceled
                                    </option>
                                </select>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
