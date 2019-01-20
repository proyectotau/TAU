@extends('administration::layouts.master')

@section('title', 'Show Group - Module Administration')

@section('content')

    <div class="card">
        <h2 class="card-header">
            Show Group
        </h2>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $group->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="surname">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $group->description }}" disabled>
                </div>
                <a class="btn btn-small btn-success"
                   href="{{ route('admin.groups.index') }}" {{ insertTagForDuskTesting('link-back') }}>Back to Index</a>
                <a class="btn btn-small btn-info"
                   href="{{ route('admin.groups.edit', $group->id) }}" {{ insertTagForDuskTesting('link-edit') }}>Edit this Group</a>
            </form>
        </div>
    </div>

@stop