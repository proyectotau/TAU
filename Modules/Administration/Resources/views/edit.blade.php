@extends('administration::layouts.master')

@section('content')

    <div class="card">
        <h2 class="card-header">
            Edit User
        </h2>
        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.update", ['id' =>  $user->id]) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="login">Login as</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Login as" value="{{ $user->login }}">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ $user->surname }}">
                </div>
                <a class="btn btn-small btn-success"
                   href="{{ route('admin.users.index') }}" {{ insertTagForDuskTesting('link-back') }}>Back to Index</a>
                <button type="submit" class="btn btn-primary" {{ insertTagForDuskTesting('button-submit') }}>Submit</button>
            </form>
        </div>
    </div>

@stop