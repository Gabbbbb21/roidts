<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreateFormRequest;
use App\Models\Request as ModelsRequest;
use App\Models\RequestHistory;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CreateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('app/create/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreCreateFormRequest $request)
    // {
    //     $user = Auth::user();
        
    //     $data = array_merge($request->validated(), [
    //                 'origin_user' => $user->user_id,
    //                 'origin_division' => $user->division,
    //                 'new_division' => $user->division,
    //                 'new_user' => $user->user_id,
    //     ]);

    //     $create = ModelsRequest::create($data);

    //     $create->request_id = Str::replaceMatches(
    //         pattern: '/[^A-Za-z0-9]++/',
    //         replace: '',
    //         subject: $create['id']
    //     );

    //     $create->save();

    //     $foreignKey = [
    //         'request_id' => $create->request_id,
    //         'notes' => $create->notes,
    //         'status' => $create->status,
    //         'new_division' => $user->division,
    //         'new_user' => $user->user_id,
    //     ];

    //     RequestHistory::create($foreignKey);

    //     return redirect()->route('pending.index')->with('message', 'Your request has been submitted successfully');
    // }

    public function store(StoreCreateFormRequest $request)
{
    // 1. Get the authenticated user
    $user = Auth::user();

    // 2. Determine the next sequential request_id for this user
    // The request_id should be an integer type in the database for this logic to work best.
    // Assuming 'origin_user' is the column that links the request to the user.
    $lastRequest = ModelsRequest::where('origin_user', $user->user_id)
                                ->orderBy('request_id', 'desc')
                                ->first();

    // Calculate the next ID. If no previous request exists, start at 1.
    $nextRequestId = ($lastRequest ? (int)$lastRequest->request_id : 0) + 1;

    // Optional: Format the request ID (e.g., pad with leading zeros to 4 digits: 0001, 0002)
    // You can adjust the padding length (e.g., '4') as needed.
    $formattedRequestId = Str::padLeft($nextRequestId, 4, '0');
    
    // Note: If you want a combined ID (e.g., USERID-0001), you'd format it like:
    // $finalRequestId = $user->user_id . '-' . $formattedRequestId;
    // For simplicity, I'll use the padded integer only as the request_id.
    $finalRequestId = $formattedRequestId;

    // 3. Prepare the data array
    $data = array_merge($request->validated(), [
        'origin_user'     => $user->user_id,
        'origin_division' => $user->division,
        'new_division'    => $user->division,
        'new_user'        => $user->user_id,
        'request_id'      => $finalRequestId, // Inject the determined request_id
    ]);

    // 4. Create the new request
    // The 'request_id' is already set in $data, so we don't need to manually update it after creation.
    $create = ModelsRequest::create($data);

    // 5. Prepare the data for RequestHistory
    // You should ensure 'request_id' is a foreign key in RequestHistory.
    $historyData = [
        // Use the generated request_id, not the model's auto-incrementing ID
        'request_id'   => $create->request_id,
        'notes'        => $create->notes,
        'status'       => $create->status,
        'new_division' => $user->division,
        'new_user'     => $user->user_id,
    ];

    // 6. Create the RequestHistory record
    RequestHistory::create($historyData);

    // 7. Redirect
    return redirect()->route('pending.index')->with('message', 'Your request has been submitted successfully');
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
}
