@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Undangan</h3>
        </div>
        <div class="card-body">
            <!-- Tampilkan detail undangan non-pernikahan -->
            <p><strong>Nama:</strong> {{ $invitation->name }}</p>
            <p><strong>Email:</strong> {{ $invitation->email }}</p>
            <p><strong>Tanggal Acara:</strong> {{ $invitation->event_date }}</p>
            <p><strong>Tempat Acara:</strong> {{ $invitation->event_location }}</p>
            <p><strong>Kategori Acara:</strong> {{ $invitation->eventCategory ? $invitation->eventCategory->name : 'Tidak Ada Kategori' }}</p>
            <p><strong>Dibuat Pada:</strong> {{ $invitation->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
@endsection
