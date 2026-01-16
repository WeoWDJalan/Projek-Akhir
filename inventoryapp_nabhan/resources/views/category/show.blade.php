@extends('layouts.master');
@section('title')
    List Of Categories
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="/categories/create" class="btn btn-primary my-2">Tambah</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $item)
                <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name }}</td>
                    <td>

                        <form action="/categories/{{ $item->id }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <a href="/categories/{{ $item->id }}" class="btn btn-info btn-sm">Details</a>
                            <a href="/categories/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <input type="submit" class="btn btn-danger btn-sm " value="Delete">
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Data Category Kosong, silahkan tambah category</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection