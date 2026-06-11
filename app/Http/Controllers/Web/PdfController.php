<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\IncomingRequest; // Assuming your model is named IncomingRequest
use Illuminate\Http\Request;
use Inertia\Inertia;

class PdfController extends Controller
{
    /**
     * Renders the half-page A4 print snapshot view for a routed transaction.
     *
     * @param Request $request
     * @param int $id The ID of the document request
     * @return \Inertia\Response
     */
    public function printRoutingSlip(Request $request, $id)
    {
        // 1. Fetch the document request profile from the database
        $incomingRequest = IncomingRequest::findOrFail($id);

        // 2. Capture the targeted division passed from the forward action modal query parameter
        // Fallback to a placeholder string if not supplied
        $selectedTargetDivision = $request->query('target_division', 'Unassigned Destination');

        // 3. (Optional) Compile session meta info from the currently authenticated user
        $currentUser = $request->user();
        
        $meta = [
            'receivingOffice' => $currentUser->division_name ?? 'RO1 - ORD',
            'entryMode'       => $incomingRequest->entry_mode ?? 'Physical Routing',
            'receivedDate'    => now()->format('F d, Y l'),
            'enteredBy'       => $currentUser->username ?? 'System Operator',
            'signedBy'        => strtoupper($currentUser->name ?? 'N/A')
        ];

        // 4. Return the Inertia render response pointing to your snapshot template file
        // Make sure to match your actual file path directory structure inside resources/js/Pages/
        return Inertia::render('Transactions/SnapshotPage', [
            'request'                => [
                'id'         => $incomingRequest->id,
                'lname'      => $incomingRequest->lname,
                'fname'      => $incomingRequest->fname,
                'mname'      => $incomingRequest->mname,
                'doc_type'   => $incomingRequest->doc_type,
                'notes'      => $incomingRequest->notes,
                'status'     => $incomingRequest->status,
                'created_at' => $incomingRequest->created_at ? $incomingRequest->created_at->format('M d, Y h:ia l') : '-',
            ],
            'selectedTargetDivision' => $selectedTargetDivision,
            'meta'                   => $meta
        ]);
    }
}