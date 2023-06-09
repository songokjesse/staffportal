<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $job_titles = JobTitle::paginate(50);
        return view('admin.job_title.index', compact('job_titles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return  view('admin.job_title.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:job_titles'
        ]);

        JobTitle::create($request->all());
        return redirect()->route('job_titles.index')
            ->with('status','Job Title created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $job_title = JobTitle::find($id);
        return view('admin.job_title.edit', compact('job_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $title = JobTitle::findOrFail($id);

        $validator = $request->validate([
            'name' => [
                'required',
            ],
        ]);

        $title->name = $request->input('name');
        $title->save();

        // Redirect to success page or perform any other action
        return redirect()->route('job_titles.index')->with('status','Job Title Edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JobTitle $jobTitle
     * @return RedirectResponse
     */
    public function destroy(JobTitle $jobTitle)
    {
        $jobTitle->delete();
        return redirect()->route('job_titles.index')
            ->with('status','Job Title deleted successfully');
    }
}
