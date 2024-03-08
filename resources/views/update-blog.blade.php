@extends('layouts.partials.master')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Display error messages -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="d-flex align-items-center justify-content-center vh-100">
<div class="container mt-2 " >
    <div class="card col-md-6">
        <div class="card-body">
            <h5 class="card-title">Edit Blog</h5>
            <form   method="POST" action="{{ route('blogs.update', ['id' => $blog->id]) }}">
            @csrf
    @method('PUT')
                <div class="form-group">
                    <input type="hidden" name="id" id="" value="{{$blog->id}}">
                    <label for="inputField">Blog Title</label>
                    <input type="text"  name="name" class="form-control" id="inputField" placeholder="Enter text" value="{{$blog->name}}">
                </div>
                <div class="form-group">
                    <label for="statusDropdown">Status:</label>
                    <select class="form-control" id="statusDropdown" name=status>
                        <option value="" disabled selected>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


@endsection