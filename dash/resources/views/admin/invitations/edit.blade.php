<!-- resources/views/admin/invitations/edit.blade.php -->

@extends('adminlte::page')

@section('title', 'Edit Invitation')

@section('content_header')
    <h1>Edit Invitation</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.invitations.update', $invitation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $invitation->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $invitation->email }}" required>
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="datetime-local" name="event_date" id="event_date" class="form-control" value="{{ $invitation->event_date }}" required>
                </div>
                <div class="form-group">
                    <label for="event_location">Event Location</label>
                    <input type="text" name="event_location" id="event_location" class="form-control" value="{{ $invitation->event_location }}" required>
                </div>
                <div class="form-group">
                    <label for="event_category_id">Event Category</label>
                    <select name="event_category_id" id="event_category_id" class="form-control" required>
                        @foreach($eventCategories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $invitation->eventCategory->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Invitation</button>
            </form>
        </div>
    </div>
@stop
