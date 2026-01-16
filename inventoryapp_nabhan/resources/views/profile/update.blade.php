@extends('layouts.master');
@section('title', 'Update Profile')

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
    
{{-- Success Message --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/profile" method="POST">
        @csrf
        @method("PUT")
        {{-- inputan --}}
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $profile->age) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea name="bio" class="form-control" id="" cols="30" rows="10">{{ old('bio', $profile->bio) }}</textarea>
        </div> 
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection