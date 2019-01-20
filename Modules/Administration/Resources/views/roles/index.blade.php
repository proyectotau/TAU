@extends('administration::layouts.master')

@section('title', 'Index Role - Module Administration')

@section('content')

    <div class="card">
        <h2 class="card-header">
            List of Roles [{{count($roles)}}]
        </h2>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td colspan="3">Actions</td>
                </tr>
                </thead>
                <tbody>

                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <a class="btn btn-small btn-success"
                               href="{{ route('admin.roles.show', $role->id) }}"
                                        {{ insertTagForDuskTesting('link-show', $role->id, 1) }}
                                    >Show this Role</a>
                        </td>
                        <td>
                            <a class="btn btn-small btn-info"
                               href="{{ route('admin.roles.edit', $role->id) }}"
                                        {{ insertTagForDuskTesting('link-edit', $role->id, 1) }}
                                    >Edit this Role</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                        {{ insertTagForDuskTesting('button-destroy', $role->id, 1) }}
                                    >Delete this Role</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop