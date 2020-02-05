@extends('layouts.admin_layout')
@section('content')
<!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 m-2">View User</h1>
          </div>

          <!-- Content Row -->

          	<div class="container-fluid">
                 @if(Session::has('success'))

                    <div class="alert alert-success">

                        {{ Session::get('success') }}

                        @php

                            Session::forget('success');

                        @endphp

                    </div>

                    @endif

                <p>
          			<a class="btn btn-primary" href="{{ route('manage_users.create') }}">Add New User</a>
          		</p>
          		<div class="card shadow mb-4">
                
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($employee as $u)
                                <tr id="row{{$loop->iteration}}">            
                                    <td>{{ $loop->iteration }} </td>
                                    <td><a href="{{url('profile')}}/{{$u->id}}">{{ $u->name }}</a></td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->company_name }}</td>
                                    <td>
                                        <button class="btn btn-info" data-uname="{{ $u->name }}" data-email="{{ $u->email }}" data-role="{{ $u->user_role }}" data-uid="{{ $u->id }}"  data-toggle="modal" data-target="#EditModal">Edit</button>
                                        <button class="btn btn-danger deleteUserButton" data-uname="{{ $u->name }}?"  data-uid="{{ $u->id }}"  data-toggle="modal" data-target="#DeleteModal">Delete</button>
                                        @if($u->user_status == '0')
                                        <button class="btn btn-success userStatusButton" value="1" data-toggle="modal" id="userStatusButton" data-target="#approveUser">Activate</button>
                                        @else
                                        <button class="btn btn-warning userStatusButton" value="0" data-toggle="modal" id="userStatusButton" data-target="#approveUser">Deactivate</button>
                                        @endif
                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              <!-- delete user modal -->
            <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-danger text-white">
                    <h5 id="modal-title" class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form method="post" action="{{ route('manage_users.destroy','id') }}">
                        @method('DELETE')
                        @csrf
                        
                    <div class="modal-body ">
                    <p class="text-center">Are you sure you want to "remove"</p>
                    <input class=" col-md-12 text-center" type="text" name="user_name" id="u_name" value="" disabled>
                    
                    <input type="hidden" name="user_id" id="u_id" value="">
                    </div>
                    <div class="modal-footer">
                                
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                        <button class="btn btn-danger" type="submit">Yes!</button>
                        
                                
                    </div>
                    </form>
                </div>
                </div>
            </div>

            <!-- approve user modal -->
            <div class="modal fade" id="approveUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-gradient-primary text-white">
                    <h5 id="modal-title" class="modal-title" id="exampleModalLabel">Update!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                    <form method="get" action="{{url('admin/submit-status')}}">
                      @csrf
                      
                  <div class="modal-body ">
                    <p class="text-center">Are you sure you want to <strong>UPDATE</strong></p>
                    <input type="hidden" name="_id" id="_id" value="">
                    <input type="hidden" name="_status" id="_status" value="">

                  </div>
                  <div class="modal-footer">
                                
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                      <button class="btn btn-danger" type="submit">Yes!</button>
                      
                                
                  </div>
                    </form>
                </div>
              </div>
            </div>

            <!-- add new user modal -->

            <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary text-white">
                    <h5 id="modal-title" class="modal-title" id="exampleModalLabel">Edit user</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form method="POST" action="{{ route('manage_users.update','id') }}">
                        @method('PUT')
                        @csrf
                    <div class="modal-body ">
                    
                                    
                                    <input type="hidden" name="user_id" value="">
                                    <div class="form-group row">
                                    
                                        <label class="col-md-3 text-right">name</label>
                                        <div class="col-md-7">
                                            <input id="name" type="text" name="name" value="" class="form-control">

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-3 text-right">email</label>
                                        <div class="col-md-7">
                                            <input id="email" type="email" class="form-control" name="email" value="">


                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-3 text-right">password</label>
                                        <div class="col-md-7">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="reset password....">


                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-md-3 text-right">user role</label>
                                    <div class="col-md-7">
                                <select name="user_role" id="user_role" class="form-control">
                                @foreach ($role as $r)                         
                                    <option value="{{ $r->id }}">{{ $r->role_name }}</option>
                                    @endforeach 
                                </select>
                                </div>
                                </div>

                                                    
                                                
                                </div>
                                    <div class="modal-footer">

                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary"> {{ __('Update') }} </button>
                                
                                    </div>
                                    </form>
                                </div>

                                </div>
                            </div>  


@endsection