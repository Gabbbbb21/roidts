<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use App\Models\RequestHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $requestId)
    {
        $user = Auth::user();

        $userId = $user->division;

        $request = fn() => RequestModel::where('new_division', [$userId])
                                // ->selectRaw('status, COUNT(*) as count')
                                // ->groupBy('status')
                                ->where('status', 'Forwarded')
                                ->count();

        $pending = RequestModel::where('new_division', [$userId])
                                ->where('status', 'Processing')
                                ->count();

        $finished = RequestModel::where('new_division', [$userId])
                                ->where('status', 'Done')
                                ->count();

        $displayRequest = fn() => RequestModel::where('new_division', [$userId])
                                // ->selectRaw('status, COUNT(*) as count')
                                // ->groupBy('status')
                                // ->where('status', 'Forwarded')
                                ->get();

        // 1. Get the current year for filtering
        $year = Carbon::now()->year;

        // 2. Query the database to group and count documents by month
        $monthlyCounts = RequestModel::query()
            ->where('origin_division', $userId)
            ->whereYear('created_at', $year)
            ->select(
                // Use DATE_FORMAT or MONTHNAME to get the month name/number
                DB::raw('MONTH(created_at) as month_number'),
                DB::raw('count(*) as count')
            )
            ->groupBy('month_number')
            ->orderBy('month_number')
            ->get();

        // 3. Prepare an array with all 12 months for labels and initialize data to 0
        $labels = [];
        $data = array_fill(1, 12, 0); // Fills keys 1-12 with value 0

        // Populate the $labels array and fill the $data array with actual counts
        for ($i = 1; $i <= 12; $i++) {
            // Use Carbon to get the localized month name
            $monthName = Carbon::createFromDate($year, $i, 1)->format('M');
            $labels[] = $monthName;

            // Find the count for the current month number
            $record = $monthlyCounts->where('month_number', $i)->first();

            if ($record) {
                $data[$i] = $record->count;
            }
        }

        // 4. Final chart data structure to pass to Inertia/Vue
        $chartData = [
            'labels' => $labels,
            'data' => array_values($data), // Convert indexed array back to a simple list of values
        ];

        $selectedRequestId = $requestId->query('requestId');
        $requestHistories = collect();

        if ($selectedRequestId) {
            $requestHistories = RequestHistory::where('request_id', $selectedRequestId)
                                        ->get();
        }

        return Inertia::render('app/dashboard/index', [
            'requests' => $request,
            'pendings' => $pending,
            'finishes' => $finished,
            'display_requests' => $displayRequest,
            'requestHistories' => $requestHistories,
            'selectedRequestId' => $selectedRequestId,
            'chartData' => $chartData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function history(RequestHistory $requestHistory)
    {
        // $history = RequestHistory::where('request_id', $requestId)
        //                          ->orderby('created_at', 'desc')
        //                          ->select('request_id', 'notes', 'status', 'created_at')
        //                          ->get();

        // return view('pending.history', compact('history'));

        return Inertia::render('History', [
            'request_history' => $requestHistory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
