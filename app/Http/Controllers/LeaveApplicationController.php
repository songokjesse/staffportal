<?php

namespace App\Http\Controllers;


use App\Models\LeaveAllocation;
use App\Models\LeaveApplication;
use App\Models\LeaveRecommendation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MBarlow\Megaphone\Types\Important;
use SebastianBergmann\Type\FalseType;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $leaves = LeaveApplication::where('user_id', Auth::user()->id)->get();
        return view('leave_application.index', compact('leaves'));
    }

    public function create()
    {
        $users = User::all();
        $leave_allocation = LeaveAllocation::where('user_id', Auth::user()->id)->with('leaveType')->get();
        return view('leave_application.create', compact('leave_allocation', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_categories_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'days' => 'required',
            'duties_by_user_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'recommend_user_id' => 'required'
        ]);

        $leave_applicaiton = New LeaveApplication();
        $leave_applicaiton->leave_categories_id = strtok($request->leave_categories_id, '.');
        $leave_applicaiton->user_id = Auth::user()->id;
        $leave_applicaiton->days = $request->days;
        $leave_applicaiton->start_date = $request->start_date;
        $leave_applicaiton->end_date = $request->end_date;
        $leave_applicaiton->duties_by_user_id = $request->duties_by_user_id;
        $leave_applicaiton->phone = $request->phone;
        $leave_applicaiton->email = $request->email;
        $leave_applicaiton->status = False;
        $leave_applicaiton->save();

        $recommendation = new LeaveRecommendation();
        $recommendation->user_id = $request->recommend_user_id;
        $recommendation->leave_application_id = $leave_applicaiton->id;
        $recommendation->recommendation = False;
        $recommendation->save();

        $notification = new Important(
            'Leave Application', // Notification Title
            'An application for Leave has been made by '.Auth::user()->name. 'You have been selected as the HOD to recommend or Not recommend the Leave Application ', // Notification Body
            'http://'. env('APP_URL', 'http://localhost').'/leave_recommendation/', // Optional: URL. Megaphone will add a link to this URL within the Notification display.
//            'Read More...' // Optional: Link Text. The text that will be shown on the link button.
        );

        $user = User::find(1);
        $user->notify($notification);

        return redirect()->route('leave_application.index')
            ->with('status','Leave Application Submitted successfully.');
    }

    public function show($id)
    {

    }
}
