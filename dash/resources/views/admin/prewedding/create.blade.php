@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Foto Prewedding</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.prewedding.store', $invitation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="photo">Foto Prewedding</label>
                    <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
                </div>
                <!-- Tambahkan dropdown untuk memilih kategori -->
                <div class="form-group">
                    <label for="category">Kategori Foto Prewedding</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Unggah Foto</button>
            </form>

            <hr>

            <!-- Tampilkan foto yang sudah diunggah jika ada -->
            @if ($invitation->preweddingPhotos && $invitation->preweddingPhotos->isNotEmpty())
                <h4>Foto Prewedding yang Sudah Diunggah</h4>
                
                        <!-- Tampilkan foto prewedding dengan nama kategori -->
                        @foreach ($categories as $category)
                            <h4>{{ $category->name }}:</h4>
                            @if ($category->preweddingPhotos->isNotEmpty())
                                <div class="row">
                                    @foreach ($category->preweddingPhotos as $photo)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/' . $photo->photo_path) }}" class="img-fluid"
                                                alt="Foto Prewedding">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Belum ada foto prewedding untuk kategori ini.</p>
                            @endif
                        @endforeach
            @endif
        </div>
    </div>
@stop
