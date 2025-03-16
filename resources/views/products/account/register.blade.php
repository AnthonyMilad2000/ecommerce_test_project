@extends('partials.app')

@section('content')
    <section style="margin-top: 10%;" class="section-10">
        <div class="container" style="margin-top: 10%">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger"> <!-- Changed to alert-danger for errors -->
                    {{ Session::get('error') }}
                </div>
            @endif
            
            

            <div class="login-form large-text">     
                <form action="{{ route('processRegister') }}" method="post" name="registrationForm" id="registrationForm">
                    @csrf
                    <h4 class="modal-title mb-5" style="text-align:center;">Register Now</h4>
                    <div class="form-group d-flex justify-content-center">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" id="name" name="name">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" name="password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                  
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark btn-block btn-lg">Register</button>
                    </div>
                </form>			
                <div class="text-center small">Already have an account? <a href="{{ route('login') }}">Login Now</a></div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script type="text/javascript">
    $("#registrationForm").submit(function(event){ 
        event.preventDefault();
        $("button[type='submit']").prop('disabled', true);
        $.ajax({
            url: '{{ route("processRegister") }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response) {
                $("button[type='submit']").prop('disabled', false);

                var errors = response.errors;
                if(response.status == false){
                    // Handling errors for each field
                    if(errors.name){ 
                        $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
                        $("#name").addClass('is-invalid');
                    } else {
                        $("#name").siblings("p").removeClass('invalid-feedback').html('');
                        $("#name").removeClass('is-invalid');
                    }
                    if(errors.email){ 
                        $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                        $("#email").addClass('is-invalid');
                    } else {
                        $("#email").siblings("p").removeClass('invalid-feedback').html('');
                        $("#email").removeClass('is-invalid');
                    }
                    if(errors.password){ 
                        $("#password").siblings("p").addClass('invalid-feedback').html(errors.password);
                        $("#password").addClass('is-invalid');
                    } else {
                        $("#password").siblings("p").removeClass('invalid-feedback').html('');
                        $("#password").removeClass('is-invalid');
                    }
                } else {
                    // Clear previous errors if registration is successful
                    $("#name").siblings("p").removeClass('invalid-feedback').html('');
                    $("#name").removeClass('is-invalid');
                    $("#email").siblings("p").removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid');
                    $("#password").siblings("p").removeClass('invalid-feedback').html('');
                    $("#password").removeClass('is-invalid');
                    window.location.href="{{ route('login') }}";
                }
            },
            error: function(jQXHR, execption) {
                console.log("Something went wrong");
            }
        });
    });
</script>
@endsection
