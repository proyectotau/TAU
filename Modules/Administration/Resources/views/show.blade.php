@extends('administration::layouts.master')

@section('content')

    <div class="card">
        <h2 class="card-header">
            Show User
        </h2>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="login">Login as</label>
                    <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}" disabled>
                </div>
                <a class="btn btn-small btn-success"
                   href="{{ route('admin.users.index') }}" {{ insertTagForDuskTesting('link-back') }}>Back to Index</a>
                <a class="btn btn-small btn-info"
                   href="{{ route('admin.users.edit', $user->id) }}" {{ insertTagForDuskTesting('link-edit') }}>Edit this User</a>
            </form>
        </div>
    </div>

@stop