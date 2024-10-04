@extends('Backend.Layout')
@section('backend_contains')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body p-4">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 class="mb-4">Assign a New Role</h5>
                    <form class="row g-3" action="{{ route('role.store') }}" method="post">
                        @csrf

                        <div class="col-md-12">
                            <label for="input3" class="form-label">Phone</label>
                            <input type="text" name="role_name" class="form-control" id="input3" placeholder="role name">
                        </div>
                       
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                <button type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_js')
    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 1000);
    </script>
@endpush