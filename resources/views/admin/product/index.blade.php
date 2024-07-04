@extends('layouts.admin')

@section('style')
    <!-- Custom styles for this page -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection


@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Produk</h1>
        <p class="mb-4">
            <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->category->name }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('img/sale/' . $item->image) }}" alt="" width="100">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>Rp {{ number_format($item->price) }}</td>
                                    <td>
                                        <a href="{{ route('produk.edit', $item->id) }}" class="badge bg-warning">Edit</a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge bg-danger border-0">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
