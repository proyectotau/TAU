@extends('administration::layouts.master')

@section('title', 'Index User - Module Administration')

@section('content')

    <div class="card">
        <h2 class="card-header">
            List of Users [{{count($users)}}]
        </h2>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Login as</td>
                    <td>Name</td>
                    <td>Surname</td>
                    <td colspan="3">Actions</td>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>
                            <a class="btn btn-small btn-success"
                               href="{{ route('admin.users.show', $user->id) }}"
                                        {{ insertTagForDuskTesting('link-show', $user->id, 1) }}
                                    >Show this User</a>
                        </td>
                        <td>
                            <a class="btn btn-small btn-info"
                               href="{{ route('admin.users.edit', $user->id) }}"
                                        {{ insertTagForDuskTesting('link-edit', $user->id, 1) }}
                                    >Edit this User</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                        {{ insertTagForDuskTesting('button-destroy', $user->id, 1) }}
                                    >Delete this User</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@stop