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
    public function store(StoreCreateFormRequest $request)
    {
        $user = Auth::user();

        // DB::beginTransaction();

        // try {

        //     $data = array_merge($request->validated(), [
        //         'origin_user' => $user->user_id,
        //         'origin_division' => $user->division,
        //         'new_division' => $user->division,
        //         'new_user' => $user->user_id,
        //     ]);

        //     $newRequest = ModelsRequest::create($data);

        //     $customRequestId = Str::replaceMatches(
        //         pattern: '/[^A-Za-z0-9]++/',
        //         replace: '',
        //         subject: $newRequest->id
        //     );

        //     $newRequest->request_id = $customRequestId;
        //     $newRequest->save();

        //     $foreignKey = $newRequest->request_id;
        //     $notes = 

        //     RequestHistory::create([
        //         'request_id' => $foreignKey,
        //     ])        
        // }

        $data = array_merge($request->validated(), [
                    'origin_user' => $user->user_id,
                    'origin_division' => $user->division,
                    'new_division' => $user->division,
                    'new_user' => $user->user_id,
        ]);

        $create = ModelsRequest::create($data);

        $create->request_id = Str::replaceMatches(
            pattern: '/[^A-Za-z0-9]++/',
            replace: '',
            subject: $create['id']
        );

        $create->save();

        $foreignKey = [
            'request_id' => $create->request_id,
            'notes' => $create->notes,
            'new_division' => $user->division,
            'new_user' => $user->user_id,
        ];

        RequestHistory::create($foreignKey);

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
