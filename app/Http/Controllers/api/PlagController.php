<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Str;

class PlagController extends Controller
{
    public function proposal(Request $request) {
        $request->validate([
            'plag_type' => ['required', 'in:0,1'],
            'sections.*' => ['required', 'string'],
            'subsentence_length' => ['required', 'int', 'min:5', 'max:10'],
            'overlay_length' => ['required', 'int', 'min:5', 'max:10'],
        ]);

        $id = (string) Str::uuid();

        $proposal = Proposal::create([
            'id' => $id,
            'plag_type' => "{$request->plag_type}",
            'sections' => json_encode($request->sections),
            'subsentence_length' => $request->subsentence_length,
           'overlay_length' => $request->overlay_length, 
        ]);

        return [
            'id' => $id,
            'process_time' => Proposal::whereStatus('0')->count() / 2,
        ];
    }
}
