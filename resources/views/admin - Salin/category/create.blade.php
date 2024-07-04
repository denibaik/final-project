@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">

        <!-- DataTales Example -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Kategori</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Nama Kategori</label>
                                <input type="text" name="name" id="" required class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Deskripsi Singkat</label>
                                <input type="text" name="description" id="" required class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Gambar</label>
                                <input type="file" name="image" id="" required class="form-control"
                                    accept=".jpg,.jpeg,.png">
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
