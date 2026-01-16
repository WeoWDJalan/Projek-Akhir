    @extends('layouts.master')

    @section('title')
    <title>Welcome</title>
    @endsection

    @section('content')
    <h1>SELAMAT DATANG {{ $firstname }} {{ $lastname }} !</h1>
    <h2>Terima kasih telah bergabung di SanberBook. Social Media kita bersama!</h2>
    @endsection