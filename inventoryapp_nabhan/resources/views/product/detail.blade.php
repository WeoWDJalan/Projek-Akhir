@extends('layouts.master');
@section('title', 'Detail Products')

@section('content')
    <img src="{{ asset('image/'. $product->image) }}" class="d-block mx-auto" height="800px" width="800px" alt="">
    <h3 class="text-primary font-weight-bold">{{ $product->name }}</h3>
    <h4 class="text-info font-weight-bold">
        Price: Rp. {{ number_format($product->price, 0, ',', '.') }}
    </h4>
    <p class="text-muted mb-1">Stock: {{ $product->stock }}</p>
    <p class="text-muted text-justify mb-4">{{ $product->description }}</p>
    <a href="/product" class="btn btn-dark mt-3">Kembali</a>
@endsection