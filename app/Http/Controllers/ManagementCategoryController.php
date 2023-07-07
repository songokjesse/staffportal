<?php

namespace App\Http\Controllers;

use App\Models\ManagementCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManagementCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $management_categories = ManagementCategory::all();
        return view("management_categories/index", compact('management_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return  view('management_categories/create');
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
            'name' => 'required'
        ]);

        ManagementCategory::create([
            'name' => $request->name
        ]);

        return redirect()->route('management_categories.index')->with('status', 'Management Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $management_category = ManagementCategory::find($id);
        return view('management_categories.edit', compact('management_category'));
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
        $request->validate([
            'name' => 'required'
        ]);
        $management_category = ManagementCategory::findOrFail($id);
        $management_category->name = $request['name'];
        $management_category->save();
        return redirect()->route('management_categories.index')->with('status', 'Management Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
