@extends('administration::layouts.master')

@section('title', 'Module Administration')

@section('content')

    <h1>List of Users</h1>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Login as</td>
            <td>Name</td>
            <td>Surname</td>
            <td colspan="3">Actions</td>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->login }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>
                    <a class="btn btn-small btn-success"
                       href="{{ route('admin.users.show', [ 'id' => $user->id ]) }}">Show this User</a>
                </td>
                <td>
                    <a class="btn btn-small btn-info"
                       href="{{ route('admin.users.edit', [ 'id' => $user->id ]) }}">Edit this User</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.users.destroy', [ 'id' => $user->id ]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete this User</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop