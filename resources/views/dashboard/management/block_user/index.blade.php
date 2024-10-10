@extends('layouts.dashboardmaster')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Block Users Table</h4>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <form id="herouser{{ $user->id }}" action="{{ route('management.unblock.index', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="form-check form-switch">
                                                    <input onchange="document.querySelector('#herouser{{ $user->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $user->role == $user->role ? 'checked' : '' }}>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('management.edit', $user->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a> --}}
                                            <a href="{{ route('management.delete', $user->id) }}" class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center0"> no user found!!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>
</div>

@endsection

@section('script')

@if (session('unblock'))

<script>
    Toastify({
  text: "{{ (session('unblock')) }}",
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
