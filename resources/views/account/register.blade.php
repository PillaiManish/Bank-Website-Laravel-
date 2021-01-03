@extends('root')
@section('content')
<div class = "card">
    <h5 class="card-header">Register Form</h5>
    <br>
    <form method = "POST">
        @csrf

        {{-- Form Error Display --}}
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif

        <div class="form-group">
        <label for="exampleInputName">Name</label>
        <input type="text" name = "name" class="form-control" id="exampleInputName1" placeholder="Enter name">
        </div>

        <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name = "password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        
        <div class="form-group">
        <label for="exampleInputPassword2">Confirm Password</label>
        <input type="password" name = "password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection