<?php

namespace App\Http\Controllers;

use App\Models\PublicHoliday;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 *
 */
class PublicHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $holidays = PublicHoliday::paginate(25);
        return  view('public_holiday.index', compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('public_holiday.create');
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
            'name' => 'required',
            'date' => 'required|date'
        ]);

        PublicHoliday::create([
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return redirect()->route('holidays.index')->with('status', 'Public Holiday Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): View|Factory|Application
    {
        $holiday = PublicHoliday::find($id);
       return  view('public_holiday.show' , compact('holiday'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): Application|Factory|View
    {
        $holiday = PublicHoliday::find($id);
        return view('public_holiday.edit', compact('holiday') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date'
        ]);

        $holiday = PublicHoliday::find($id);
        $holiday->update($request->all());

       return redirect()->route('holidays.index')->with('status', 'Public Holiday Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $holiday= PublicHoliday::find($id);
        $holiday->delete();
        return redirect()->route('holidays.index')->with('status','Public Holiday has been deleted successfully');

    }
}
