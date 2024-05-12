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
                </div><div class="col-md-12">
                    <!-- Tambahkan form untuk menambahkan nomor rekening -->
                    <h4>Tambahkan Nomor Rekening:</h4>
                    <form action="{{ route('admin.rekening.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="wedding_id" value="{{ $invitation->wedding->id }}">
                        <div class="form-group">
                            <label for="nomor_rekening">Nomor Rekening</label>
                            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="atas_nama">Atas Nama</label>
                            <input type="text" name="atas_nama" id="atas_nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="master_bank_id">Bank</label>
                            <select name="master_bank_id" id="master_bank_id" class="form-control" required>
                                <option value="">Pilih Bank</option>
                                @foreach ($masterBanks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                        <button type="submit" class="btn btn-primary">Tambahkan Nomor Rekening</button>
                    </form>
                    <!-- Inside your existing HTML code -->
                    @if ($bankAccounts->isNotEmpty())
                        <h4>Rekening Bank:</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nomor Rekening</th>
                                        <th>Atas Nama</th>
                                        <th>Bank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bankAccounts as $account)
                                        <tr>
                                            <td>{{ $account->nomor_rekening }}</td>
                                            <td>{{ $account->atas_nama }}</td>
                                            <td>{{ $account->masterBank->nama_bank }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Tidak ada rekening bank terkait.</p>
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
