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

        $userId = $user->division;

        $request = ModelsRequest::where('new_division',  $userId)
                                ->where('status', 'Forwarded')
                                ->get();

        $divisions = Division::all();

        $userDivisionName = auth()->user()->division;

        return Inertia::render('app/incoming/index', [
            'request' => $request,
            'requests' => $request,
            'divisions' => $divisions,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function accept(UpdateRequestFormRequest $requestData, ModelsRequest $request)
    {
        $validatedData = $requestData->validated();
        
        try {

            $user = Auth::user();

            DB::beginTransaction();
            
            $request->update([
                'new_division' => $user->division,
                'new_user' => $user->user_id,
                'status' => 'Processing',
            ]);

            RequestHistory::create([
                'request_id' => $request->request_id,
                'notes' => $request->notes,
                'status' => $request->status,
                'new_division' => $user->division,
                'new_user' => $user->user_id,
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

    public function close(UpdateRequestFormRequest $requestData, ModelsRequest $request)
    {
        $validatedData = $requestData->validated();
        
        try {

            $user = Auth::user();

            DB::beginTransaction();
            
            $request->update([
                'new_division' => $user->division,
                'new_user' => $user->user_id,
                'status' => 'Done',
            ]);

            RequestHistory::create([
                'request_id' => $request->request_id,
                'notes' => $request->notes,
                'status' => $request->status,
                'new_division' => $user->division,
                'new_user' => $user->user_id,
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

    public function forward(UpdateRequestFormRequest $requestData, ModelsRequest $request)
    {
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
}
