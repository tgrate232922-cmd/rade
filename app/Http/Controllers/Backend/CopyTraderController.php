<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CopyTrader;
use App\Models\UserCopyTrade;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CopyTraderController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $traders = CopyTrader::withCount(['copiedTrades', 'runningCopiedTrades'])->latest()->get();
        $currencySymbol = setting('currency_symbol', 'global');

        return view('backend.copy_trader.index', compact('traders', 'currencySymbol'));
    }

    public function create()
    {
        return view('backend.copy_trader.create');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back()->withInput();
        }

        CopyTrader::create($this->payload($request));

        notify()->success('Copy trader created successfully.', 'Success');
        return redirect()->route('admin.copy-traders.index');
    }

    public function edit(CopyTrader $copyTrader)
    {
        return view('backend.copy_trader.edit', compact('copyTrader'));
    }

    public function update(Request $request, CopyTrader $copyTrader)
    {
        $validator = $this->validator($request, $copyTrader);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back()->withInput();
        }

        $copyTrader->update($this->payload($request, $copyTrader));

        notify()->success('Copy trader updated successfully.', 'Success');
        return redirect()->route('admin.copy-traders.index');
    }

    public function destroy(CopyTrader $copyTrader)
    {
        if ($copyTrader->copiedTrades()->where('status', UserCopyTrade::STATUS_RUNNING)->exists()) {
            notify()->error('This trader still has running copied trades.', 'Error');
            return redirect()->back();
        }

        $copyTrader->delete();

        notify()->success('Copy trader deleted successfully.', 'Success');
        return redirect()->route('admin.copy-traders.index');
    }

    private function validator(Request $request, ?CopyTrader $copyTrader = null)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => ($copyTrader ? 'nullable' : 'required') . '|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
            'daily_profit_percentage' => 'required|numeric|min:0',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|gt:min_amount',
            'duration_days' => 'required|integer|min:1',
            'capital_return' => 'required|boolean',
            'status' => 'required|boolean',
            'approved' => 'required|boolean',
            'risk_level' => 'required|in:low,medium,high',
            'display_users_copying' => 'required|integer|min:0',
            'win_rate' => 'required|numeric|min:0|max:100',
            'description' => 'nullable|string',
        ]);
    }

    private function payload(Request $request, ?CopyTrader $copyTrader = null): array
    {
        $data = [
            'name' => $request->name,
            'daily_profit_percentage' => $request->daily_profit_percentage,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'duration_days' => $request->duration_days,
            'capital_return' => $request->capital_return,
            'status' => $request->status,
            'approved' => $request->approved,
            'risk_level' => $request->risk_level,
            'display_users_copying' => $request->display_users_copying,
            'win_rate' => $request->win_rate,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUploadTrait($request->file('image'), $copyTrader?->image);
        }

        return $data;
    }
}
