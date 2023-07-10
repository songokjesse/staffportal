<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveApprover;
use App\Models\ManagementCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ApproverController
{
    public function index(): Factory|View|Application
    {
        $approvers =LeaveApprover::with(['staffCategory', 'approverCategory'])->get();
        $management_categories = ManagementCategory::all();
        return view('admin.approvers.index', compact('management_categories', 'approvers'));
    }

    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate([
            'staff_category' => 'required',
            'approver' => 'required'
        ]);
        LeaveApprover::updateOrCreate(
            ['staff_category' => $request->staff_category],
            $request->all()
        );
        return redirect()->route('approvers.index')->with('status', 'Approver added Successfully');
    }
}
