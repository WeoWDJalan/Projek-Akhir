@extends('layouts.master');
@section('title', 'List Products')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (Auth::check() && Auth::user()->role === 'admin')
    <a href="/product/create" class="btn btn-primary my-2">Tambah</a>
    @endif

    <div class="row">
        @forelse ($products as $item)
            <div class="col-4">
                <div class="card">
                    <img src="{{ asset('image/' . $item->image) }}" height="350px" class="card-img-top" alt="...">
                    <div class="card-body">
                    {{-- category --}}
                        <span class="badge text-bg-info my-2">{{ $item->category->name }}</span>
                        {{-- name --}}
                        <h5 class="card-title">{{ $item->name }}</h5>
                        {{-- price --}}
                        <h5 class="text-primary fw-bold">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </h5>
                        {{-- stock --}}
                        <div class="mb-3">
                            <span class="badge bg-primary py-2 px-3">
                                Jumlah Stock: {{ $item->stock }}
                            </span>
                        </div>
                        {{-- description --}}
                        <p class="card-text"> {{ Str::limit($item->description, 100) }}</p>

                    {{-- Read More Button --}}
                        <div class="d-grid mb-2">
                            <a href="/product/{{ $item->id }}" class="btn btn-primary">Read More</a>
                        </div>

                        @if (Auth::check() && Auth::user()->role === 'admin')
                        <div class="row">

                        {{-- Edit Button --}}
                            <div class="col">
                                <div class="d-grid">
                                    <a href="/product/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
                                </div>
                            </div>
                        {{-- Delete Button --}}
                            <div class="col">
                                <form action="/product/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-grid">
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <h4>Product kosong</h4>
        @endforelse

    </div>
@endsection
