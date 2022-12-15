<?php

namespace App\Http\Controllers;


use App\Models\Requisition;
use App\Models\RequisitionAssignment;
use App\Models\RequisitionComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        $assignment = DB::table('requisition_assignments')
            ->join('profiles', 'requisition_assignments.department_id', '=', 'profiles.department_id')
            ->where('profiles.user_id', Auth::user()->id)
            ->pluck('requisition_id');

        $requisitions = Requisition::with('department', 'user')->whereIn('id', $assignment )->get();
       return view('requisition.approval.index', compact('requisitions'));

    }

    public function show($id)
    {
        $comments = RequisitionComment::where('requisition_id', $id)->get();
        $requisitions = Requisition::with('department', 'user', 'requisition_items')->where('id', $id )->get();
        return view('requisition.approval.show', compact('requisitions', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = new RequisitionComment;
        $comment->comment = $request['comment'];
        $comment->requisition_id = $request['requisition_id'];
        $comment->user_id = Auth::user()->id;
        $comment->save();

        DB::table('requisition_assignments')
            ->where('requisition_id', $request['requisition_id'])
            ->update(['status' => $request['status']]);

        return redirect()->route('approvals.show',  $request['requisition_id'])
            ->with('status','Approval Comments Added successfully.');

    }
}
