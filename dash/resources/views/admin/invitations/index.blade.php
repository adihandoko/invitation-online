<!-- resources/views/admin/invitations/index.blade.php -->

@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Invitation List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.invitations.create') }}" class="btn btn-primary">Add Invitation</a>
            </div>
        </div>
        <div class="card-body">
            @if($invitations->isEmpty())
                <p>No invitations available.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Event Date</th>
                            <th>Event Location</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invitations as $invitation)
                            <tr>
                                <td>{{ $invitation->id }}</td>
                                <td>{{ $invitation->name }}</td>
                                <td>{{ $invitation->eventCategory->name }}</td>
                                <td>{{ $invitation->email }}</td>
                                <td>{{ $invitation->event_date }}</td>
                                <td>{{ $invitation->event_location }}</td>
                                <td>{{ $invitation->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('admin.invitations.edit', $invitation->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.invitations.show', $invitation->id) }}" class="btn btn-info">Detail</a> <!-- Tambahkan ini -->
                                    <form action="{{ route('admin.invitations.destroy', $invitation->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this invitation?')">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop
