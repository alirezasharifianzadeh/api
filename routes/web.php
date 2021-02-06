<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Proposal;

Route::get('report/{id}/{graphical?}', function ($id, $graphical = false) {
    $proposal = $proposal = Proposal::find($id);

    $reports_path = env('REPORTS_PATH');
    $results = json_decode(file_get_contents("{$reports_path}/{$proposal->results}"), true);
    $reports = json_decode($proposal->report_paths, true);

    foreach($reports as $key => &$value) {
        $value = file_get_contents("{$reports_path}/{$value}");
    }

    return view('report', compact('proposal', 'reports', 'results', 'graphical'));
});
