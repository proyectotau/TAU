@extends('administration::layouts.master')

@section('title', 'Edit Group - Module Administration')

@section('content')

    <div class="card">
        <h2 class="card-header">
            Edit Group
        </h2>
        <div class="card-body">
            <form method="POST" action="{{ route("admin.groups.update", ['id' =>  $group->id]) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $group->name }}">
                </div>
                <div class="form-group">
                    <label for="surname">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ $group->description }}">
                </div>
                <a class="btn btn-small btn-success"
                   href="{{ route('admin.groups.index') }}" {{ insertTagForDuskTesting('link-back') }}>Back to Index</a>
                <button type="submit" class="btn btn-primary" {{ insertTagForDuskTesting('button-submit') }}>Submit</button>
            </form>
        </div>
    </div>

@stop