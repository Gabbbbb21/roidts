<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Import the Facade
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Generates a PDF for one or more selected users based on a list of IDs.
     *
     * @param Request $request The incoming request containing the list of IDs.
     * @return \Illuminate\Http\Response
     */
    public function printSelectedUsers(Request $request)
    {
        // 1. Get the 'ids' string from the query (e.g., "1,5,10")
        $idString = $request->input('ids');

        // Check if the IDs were provided
        if (empty($idString)) {
             // Handle the error if no IDs are provided
             return response('No user IDs provided for printing.', 400);
        }

        // 2. Convert the comma-separated string into an array of integers
        $selectedIds = array_map('intval', explode(',', $idString));
        
        // 3. Fetch only the users whose IDs are in the array
        // We use whereIn() to efficiently select multiple records.
        $users = User::whereIn('id', $selectedIds)->get();

        // 4. Check if any users were found before proceeding
        if ($users->isEmpty()) {
            return response('No users found with the provided IDs.', 404);
        }

        // 5. Load the Blade view and pass the collection of selected users
        $pdf = Pdf::loadView('pdfs.selected_users_list', ['users' => $users]);

        // 6. Download the PDF
        $filename = 'selected-users-report-' . time() . '.pdf';
        
        return $pdf->download($filename);
    }
}
