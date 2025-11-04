<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequestFormRequest;
use App\Models\Division;
use App\Models\Request as ModelRequest;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $userId = $user->division;

        $request = ModelRequest::where('new_division', $userId)
                                ->get();

        $divisions = Division::all();

        return Inertia::render('app/pending/index', [
            'request' => $request,
            'requests' => $request,
            'divisions' => $divisions,
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
                    'notes' => $modelRequest->notes,
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
            ]);

            RequestHistory::create([
                'request_id' => $request->request_id, 
                // 'action' => 'Forwarded', 
                // 'details' => 'Request forwarded to division: ' . $validatedData['new_division'],
                // 'user_id' => auth()->id(), 
                'new_division' => $validatedData['new_division'],
            ]);
            
            DB::commit();

            return redirect()
                ->route('pending.index') 
                ->with('success', 'Request has been successfully forwarded to ' . $validatedData['new_division'] . ' and history logged.');

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Request Forwarding/History Logging Error: ' . $e->getMessage(), ['request_id' => $request->id]);

            return redirect()
                ->back()
                ->with('error', 'An unexpected error occurred while processing the request.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
