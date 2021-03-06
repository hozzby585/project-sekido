@extends('layouts.admin_layout')

@section('content')
<!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage tickets</h1>

          </div>

          <!-- Content Row -->

          <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assign To</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assign To</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                          @foreach($ticket as $tickets)
                      
                          <tr  id="row_{{$loop->iteration}}">
                            <td class="rowID">
                              <input type="text" class="custId"  name="ticket_id" hidden value="{{$tickets->ticket_id}}" style="border: none;border-color: transparent;"> {{ $loop->iteration}} </div>
                            </td>
                            <td class="rowSub">{{ $tickets->subject}}</td>
                            <td class="rowDesc">{{ $tickets->description}}</td>
                            <td class="rowPrio">{{ $tickets->priority->priority}}</td>
                            <td class="rowStat @if($tickets->status->status_name == 'Resolved')
                                                    text-success
                                                @else
                                                    text-danger
                                                @endif
                              ">{{ $tickets->status->status_name }}</td>
                            @if(isset($tickets->assigned->name))
                            <td class="rowAssign"><a href="{{url('profile/')}}/{{$tickets->assign_to}}">{{$tickets->assigned->name}}</a></td>
                            @else
                              <td class="rowAssign">None</td>  
                            @endif
                            <td class="actionWidth">
                            @if(isset($tickets->assigned->name))
                                <button type="button" class="modalButton btn btn-primary" data-toggle="modal" onclick="" data-target=".bd-example-modal-lg">Edit</button>
                            @else
                                  <button type="button" class="modalButton btn btn-success" data-toggle="modal" onclick="" data-target=".bd-example-modal-lg">Assign</button>
                            @endif
                            <button type="button" class="viewTicketButton btn btn-warning" >View</button>
                            </td>                   
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>

            </div>
            <!-- Modal content -->
                  <!-- Modal -->
                  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{url('admin/saving-credentials')}}" method="POST">
                          @csrf
                              <table class="table table-bordered table-striped">
                                  <tr>
                                    
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Assign to</th>
                                  </tr>
                                  <tr>
                                  <td class="rowSubModal">
                                  <input type="hidden" id="custId" name="ticket_id" value="">
                                    <input type="text" readonly name="subject" class="form-control-plaintext" id="SubModalId" value="">
                                  </td>
                                  <td class="rowDescModal">
                                      <input type="text" readonly name="description" class="form-control-plaintext" id="DescModalId" value="">
                                  </td>
                                  
                                  <!-- priority -->
                                  <td>
                                    <select class="form-control" name="priority" id="selectPrioId" value="">
                                        @foreach($priority as $prio)
                                            <option value="{{$prio->priority}}">{{$prio->priority}}</option>
                                        @endforeach
                                    </select>
                                  </td>
                                  <!-- status -->
                                  <td>
                                    <select class="form-control" name="status" id="selectStatId" value="">
                                        @foreach($status as $stat)
                                            <option value="{{$stat->status_name}}">{{$stat->status_name}}</option>
                                        @endforeach
                                    </select>
                                  </td>
                                  <!-- Employee -->
                                  <td>
                                    <select class="form-control" name="assignTo" id="selectEmpId" value="">
                                      <option value="" > Choose Employee</option>
                                        @foreach($employees as $emp)
                                            <option value="{{$emp->name}}">{{$emp->name}}</option>
                                        @endforeach
                                    </select>
                                  </td>
                                  
                                  </tr>
                                </table>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" value="Save changes">Save changes</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
            <!-- end modal content -->
            
    
@endsection
