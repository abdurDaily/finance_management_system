@extends('Backend.Layout')
@section('backend_contains')
    <div class="row">

        {{-- ROLE --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body p-4">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 class="mb-4">Add a New Role</h5>
                    <form class="row g-3" action="{{ route('role.store') }}" method="post">
                        @csrf

                        <div class="col-md-12">
                            <label for="input3" class="form-label">Phone</label>
                            <input type="text" name="role_name" class="form-control" id="input3" placeholder="role name">
                            @error('role_name')
                                <strong class="text-danger" id="error-message">{{ $message }}</strong>
                            @enderror
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
        {{-- PERMISSION --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body p-4">

                    @if(session()->has('permission'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('permission') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <h5 class="mb-4">Add a new permission</h5>
                    <form class="row g-3" action="{{ route('role.store.permission') }}" method="post">
                        @csrf

                        <div class="col-md-12">
                            <label for="input3" class="form-label">Phone</label>
                            <input type="text" name="permission_name" class="form-control" id="input3" placeholder="role name">
                            @error('permission_name')
                                <strong class="text-danger" id="error-message">{{ $message }}</strong>
                            @enderror
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


        {{-- ROLE TABLE --}}
        <div class="col-lg-12">
            <div class="card p-3 table-responsive">
                @if(session()->has('deleteRole'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('deleteRole') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session()->has('permissionAssin'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('permissionAssin') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table table-bordered  table-hover table-striped ">
                    <thead>
                        <tr>
                            <th scope="col">SN.</th>
                            <th scope="col">Role's</th>
                            <th scope="col">Permission's</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $key => $role)
                        <tr>
                            <th scope="row"> {{ ++$key }} </th>
                            <td>{{ $role->name }}</td>
                            <td>
                                

                                  @forelse ($role->permissions as $permission)
                                     <span>{{ $permission->name }} 
                                         @if (!$loop->last)
                                           <span> | </span>
                                         @endif 
                                     </span>
                                  @empty
                                      <span>no permission found!</span>
                                  @endforelse
                                  {{-- {{ $role->permissions as $permission }} --}}
                            </td>
                            <td>
                                <div class="btn-groupp">
                                    <a href="#" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    @canany(['delete', 'edit'])
                                        <a href="{{ route('role.delete',$role->id) }}" ><svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-primary"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                        <a href="#"  data-bs-toggle="modal" data-bs-target="#permissionRole" onclick="setRoleId({{ $role->id }}, {{ json_encode(collect($role->permissions)->pluck('id')->toArray()) }})"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square text-primary"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></a>
                                    @endcanany
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="3">No data found!</td></tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>






        {{-- MODAL --}}
        <!-- Button trigger modal -->
  
        <!-- Modal -->
        <div class="modal fade" id="permissionRole" tabindex="-1" aria-labelledby="permissionRoleLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="permissionRoleLabel">Give Permission's</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('role.assign.permissions') }}" method="post" >
                        @csrf
                        <input type="hidden" name="role_id" id="role_id" value="">
                        <div class="row">
                            @foreach ($allPermissions as $permission)
                                <div class="col-lg-6 card p-3">
                                    <div class="form-check ">
                                        <input class="permissionCheckbox form-check-input" type="checkbox" value="{{ $permission->id }}" name="permissions[]" id="permission_{{ $permission->id }}" >
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            &nbsp; {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn  btn-primary mb-3 w-100 border-0">submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL END --}}
    </div>
@endsection

@push('backend_js')
    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 2000);

        setTimeout(function() {
            document.getElementById("error-message").remove();
        }, 2000); // 3000 milliseconds = 3 seconds

    function setRoleId(roleId, permissions) {
        document.getElementById("role_id").value = roleId;
        
        
        $('.permissionCheckbox').each((index,checkbox)=>{
            let isExists = Object.values(permissions).includes(Number(checkbox.value));
            isExists ? checkbox.checked = true :  checkbox.checked  = false;
            
            // console.log(permissions.contains(checkbox.value));
            
            
            // checkbox.prop('checked', true)
            
        })
        
    }
    
</script>
@endpush