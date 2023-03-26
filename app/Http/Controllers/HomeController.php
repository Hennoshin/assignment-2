<?php

namespace App\Http\Controllers;

use App\Http\Modules\BaseWebCrud;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Attendence;
use App\Models\RewardHistory;

class HomeController extends BaseWebCrud
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $attendence = [];
        $reward = [];
        $berita = [];
        if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF)) {
            $attendence = Attendence::where('employee_id', auth()->user()->employee->id)->orderBy('absence_date', 'desc')->limit(10)->get();
            $reward = RewardHistory::where('employee_id', auth()->user()->employee->id)->orderBy('created_at', 'desc')->limit(5)->get();

            $berita = Berita::where('status', Berita::PUBLISH)->where(function ($query) {
                $from = Carbon::now()->format('Y-m-01');
                $to = Carbon::now()->format('Y-m-t');
                $query->where('start_date', '>=', $from)
                    ->where('end_date', '<=', $to);
            })->orderBy('start_date', 'desc')->orderBy('created_at', 'desc')->limit(5)->get();
        }
        return view('dashboard', [
            'absen' => $attendence,
            'rewards' => $reward,
            'berita' => $berita
        ]);
    }

    public function getFiles(Request $request)
    {
        $queryparams = $request->all();
        $path = $queryparams['_path'];
        $path = storage_path('app/public/' . $path);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}