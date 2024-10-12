@extends('layouts.dashboardmaster')

@section('title')
Blog
@endsection

@section('content')


<x-breadcum rizvi="Blog's Show Page"></x-breadcum>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($blogs as $blog)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                            <img
                            src="{{ asset('uploads/blog') }}/{{ $blog->thumnail }}"
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                            />
                          <div class="ms-3">
                            <p class="fw-bold mb-1">{{ $blog->slug }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="fw-normal mb-1">{{ $blog->title }}</p>
                      </td>
                      <td>
                        <p class="fw-normal mb-1">{{ $blog->onecategory->title }}</p>
                      </td>
                      <td>
                        <form id="statusid{{ $blog->id }}" action="{{ route('category.status',$blog->id) }}" method="POST">
                            @csrf

                        <div class="form-check form-switch">
                            <input onchange="document.querySelector('#statusid{{ $blog->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blog->status == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheckChecked">{{ $blog->status }}</label>
                          </div>
                        </form>
                      </td>
                      <td>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#blogshow{{ $blog->id }}" class="btn btn-link btn-sm btn-rounded text-warning">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="{{ route('blog.edit', $blog->id) }}"
                            class="btn btn-outline-info waves-effect waves-light">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger waves-effect waves-light">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                      </td>
                    </tr>

                 {{-- Show Info --}}
                    <div class="modal fade" id="blogshow{{ $blog->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{ $blog->title }}/h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               Title - {{ $blog->title }}
                               Slug - {{ $blog->slug }}
                               Category Title -{{ $blog->onecategory->title }}
                               Description - {!! $blog->description !!}

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    @empty

                    <tr>
                        <td colspan="4" class="text-danger text-center">categories not found</td>
                    </tr>

                  @endforelse
                </tbody>
                {{ $blogs->links() }}
              </table>
        </div>
    </div>
</div>




@endsection


@section('script')

@if (session('success'))

<script>
    Toastify({
  text: "{{ (session('success')) }}",
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

