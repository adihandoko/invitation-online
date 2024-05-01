<!-- resources/views/public/show_invitation.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Detail Undangan Pernikahan</h2>
        <p><strong>Nama:</strong> {{ $invitation->name }}</p>
        <p><strong>Email:</strong> {{ $invitation->email }}</p>
        <p><strong>Tanggal Acara:</strong> {{ $invitation->event_date }}</p>
        <p><strong>Tempat Acara:</strong> {{ $invitation->event_location }}</p>

        @if ($invitation->wedding)
            <h3>Detail Pernikahan</h3>
            <p><strong>Nama Pengantin Wanita:</strong> {{ $invitation->wedding->bride_name }}</p>
            <p><strong>Nama Pengantin Pria:</strong> {{ $invitation->wedding->groom_name }}</p>
            <!-- tambahkan detail pernikahan lainnya sesuai kebutuhan -->

            @if ($invitation->preweddingPhotos->isNotEmpty())
                <h3>Foto Prewedding</h3>
                <div class="row">
                    @foreach ($invitation->preweddingPhotos as $photo)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" class="img-fluid" alt="Foto Prewedding">
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
