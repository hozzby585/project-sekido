@extends('layouts.user_layout')

@section('content')
<!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 m-2">View Tickets</h1>
            <div class="form-group col-sm-2">
              <label for="categorySelect">Category</label>
              <form name="PostName" action="{{url('/category')}}" method="get">
                <select id="categorySelect" name="category"  class="form-control catSelectChange">
                  <option selected="selected" value="0">All</option>
                  @foreach($category as $cat)
                  <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                  @endforeach
                </select>
              </form>
            </div>
          </div>

          

          <!-- Content Row -->
          <section class="content">
          <div class="container-fluid">


            <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <!-- dropdown -->
        
        <!-- enddropdown -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered tableIsotope" id="dataTable" width="100%" cellspacing="0">
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
                @if(isset($ticket))

                @foreach($ticket as $data)
                <tr id="row{{$loop->iteration}}">
                    <td> <input type="hidden" class="hidden-ticket" value="{{$data->ticket_id}}">
                      {{$loop->iteration}}</td>
                    <td>{{$data->subject}}</td>
                    <td class="ellipsis" style="text-overflow:ellipsis">{{$data->description}}</td>

                    @if($data->priority->priority == 'LESS')
                      <td class="text-primary">{{$data->priority->priority}}</td>
                      @elseif($data->priority->priority == 'NORMAL')
                      <td class="text-warning">{{$data->priority->priority}}</td>
                      @else
                      <td class="text-danger">{{$data->priority->priority}}</td> 
                    @endif

                    @if($data->status->status_name == 'Resolved')
                      <td class="text-success">{{$data->status->status_name}}</td>
                      @else
                      <td class="text-danger">{{$data->status->status_name}}</td>
                    @endif
                    
                    @if(isset($data->assigned->name))
                      <td class="rowAssign text-gray-900">
                      <a href="{{url('profile')}}/{{$data->assign_to}}">{{$data->assigned->name}}</a></td>
                    @else
                      <td class="rowAssign">Pending..</td>  
                    @endif
                    <td class="actionWidth">
                      @if($data->status->id == 2)
                      <button type="text" class="btn btn-danger statusUpdate2" data-toggle="modal" data-target="#statusUpdate"  name="status" value="1">Not Resolve</button>
                      @else
                          <button type="text" class="btn btn-success statusUpdate2" data-toggle="modal" data-target="#statusUpdate"  name="status" value="2">Solve</button>
                      @endif
                      <button type="button" class="viewTicketButton btn btn-warning" >View</button>
                    </td>
                  @endforeach
                </tr>
                
                @endif
                  </tbody>
                </table>
                </div>
            </div>
        </div>

        </div>

              <!-- modal -->
              <div class="modal fade" id="statusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="{{url('/submit')}}" method="POST">
              @csrf
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" value="" name="ticket_id" id="ticket_id">
                      <input type="hidden" value="" name="status_id" id="status_id">

                      Are you sure you want to update the status ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- endmodal -->
            



          </section>
    
@endsection
