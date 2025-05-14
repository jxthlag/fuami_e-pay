@extends('layouts.master')

@section('header')
    Add New Student
@endsection

@section('content')

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    });
</script>
@endif

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toast.fire({
            icon: 'error',
            title: '{{ $errors->first() }}'
        });
    });
</script>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student Registration</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
     {{--                <!-- Profile Picture Upload -->
                    <div class="text-center">
                        <img id="profilePreview" src="{{ asset('dist/img/user2-160x160.jpg') }}" 
                            class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        <div class="mt-2">
                            <label for="profile_picture" class="btn btn-outline-primary">
                                <i class="fas fa-upload"></i> Upload Picture
                            </label>
                            <input type="file" id="profile_picture" name="profile_picture" class="d-none" accept="image/*">
                        </div>
                    </div> --}}

                    <!-- Personal Information -->
                    <div class="row mt-4">
                        <div class="form-group col-md-4">
                  



<x-form.int-field label="LRN (Learner Reference Number)" name="lrn" maxlength="13" />


                        </div>
                        <div class="form-group col-md-4">
                            <x-form.string-field label="First Name" name="firstname" maxlength="26" />
                        </div>
                        <div class="form-group col-md-4">
                            <x-form.string-field label="Last Name" name="lastname" maxlength="26" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                    


                            <x-form.int-field label="Phone Number" name="phone_number" maxlength="12" />
                        </div>
                        <div class="form-group col-md-4">
                   


                            <x-form.birthdate label="Date of Birth" name="birthdate" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
             
                            <x-form.string-field label="Nationality" name="nationality" maxlength="26" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <h5 class="mt-4">Account Information</h5>
                    <div class="row">
                        <div class="form-group col-md-6">
<x-form.username label="Username" name="username" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <x-form.password required />
                        </div>
               <div class="form-group col-md-6">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    <small id="confirm-password-warning" class="text-danger d-none">
        *Passwords do not match.
    </small>
</div>



                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5">Register Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Preview Profile Picture -->
<script>
    document.getElementById('profile_picture').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const warning = document.getElementById('confirm-password-warning');

    function validateMatch() {
        if (confirm.value !== password.value) {
            warning.classList.remove('d-none');
        } else {
            warning.classList.add('d-none');
        }
    }

    confirm.addEventListener('input', validateMatch);
    password.addEventListener('input', validateMatch);
});
</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form'); // adjust selector if needed
    const requiredFields = form.querySelectorAll('[required]');

    form.addEventListener('submit', function (e) {
        let hasError = false;

        requiredFields.forEach(field => {
            const errorFeedback = field.nextElementSibling;
            if (!field.value.trim()) {
                field.classList.add('is-invalid');

                // Show a default error if not already provided by Laravel
                if (errorFeedback && !errorFeedback.classList.contains('invalid-feedback')) {
                    const div = document.createElement('div');
                    div.className = 'invalid-feedback';
                    div.innerText = 'This field is required.';
                    field.after(div);
                }

                hasError = true;
            } else {
                field.classList.remove('is-invalid');
                if (errorFeedback && errorFeedback.classList.contains('invalid-feedback')) {
                    errorFeedback.remove();
                }
            }
        });

        if (hasError) {
            e.preventDefault(); // Stop form submission
        }
    });
});
</script>


@endsection
