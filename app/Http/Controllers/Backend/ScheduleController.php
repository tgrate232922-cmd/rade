<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Support\ScheduleInterval;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:schedule-manage');
    }

    public function index(): Application|Factory|View
    {
        $schedules = Schedule::all()->sortBy('time');

        return view('backend.schedule.index', compact('schedules'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'time' => 'required|integer|min:0',
            'time_unit' => ['required', Rule::in(ScheduleInterval::SCHEDULE_UNITS)],
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        Schedule::create($request->only('name', 'time', 'time_unit'));
        notify()->success('Schedule created successfully');

        return redirect()->route('admin.schedule.index');
    }

    public function edit($id): Schedule
    {
        return Schedule::find($id);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'time' => 'required|integer|min:0',
            'time_unit' => ['required', Rule::in(ScheduleInterval::SCHEDULE_UNITS)],
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        $schedule = Schedule::find($id);
        $schedule->update($request->only('name', 'time', 'time_unit'));

        notify()->success('Schedule updated successfully');

        return redirect()->route('admin.schedule.index');
    }
}
