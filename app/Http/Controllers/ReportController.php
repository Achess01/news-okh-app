<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostReport;

class ReportController extends Controller
{

    public function postStatusReport()
    {
        $statuses = Post::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('reports.post_status', compact('statuses'));
    }

    public function postReportsReport()
    {
        $postReports = PostReport::with(['post', 'user'])->get();

        return view('reports.post_reports', compact('postReports'));
    }
}
