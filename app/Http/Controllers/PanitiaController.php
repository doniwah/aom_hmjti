<?php

namespace App\Http\Controllers;

use App\Models\Panitia;
use Illuminate\Http\Request;

class PanitiaController extends Controller
{
    public function getData($id)
    {
        $data = Panitia::where(["id_panitia" =>$id])->first();
        return response()->json(["data" => $data]);
    }
}
