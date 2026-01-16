    @extends('layouts.master')

    @section('title')
    Buat Account Baru!
    @endsection

    @section('content')
    <h3>Sign Up Form</h3>
    <br>
    
    <form action="/welcome" method="post">
        @csrf
        <label>First Name:</label> <br>
        <input type="text" name="first_name" required> <br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" required><br><br>

        <label>Gender:</label><br>
        <input type="radio" name="gender" value="male"> Male <br>
        <input type="radio" name="gender" value="female"> Female <br>
        <input type="radio" name="gender" value="other"> Others <br><br>

        <label>Nationality:</label><br>
        <select name="nationality">
            <option value="indonesia">Indonesia</option>
            <option value="malaysia">Malaysia</option>
            <option value="singapore">Singapore</option>
        </select> <br><br>

        <label>Language Spoken:</label><br>
        <input type="checkbox" name="language" value="bahasa_indonesia"> Bahasa <br>
        <input type="checkbox" name="language" value="english"> English <br>
        <input type="checkbox" name="language" value="others"> Others <br><br>

        <label>Bio:</label><br>
        <textarea name="bio" cols="30" rows="10"></textarea> <br>

        <input type="submit" value="Sign Up">
    </form>
    @endsection