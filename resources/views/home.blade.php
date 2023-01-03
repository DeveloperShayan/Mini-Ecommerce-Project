@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Details</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form>
                        <input type="text" value="{{ Auth::user()->name }}" readonly class="form-control text-center text-bg-dark">
                        <input type="email" value="{{ Auth::user()->email }}" readonly class="form-control text-center text-bg-dark">
                        <div><p class="text-center text-bg-dark text-bold">Accout Created : {{ Auth::user()->created_at->diffForHumans() }} </p></div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
