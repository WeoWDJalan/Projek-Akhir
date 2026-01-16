@extends('layouts.master');
@section('title')
    Detail Categories
@endsection

@section('content')
    <h1 class="text-primary">{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($category->products as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td><a href="/product/{{ $item->id }}" class="btn btn-info btn-sm">View</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No Products in this Category</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="/categories" class="btn btn-secondary my-2">Back</a>
@endsection