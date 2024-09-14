@extends('layouts.dashboardmaster')

@section('content')


<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Name Update</h4>

                <form role="form" action="{{ route('profile.username') }}" method="POST">
                    @csrf

                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your name">
                        @error('name')
                           <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary col-lg-12">Update</button>
                </form>
            </div>
        </div>
    </div>

    {{-- email Update --}}

    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Email Update</h4>

                <form role="form" action="{{ route('profile.email') }}" method="POST">
                    @csrf

                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your email">
                        @error('email')
                           <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary col-lg-12">Update</button>
                </form>
            </div>
        </div>
    </div>

</div>


@endsection

@section('script')

<script>
    const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: "Signed in successfully"
});
</script>

@if (session('email_update'))

<script>
    Toastify({
  text: "{{ (session('email_update')) }}",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  },
  onClick: function(){} // Callback after click
}).showToast();
</script>

@endif

@endsection
