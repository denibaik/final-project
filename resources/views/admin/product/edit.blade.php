@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">

        <!-- DataTales Example -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Data Produk | {{ $product->name }}</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('produk.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="category_id" id="" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Kategori --</option>
                                    @forelse ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $product->category_id) selected @endif>{{ $item->name }}</option>
                                    @empty
                                        <option value="">Buat Kategori Dulu!</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" name="name" id="" required class="form-control"
                                    value="{{ $product->name }}">
                            </div>

                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="number" name="price" placeholder="tanpa titik, tanpa koma" id=""
                                    required class="form-control" value="{{ $product->price }}">
                            </div>

                            <img src="{{ asset('img/sale/' . $product->image) }}" width="100" alt=""
                                class="my-4">

                            <div class="form-group">
                                <label for="">Gambar (opsional)</label>
                                <input type="file" name="image" id="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea id="summernote" name="description" required>{{ $product->description }}</textarea>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltip.js/1.3.1/tooltip.min.js"
        integrity="sha512-ZAFwin0nQNXMJRo329TcU4ZyC+ZgKbnaopq/LH/6j7n9zT7ZVLK5BiSmnqgx7jNiewVLgc04geoE62cNN1D8VQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" nomodule=""></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['codeview']],
                ],
            });
        });
    </script>
@endsection
