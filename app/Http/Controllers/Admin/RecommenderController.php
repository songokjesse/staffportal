<?php

namespace App\Http\Controllers\Admin;

use App\Models\LeaveRecommender;
use App\Models\ManagementCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class RecommenderController
{
    public function index(): Factory|View|Application
    {
        $recommenders =LeaveRecommender::with(['staffCategory', 'recommenderCategory'])->get();
        $management_categories = ManagementCategory::all();
        return view('admin.recommenders.index', compact('recommenders', 'management_categories'));
    }

    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate([
            'staff_category' => 'required',
            'recommender' => 'required'
        ]);
        LeaveRecommender::updateOrCreate(
            ['staff_category' => $request->staff_category],
            $request->all()
        );
        return redirect()->route('recommenders.index')->with('status', 'Recommender Added Successfully');
    }
}
