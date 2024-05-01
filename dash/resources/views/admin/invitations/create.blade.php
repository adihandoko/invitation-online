<!-- resources/views/admin/invitations/create.blade.php -->

@extends('adminlte::page')

@section('title', 'Add Invitation')

@section('content_header')
    <h1>Add Invitation</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.invitations.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="datetime-local" name="event_date" id="event_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="event_location">Event Location</label>
                    <input type="text" name="event_location" id="event_location" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="category">Event Category:</label>
                    <select name="event_category_id" id="category" class="form-control">
                        @foreach($eventCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop
