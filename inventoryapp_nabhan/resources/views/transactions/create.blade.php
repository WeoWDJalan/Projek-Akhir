@extends('layouts.master');
@section('title', 'Create Transaction')

@section('content')
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

    <form action="/transaction" method="POST">
        @csrf
        {{-- Select Product --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <select name="products_id" class="form-control">
                <option value="">-- Select product --</option>
                @forelse ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @empty
                    <option value="">No Category Available</option>
                @endforelse
            </select>
        </div>

        {{-- Select Type Cek Ini--}}
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-control">
                <option value="">-- Select Type --</option>
                <option value="in">In</option>
                <option value="out">Out</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">amount</label>
            <input type="number" name="stock" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Note</label>
            <textarea name="note" class="form-control" id="" cols="30" rows="2"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection