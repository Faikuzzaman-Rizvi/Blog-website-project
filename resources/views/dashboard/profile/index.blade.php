@extends('layouts.dashboardmaster')

@section('content')


<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Name Update</h4>

                <form role="form" action="{{ route('profile.username') }}" method="POST">
                    @csrf

                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your name">
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

    <div class="col-lg-6">
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

    {{-- password update --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Password Update</h4>

                <form role="form" action="{{ route('profile.password') }}" method="POST">
                    @csrf

                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Current Password</label>
                        <input type="password" name="c_password" class="form-control @error('c_password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your current password">
                        @error('c_password')
                           <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="exampleInputEmail1" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your new password">
                        @error('password')
                           <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="exampleInputEmail1" class="form-label">Corfirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your confirm password">

                    </div>
                    <button type="submit" class="btn btn-primary col-lg-12">Update</button>
                </form>
            </div>
        </div>
    </div>

        {{-- email Update --}}

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Image Update</h4>

                    <form role="form" action="{{ route('profile.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('image')
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

@if (session('name_update'))

<script>
    Toastify({
  text: "{{ (session('name_update')) }}",
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

@if (session('password_update'))

<script>
    Toastify({
  text: "{{ (session('password_update')) }}",
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

@if (session('image_update'))

<script>
    Toastify({
  text: "{{ (session('image_update')) }}",
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
