@extends('root')

@section('content')
<div class = "card">
    <h5 class="card-header">Add Money In Wallet</h5>
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
        <label for="exampleInputNumber1">Amount</label>
        <input type="number" name = "amount" class="form-control" id="exampleInputEmail1" placeholder="Enter amount">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection