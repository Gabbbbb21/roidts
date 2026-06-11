<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequestFormRequest;
use App\Models\Division;
use App\Models\Request as ModelsRequest;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Inertia\Inertia;

class IncomingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    { 
        $user = Auth::user(); 

        // Fetch only documents forwarded to this user's division that are STILL in the 'Forwarded' state.
        $requests = ModelsRequest::where('new_division', $user->division) 
                                 ->where('status', 'Forwarded') 
                                 ->latest() 
                                 ->get(); 

        $divisions = Division::all(); 

        return Inertia::render('app/incoming/index', [ 
            'requests'         => $requests, 
            'divisions'        => $divisions, 
            'userDivisionName' => $user->division, 
        ]); 
    }

    /**
     * Accept an incoming request and transition it to Processing.
     */
    public function accept(UpdateRequestFormRequest $requestData)
    {
        $validatedData = $requestData->validated();
        
        try {
            $user = Auth::user();

            // FIX: Find the row explicitly from the form payload ID to bypass route-binding bugs
            $documentRequest = ModelsRequest::where('request_id', $validatedData['request_id'])->firstOrFail();

            DB::beginTransaction();

            $documentRequest->update([
                'new_division' => $user->division,
                'new_user'     => $user->user_id,
                'status'       => 'Processing',
            ]);

            RequestHistory::create([
                'request_id'   => $documentRequest->id, // Fallback to verified primary key
                'notes'        => $documentRequest->notes,
                'status'       => 'Processing',
                'new_division' => $user->division,
                'new_user'     => $user->user_id,
            ]);
            
            DB::commit();

            return redirect()
                ->route('incoming.index') 
                ->with('success', 'Request has been successfully accepted and moved to pending.');

        } catch (\Exception $e) {
            DB::rollBack();

            FacadesLog::error('Request Acceptance Error: ' . $e->getMessage(), ['request_id' => $validatedData['request_id'] ?? null]);

            return redirect()
                ->back()
                ->with('error', 'An unexpected error occurred while processing the request.');
        }
    }

    /**
     * Close out a request directly from the incoming list.
     */
    public function close(UpdateRequestFormRequest $requestData)
    {
        $validatedData = $requestData->validated();
        
        try {
            $user = Auth::user();

            // FIX: Explicit database lookup via form payload
            $documentRequest = ModelsRequest::where('request_id', $validatedData['request_id'])->firstOrFail();

            DB::beginTransaction();
            
            $documentRequest->update([
                'new_division' => $user->division,
                'new_user'     => $user->user_id,
                'status'       => 'Done',
            ]);

            RequestHistory::create([
                'request_id'   => $documentRequest->id,
                'notes'        => $documentRequest->notes,
                'status'       => 'Done',
                'new_division' => $user->division,
                'new_user'     => $user->user_id,
            ]);
            
            DB::commit();

            return redirect()
                ->route('incoming.index') 
                ->with('success', 'Request has been successfully closed.');

        } catch (\Exception $e) {
            DB::rollBack();

            FacadesLog::error('Request Closure Error: ' . $e->getMessage(), ['request_id' => $validatedData['request_id'] ?? null]);

            return redirect()
                ->back()
                ->with('error', 'An unexpected error occurred while processing the request.');
        }
    }

    /**
     * Forward an incoming request out to an alternate division.
     */
    public function forward(UpdateRequestFormRequest $requestData)
    {
        $validatedData = $requestData->validated();
        
        try {
            // FIX: Explicit database lookup via form payload
            $documentRequest = ModelsRequest::findOrFail($validatedData['request_id']);

            DB::beginTransaction();
            
            $documentRequest->update([
                'new_division' => $validatedData['new_division'],
                'status'       => 'Forwarded',
            ]);

            RequestHistory::create([
                'request_id'   => $documentRequest->id,
                'notes'        => $documentRequest->notes,
                'status'       => 'Forwarded',
                'new_division' => $validatedData['new_division'],
            ]);
            
            DB::commit();

            return redirect()
                ->route('incoming.index') 
                ->with('success', 'Request has been successfully forwarded to ' . $validatedData['new_division'] . '.');

        } catch (\Exception $e) {
            DB::rollBack();

            FacadesLog::error('Request Forwarding Error: ' . $e->getMessage(), ['request_id' => $validatedData['request_id'] ?? null]);

            return redirect()
                ->back()
                ->with('error', 'An unexpected error occurred while processing the request.');
        }
    }
}