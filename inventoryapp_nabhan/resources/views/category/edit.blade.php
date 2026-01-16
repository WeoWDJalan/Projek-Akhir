@extends('layouts.master');
@section('title')
    Edit Categories
@endsection

@section('content')
    <form action="/categories/{{$category->id}}" method="POST">
        @csrf
        @method('PUT')
            {{-- Error Validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- inputan --}}
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $category->description }}</textarea>
            </div>

         <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection