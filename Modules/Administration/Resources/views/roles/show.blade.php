@extends('administration::layouts.master')

@section('title', 'Show Role - Module Administration')

@section('content')

    <div class="card">
        <h2 class="card-header">
            Show Role
        </h2>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $role->description }}" disabled>
                </div>
                <a class="btn btn-small btn-success"
                   href="{{ route('admin.roles.index') }}" {{ insertTagForDuskTesting('link-back') }}>Back to Index</a>
                <a class="btn btn-small btn-info"
                   href="{{ route('admin.roles.edit', $role->id) }}" {{ insertTagForDuskTesting('link-edit') }}>Edit this Role</a>
            </form>
        </div>
    </div>

@stop