<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequestFormRequest;
use App\Models\Request as ModelRequest;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $request = ModelRequest::where('origin_division', $userId)
                                ->get();

        return Inertia::render('app/pending/index', [
            'requests' => $request,
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

        $originalData = $modelRequest->getOriginal();

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

    public function forward()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
