<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invest;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:investment-list');

    }

    /**
     * @return Application|Factory|View|JsonResponse
     *
     * @throws Exception
     */
     
     
     public function destroy(Invest $invest, Request $request)
{
    try {
        DB::transaction(function () use ($invest) {
            // Optional: delete/detach related rows first if you have FKs
            // e.g. Profit::where('invest_id', $invest->id)->delete();
            // Transaction::where('invest_id', $invest->id)->update(['invest_id' => null]);

            $invest->delete();      // or $invest->forceDelete() if using SoftDeletes
        });

        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok', 'message' => 'Investment deleted.']);
        }
        return back()->with('success', 'Investment deleted.');

    } catch (\Throwable $e) {
        $msg = 'Unable to delete this investment. Detach related records or add ON DELETE CASCADE.';
        if ($request->expectsJson()) {
            return response()->json(['status' => 'error', 'message' => $msg], 422);
        }
        return back()->with('error', $msg);
    }
}
     
     
     
     
  public function investments(Request $request, $id = null)
{
    if ($request->ajax()) {

        if ($id) {
            $data = Invest::with('schema')->where('user_id', $id)->latest();
        } else {
            $data = Invest::query()->with('schema')->latest();
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('icon', 'backend.investment.include.__invest_icon')
            ->addColumn('username', function ($row) {
    $user      = $row->user ?? null;                 // if relation loaded
    $userId    = $user->id ?? $row->user_id ?? null; // fallback to user_id
    $userName  = e($user->full_name ?? $user->name ?? 'Unknown User');

    if ($userId) {
        $url = route('admin.user.edit', $userId);
        return '<a href="'.$url.'" class="text-primary">'.$userName.'</a>';
    }

    return '<span>'.$userName.'</span>';
})

            ->addColumn('schema', 'backend.investment.include.__invest_schema')
            ->addColumn('rio', 'backend.investment.include.__invest_rio')
            ->addColumn('profit', 'backend.investment.include.__invest_profit')
            ->addColumn('period_remaining', function ($raw) {
                if ($raw->return_type != 'period') {
                    return 'Unlimited';
                }
                return $raw->number_of_period . ($raw->number_of_period < 2 ? ' Time' : ' Times');
            })
            ->editColumn('capital_back', 'backend.investment.include.__invest_capital_back')
            ->editColumn('next_profit_time', 'backend.investment.include.__invest_next_profit_time')

            // ✅ NEW: Actions column (delete button)
            ->addColumn('action', function ($row) {
                return view('backend.investment.include.__action', [
                    'id' => $row->id,
                ])->render();
            })

            // include 'action' so HTML isn’t escaped
            ->rawColumns([
                'icon', 'schema', 'rio', 'profit', 'capital_back',
                'next_profit_time', 'username', 'action'
            ])
            ->make(true);
    }

    return view('backend.investment.index');
}
}