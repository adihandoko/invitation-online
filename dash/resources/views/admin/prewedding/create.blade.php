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
                <button type="submit" class="btn btn-primary">Unggah Foto</button>
            </form>

            <hr>

            <!-- Tampilkan foto yang sudah diunggah jika ada -->
            @if ($invitation->preweddingPhotos && $invitation->preweddingPhotos->isNotEmpty())
                <h4>Foto Prewedding yang Sudah Diunggah</h4>
                <div class="row">
                    @foreach ($invitation->preweddingPhotos as $photo)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" class="img-fluid" alt="Foto Prewedding">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@stop
