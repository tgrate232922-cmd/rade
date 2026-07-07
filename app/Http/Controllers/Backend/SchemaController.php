<?php

namespace App\Http\Controllers\Backend;

use App\Enums\InvestStatus;
use App\Http\Controllers\Controller;
use App\Models\Invest;
use App\Models\Schedule;
use App\Models\Schema;
use App\Traits\ImageUpload;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Support\ScheduleInterval;

class SchemaController extends Controller
{
    use ImageUpload;

    public function __construct()
    {
        $this->middleware('permission:schema-list|schema-create|schema-edit', ['only' => ['index', 'store']]);
        $this->middleware('permission:schema-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:schema-edit', ['only' => ['edit', 'update', 'end']]);
        $this->middleware('permission:schema-delete', ['only' => ['destroy']]);
    }

    public function index(): Application|Factory|View
    {
        $schemas = Schema::all();

        return view('backend.schema.index', compact('schemas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'icon' => 'required',
            'name' => 'required',
            'type' => 'required',
            'min_amount' => 'required_if:type,==,range',
            'max_amount' => 'required_if:type,==,range',
            'fixed_amount' => 'required_if:type,==,fixed',
            'capital_back' => 'required',
            'featured' => 'required',
            'badge' => 'required_if:featured,==,1',
            'status' => 'required',
            'return_interest' => 'required',
            'interest_type' => 'required',
            'return_period' => 'required',
            'return_type' => 'required',
            'number_of_period' => 'required_if:return_type,==,period',
            'period_unit' => ['nullable', Rule::in(ScheduleInterval::PERIOD_UNITS)],
            'expiry_minute' => 'max:59,required_if:schema_cancel,==,1|integer|max:59',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        $input = $request->all();

        $finalData = [
            'name' => $input['name'],
            'type' => $input['type'],
            'min_amount' => $input['type'] == 'fixed' ? 0 : $input['min_amount'],
            'max_amount' => $input['type'] == 'fixed' ? 0 : $input['max_amount'],
            'fixed_amount' => $input['type'] == 'range' ? 0 : $input['fixed_amount'],
            'capital_back' => $input['capital_back'],
            'featured' => $input['featured'],
            'badge' => $input['featured'] == 1 ? $input['badge'] : null,
            'status' => $input['status'],
            'return_interest' => $input['return_interest'],
            'interest_type' => $input['interest_type'],
            'return_period' => $input['return_period'],
            'return_type' => $input['return_type'],
            'number_of_period' => $input['return_type'] == 'period' ? $input['number_of_period'] : 0,
            'period_unit' => $input['return_type'] == 'period' ? ($input['period_unit'] ?? 'times') : 'times',
            'off_days' => isset($input['off_days']) ? json_encode($input['off_days']) : null,
            'schema_cancel' => $input['schema_cancel'],
            'expiry_minute' => $input['schema_cancel'] != 0 ? $input['expiry_minute'] : 59,
            'is_trending' => $input['is_trending'],
            'icon' => self::imageUploadTrait($input['icon']),
        ];

        Schema::create($finalData);

        notify()->success('schema created successfully');

        return redirect()->route('admin.schema.index');
    }

    public function create(): Application|Factory|View
    {
        $schedules = Schedule::all();

        $offDaySchedule = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday',
        ];

        return view('backend.schema.create', compact('schedules', 'offDaySchedule'));
    }

    public function edit($id): Application|Factory|View
    {
        $schedules = Schedule::all();
        $schema = Schema::find($id);

        $offDaySchedule = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday',
        ];

        return view('backend.schema.edit', compact('schema', 'schedules', 'offDaySchedule'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'min_amount' => 'required_if:type,==,range',
            'max_amount' => 'required_if:type,==,range',
            'fixed_amount' => 'required_if:type,==,fixed',
            'capital_back' => 'required',
            'featured' => 'required',
            'badge' => 'required_if:featured,==,1',
            'status' => 'required',
            'return_interest' => 'required',
            'interest_type' => 'required',
            'return_period' => 'required',
            'return_type' => 'required',
            'number_of_period' => 'required_if:return_type,==,period',
            'period_unit' => ['nullable', Rule::in(ScheduleInterval::PERIOD_UNITS)],
            'expiry_minute' => 'required_if:schema_cancel,==,1|integer|max:59',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');

            return redirect()->back();
        }

        $schema = Schema::find($id);
        $input = $request->all();

        $finalData = [
            'name' => $input['name'],
            'type' => $input['type'],
            'min_amount' => $input['type'] == 'fixed' ? 0 : $input['min_amount'],
            'max_amount' => $input['type'] == 'fixed' ? 0 : $input['max_amount'],
            'fixed_amount' => $input['type'] == 'range' ? 0 : $input['fixed_amount'],
            'capital_back' => $input['capital_back'],
            'featured' => $input['featured'],
            'badge' => $input['featured'] == 1 ? $input['badge'] : null,
            'status' => $input['status'],
            'return_interest' => $input['return_interest'],
            'interest_type' => $input['interest_type'],
            'return_period' => $input['return_period'],
            'return_type' => $input['return_type'],
            'number_of_period' => $input['return_type'] == 'period' ? $input['number_of_period'] : 0,
            'period_unit' => $input['return_type'] == 'period' ? ($input['period_unit'] ?? 'times') : 'times',
            'off_days' => isset($input['off_days']) ? json_encode($input['off_days']) : null,
            'schema_cancel' => $input['schema_cancel'],
            'expiry_minute' => $input['schema_cancel'] != 0 ? $input['expiry_minute'] : $schema->expiry_minute,
            'is_trending' => $input['is_trending'],
            'icon' => $request->hasFile('icon') ? self::imageUploadTrait($input['icon']) : $schema->icon,
        ];

        $schema->update($finalData);

        notify()->success('schema Update successfully');

        return redirect()->route('admin.schema.index');
    }

    public function end(Schema $schema): RedirectResponse
    {
        DB::transaction(function () use ($schema) {
            $schema->update(['status' => 0]);

            Invest::query()
                ->where('schema_id', $schema->id)
                ->where('status', InvestStatus::Ongoing)
                ->update(['status' => InvestStatus::Completed]);
        });

        notify()->success(__('Plan ended and active investments were closed.'));

        return redirect()->route('admin.schema.index');
    }

    public function destroy(Schema $schema): RedirectResponse
    {
        $ongoingCount = Invest::query()
            ->where('schema_id', $schema->id)
            ->where('status', InvestStatus::Ongoing)
            ->count();

        if ($ongoingCount > 0) {
            notify()->error(__('End this plan and close active investments before deleting it.'), 'Error');

            return redirect()->back();
        }

        $schema->delete();

        notify()->success(__('Plan deleted successfully.'));

        return redirect()->route('admin.schema.index');
    }
}
