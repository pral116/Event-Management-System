@extends('layouts.admin-app')
@section('content')

    <div class="content-container">
        <div class="container-fluid">

            <div class="text-center">
                @if (Session::has('success'))
                    <div class="fw-bold text-success" style="font-size:30px;">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>                        
                @endif
            </div>

            <a href="{{ route('admin.show-staff') }}" class="btn btn-outline-secondary">&larr;</a>
            <h3>Add new staff</h3> 

            <div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        {{-- <button type="button" class="close" data-dismiss="close">×</button> --}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="pt-20">
                <form method="POST" action="{{ route('admin.store-staff') }}" class="m-3">
                    @csrf
                    <div class="block">
                        <div class="">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control block shadow-sm w-50 italic" value="{{ old('name') }}">
                        </div>
        
                        <div class="mt-3">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control block shadow-sm w-50 italic" value="{{ old('address') }}">
                        </div>
        
                        <div class="mt-3">
                            <label for="">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Male" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">Female</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Others" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">Others</label>
                            </div>
                        </div>
        
                        <div class="mt-3">
                            <label for="">Phone</label>
                            <input type="tel" name="phone" class="form-control block shadow-sm w-50 italic" pattern="98[0-9]{8}" value="{{ old('phone') }}">
                        </div>
        
                        <div class="mt-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control block shadow-sm w-50 italic" value="{{ old('email') }}">
                        </div>
                    
                        <div class="mt-3">
                            <input type="submit" value="Done" class="btn btn-lg btn-primary">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    
<script>
    (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})();
</script>
    
@endsection