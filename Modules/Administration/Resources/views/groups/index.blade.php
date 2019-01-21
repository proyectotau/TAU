@extends('administration::layouts.master')

@section('title', 'Index Group - Module Administration')

@section('content')

    <div class="card">
        <h2 class="card-header">
            List of Groups [{{count($groups)}}]
        </h2>

        <div class="card-body">
           @include('administration::partials._searchByCriteria', ['onObject' => 'groups', 'criteria' => $criteria ])

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

                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        <td>
                            <a class="btn btn-small btn-success"
                               href="{{ route('admin.groups.show', $group->id) }}"
                                        {{ insertTagForDuskTesting('link-show', $group->id, 1) }}
                                    >Show this Group</a>
                        </td>
                        <td>
                            <a class="btn btn-small btn-info"
                               href="{{ route('admin.groups.edit', $group->id) }}"
                                        {{ insertTagForDuskTesting('link-edit', $group->id, 1) }}
                                    >Edit this Group</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.groups.destroy', $group->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                        {{ insertTagForDuskTesting('button-destroy', $group->id, 1) }}
                                    >Delete this Group</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop