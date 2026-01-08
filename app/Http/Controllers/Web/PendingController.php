<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequestFormRequest;
use App\Models\Division;
use App\Models\Request as ModelRequest;
use App\Models\RequestHistory;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Inertia\Inertia;

class PendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $requestId)
    {
        // $requestHistories = RequestHistory::all();

        $user = Auth::user();

        $userId = $user->division;

        $request = ModelRequest::where('new_division',  $userId)
                                ->whereNot('status', 'Forwarded')
                                ->whereNot('status', 'Done')
                                ->get();

        $selectedRequestId = $requestId->query('requestId');
        $requestHistories = collect();

        // if ($selectedRequestId) {
        //     $requestHistories = RequestHistory::where('request_id', $selectedRequestId)
        //                                 ->get();
        // }

        if ($selectedRequestId) {
            // 1. Find the actual request object first to get the "0003" string
            $mainRequest = ModelRequest::find($selectedRequestId);

            if ($mainRequest) {
                // 2. Query history using the string ID (e.g., "0003")
                $requestHistories = RequestHistory::where('request_id', $mainRequest->request_id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
            }
        }

        $divisions = Division::all(['division_name'])->toArray();

        $userDivisionName = auth()->user()->division;

        return Inertia::render('app/pending/index', [
            'request' => $request,
            'requests' => $request,
            'divisions' => $divisions,
            'requestHistories' => $requestHistories,
            'selectedRequestId' => $selectedRequestId,
            'userDivisionName' => $userDivisionName,
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
    public function edit(ModelRequest $requests)
    {
        return Inertia::render('app/pending/edit', [
            'requests' => $requests,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestFormRequest $request, string $id)
    {
        $modelRequest = ModelRequest::findOrFail($id);

        $user = Auth::user();

        $updateData = array_merge($request->validated(), [
                    // 'origin_user' => $user->user_id,
                    // 'origin_division' => $user->division,
                    'new_division' => $user->division,
                    'new_user' => $user->user_id,
        ]);

        // $originalData = $modelRequest->getOriginal();

        $modelRequest->update($updateData);

        $updatedAttributes = $modelRequest->getChanges();

        unset($updatedAttributes['updated_at']);

        $requestHistory = array_merge($request->validated(), [
                    'new_division' => $user->division,
                    'new_user' => $user->user_id,
                    'status' => $modelRequest->status,
                    'request_id' =>$modelRequest->request_id,
        ]);

        RequestHistory::create($requestHistory);

        return redirect()->route('pending.index')->with('success', 'Request updated successfully');
    }

    public function forward(UpdateRequestFormRequest $requestData, ModelRequest $request)
    {
        // try {

        //     DB::beginTransaction();
            
        //     $validatedData = $requestData->validated();

        //     // Update the Request
        //     $request->update([
        //         // 'status' => 'Forwarded', // Example status update
        //         'new_division' => $validatedData['new_division'], // Assign to new division
        //         // 'forwarded_by_user_id' => auth()->id(), // Track who forwarded it (optional)
        //     ]);

        //     DB::commit();

        //     // Redirect back to the pending requests index with a success flash message
        //     return redirect()
        //         ->route('pending.index') 
        //         ->with('success', 'Request has been successfully forwarded to ' . $validatedData['new_division'] . '.');

        // } catch (\Exception $e) {
        //     DB::rollBack();

        //     // Log the error
        //     \Log::error('Request Forwarding Error: ' . $e->getMessage(), ['request_id' => $request->id]);

        //     // Redirect back with an error flash message
        //     return redirect()
        //         ->back()
        //         ->with('error', 'An unexpected error occurred while forwarding the request.');
        // }

        $validatedData = $requestData->validated();
        
        try {
            DB::beginTransaction();
            
            $request->update([
                'new_division' => $validatedData['new_division'],
                'status' => 'Forwarded',
            ]);

            RequestHistory::create([
                'request_id' => $request->request_id,
                'notes' => $request->notes,
                'status' => $request->status,
                'new_division' => $validatedData['new_division'],
            ]);
            
            DB::commit();

            return redirect()
                ->route('pending.index') 
                ->with('success', 'Request has been successfully forwarded to ' . $validatedData['new_division'] . ' and history logged.');

        } catch (\Exception $e) {
            DB::rollBack();

            FacadesLog::error('Request Forwarding/History Logging Error: ' . $e->getMessage(), ['request_id' => $request->id]);

            return redirect()
                ->back()
                ->with('error', 'An unexpected error occurred while processing the request.');
        }
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
