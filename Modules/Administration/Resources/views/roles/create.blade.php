@extends('administration::layouts.master')

@section('title', 'Create Role - Module Administration')

@section('content')

    <div class="card">
        <h2 class="card-header">
            Create Role
        </h2>
        <div class="card-body">
            <form method="POST" action="{{ route("admin.roles.store") }}">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                </div>
                <a class="btn btn-small btn-success"
                   href="{{ route('admin.roles.index') }}"
                            {{ insertTagForDuskTesting('link-back', true, true) }}
                        >Back to Index</a>
                <button type="submit" class="btn btn-primary"
                        {{ insertTagForDuskTesting('button-submit', true, true) }}
                    >Submit</button>
            </form>
        </div>
    </div>

@stop