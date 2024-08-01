<?php

namespace App\Http\Controllers\API\Employees;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Page $page)
    {
        return response()->json([
            'status' => 'success',
            'data' => $page,
        ], 200);
    }
}
