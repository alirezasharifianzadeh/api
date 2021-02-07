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
            'd_id' => $request->d_id,
            'plag_type' => "{$request->plag_type}",
            'sections' => json_encode($request->sections),
            'subsentence_length' => $request->subsentence_length,
           'overlay_length' => $request->overlay_length, 
        ]);

        return [
            'id' => $id,
            'd_id' => $request->d_id,
            'process_time' => Proposal::whereStatus('0')->count() / 2,
        ];
    }

    public function report($id) {
        $proposal = Proposal::where('d_id', $id)
            ->first(['plag_type' ,'subsentence_length', 'overlay_length', 'copy_percent' ,'status', 'created_at', 'updated_at'])->toArray();

        $statuses = [0 => 'queue', 1 => 'queue', 2 => 'done', 3 => 'error'];

        if($proposal['status'] == 2) {
            $proposal['report_url'] = url("/report/{$id}");
            $proposal['graphical_report_url'] = url("/report/{$id}/graphical");
        }
        
        $proposal['status'] = $statuses[$proposal['status']];

        return $proposal;
    }
}
