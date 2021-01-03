@extends('root')


@section('content')
<div class = "card">
    <h5 class="card-header">Forgot Password</h5>
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
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name = "email" class="form-control" id="exampleInputPassword1" placeholder="Email">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection