@extends('partials.app')

@section('content')

    <section style="margin-top: 10%;" class=" section-10">
        <div class="container" style="margin-top:10%">
            @if(Session::has('success'))
            <div class="alert alert-success">
                    {{Session::get('success')}}
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-success">
                    {{Session::get('error')}}
            </div>
            @endif
            
        

<div class="login-form large-text">     
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <h4 class="modal-title mb-5" style="text-align:center; font-size: 22px !important;">Login to Your Account</h4>
        <div class="form-group d-flex justify-content-center">
            <input style="height: 20px; font-size:9px" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
            @error('email')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group d-flex justify-content-center">
            <input style="height: 20px; font-size:9px" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
            @error('password')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group d-flex justify-content-center">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
        <div class="d-flex justify-content-center">
            <input style="width: 30%;" type="submit" class="btn btn-dark btn-block btn-lg" value="Login"> 
        </div>   
                  
    </form>			
    <div class="text-center x-large m-5">Don't have an account? <a href="{{ route('register') }}">Sign up</a></div>
</div>

        </div>
    </section>
    @endsection