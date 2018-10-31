@extends('administration::layouts.master')

@section('content')

    <form method="POST" action="{{ route("admin.users.store") }}">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="login">Login as</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Login as">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@stop