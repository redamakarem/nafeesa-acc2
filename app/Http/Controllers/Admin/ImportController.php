<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function rawMaterials(Request $request)
    {
        return view('admin.imports.raw-materials');
    }
    public function sales(Request $request)
    {
        return view('admin.imports.sales');
    }
}
