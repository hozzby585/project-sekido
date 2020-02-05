<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assigned_ticket;
use App\Ticket;
use App\User;
use App\Status;
use App\Priority;
use Auth;
use DB;
use App\Role;
use App\Comments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(isset($_GET['id']))
        {   
            Ticket::where('ticket_id',$_GET['id'])
                        ->update(['assign_to'=>$_GET['eid']]);
        }

        $ticket = Ticket::orderBy('status_id')->get();
        $status = Status::all();
        $priority = Priority::all();
        $employees = User::where('user_role', 2)->get();

        return view('admin',compact('employees','ticket','status','priority'));
      
    }
    public function store()
    {
      dd(request('ticket_id')); 
    }

    public function updateCreds(Request $request)
    {
        // dd($request->all());
        $priorityID = Priority::where('priority',$request['priority'])->first();
        // dd($priorityID->priority_id);
        $statusID = Status::where('status_name',$request['status'])->first();
        // dd($statusID->id);
        if($request['assignTo']==null)
        {
            $assignToID = 0;
        }
        else
        {
            $assignTo = User::where('name',$request['assignTo'])->first();
            $assignToID = $assignTo->id;
        }
        // dd($priorityID->priority_id,$statusID->id,$assignToID);
        Ticket::Where('ticket_id',$request['ticket_id'])
                ->update(['priority_id'=>$priorityID->priority_id,
                        'status_id'=>$statusID->id,
                        'assign_to'=>$assignToID]);
        
        return redirect(url('admin'));

    }

    public function ticket($ticketID)
    {
        
        $view = "";
        if(Auth::User()->user_role == 1)
        {
            $view = "layouts.admin_layout";
        }
        else if(Auth::User()->user_role == 2)
        {
            $view = "layouts.employee_layout";
        }
        else if(Auth::User()->user_role == 3)
        {
            
            $view = "layouts.user_layout";
        }
        $comments = Comments::where("ticket_id",$ticketID)->get();
       
        $ticket = Ticket::where('ticket_id',$ticketID)->first();
        return view("ticket",compact('view','ticket','comments'));
    }

    public function profileViewer($profileId)
    {
        $layout = "";
        if(Auth::User()->user_role == 1)
        {
            $layout = "layouts.admin_layout";
        }
        else if(Auth::User()->user_role == 2)
        {
            $layout = "layouts.employee_layout";
        }
        else if(Auth::User()->user_role == 3)
        {
            
            $layout = "layouts.user_layout";
        }

        $data = User::where('id',$profileId)->first();
        $user = $data->only(['name','email','company_name']);

        return view('profile',compact('layout','user'));
    }

    public function viewEmployee()
    {
        $employee = User::where('user_role','2')->get();
        $role = Role::all();
        return view('admin.viewEmployee',compact('employee','role'));
    }

    public function userStatus(Request $request)
    {
        User::Where('id',$request['_id'])
                    ->update(['user_status'=>$request['_status']]);
        return back()->with(['success'=>'Successfully Updated.']);
    }
}
