@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Undangan</h3>
        </div>
        <div class="card-body">
            <!-- Tampilkan detail undangan pernikahan -->
            <div class="row">
                <!-- Kolom kiri -->
                <div class="col-md-6">
                    <p><strong>Nama:</strong> {{ $invitation->name }}</p>
                    <p><strong>Email:</strong> {{ $invitation->email }}</p>
                    <p><strong>Tanggal Acara:</strong> {{ $invitation->event_date }}</p>
                    <p><strong>Tempat Acara:</strong> {{ $invitation->event_location }}</p>
                    <p><strong>Kategori Acara:</strong> {{ $invitation->eventCategory->name }}</p>
                    <p><strong>Dibuat Pada:</strong> {{ $invitation->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
                <!-- Kolom kanan -->
                <div class="col-md-6">
                    @if ($invitation->wedding)
                        <!-- Tampilkan detail pernikahan jika sudah ada -->
                        <h4>Detail Pernikahan:</h4>
                        <p><strong>Nama Pengantin Wanita:</strong> {{ $invitation->wedding->bride_name }}</p>
                        <p><strong>Nama Pengantin Pria:</strong> {{ $invitation->wedding->groom_name }}</p>
                        <p><strong>Tanggal Pernikahan:</strong> {{ $invitation->wedding->wedding_date }}</p>
                        <p><strong>Tempat Pernikahan:</strong> {{ $invitation->wedding->wedding_venue }}</p>
                        <p><strong>Jumlah Tamu:</strong> {{ $invitation->wedding->number_of_guests }}</p>
                        <!-- Tampilkan foto prewedding jika ada -->
                    @else
                        <!-- Tampilkan form untuk menambahkan data pernikahan jika belum ada -->
                        <h4>Tambahkan Detail Pernikahan:</h4>
                        <form action="{{ route('admin.weddings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="invitation_id" value="{{ $invitation->id }}">
                            <div class="form-group">
                                <label for="bride_name">Nama Pengantin Wanita</label>
                                <input type="text" name="bride_name" id="bride_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="groom_name">Nama Pengantin Pria</label>
                                <input type="text" name="groom_name" id="groom_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="wedding_venue">Tempat Pernikahan</label>
                                <input type="text" name="wedding_venue" id="wedding_venue" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="number_of_guests">Jumlah Tamu</label>
                                <input type="number" name="number_of_guests" id="number_of_guests" class="form-control"
                                    required>
                            </div>
                            <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                            <button type="submit" class="btn btn-primary">Tambahkan Detail Pernikahan</button>
                        </form>
                    @endif
                </div>
                <div class="col-md-12">
                    @if ($invitation->preweddingPhotos->isNotEmpty())
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
                    @else
                        <p>Belum ada foto prewedding untuk undangan ini.</p>
                    @endif
                    <!-- Tambahkan tombol untuk menambahkan foto prewedding -->
                    <a href="{{ route('admin.prewedding.create', $invitation->id) }}" class="btn btn-primary">Tambah Foto
                        Prewedding</a>
                </div>
            </div>
        </div>
    </div>
@endsection
