<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                                ->where('status', 'Pending')
                                ->count();

        $finished = RequestModel::where('new_division', [$userId])
                                ->where('status', 'Done')
                                ->count();

        $displayRequest = fn() => RequestModel::where('new_division', [$userId])
                                // ->selectRaw('status, COUNT(*) as count')
                                // ->groupBy('status')
                                // ->where('status', 'Forwarded')
                                ->get();

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
