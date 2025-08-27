<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function submitReport(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:reviews,review_id',
            'reason' => 'required|string'
        ]);

        $user_id = Auth::id();
        $review_id = $request->review_id;

        // Check if already reported
        if (ReviewReport::checkExistingReport($user_id, $review_id)) {
            return back()->with('error', 'You have already submit the report!');
        }

        // Create report
        ReviewReport::create([
            'user_id' => $user_id,
            'review_id' => $review_id,
            'reason' => $request->reason,
            'report_date' => now(),
            'status' => 'Pending'
        ]);

        return back()->with('success', 'Report submitted successfully!');
    }

    public function showReports()
    {
        $pendingReports = ReviewReport::with(['user', 'review.book'])
            ->where('status', 'Pending')
            ->orderBy('report_date', 'desc')
            ->get();

        $resolvedReports = ReviewReport::with(['user', 'review.book'])
            ->where('status', 'Resolved')
            ->orderBy('report_date', 'desc')
            ->take(10)
            ->get();

        $ignoredReports = ReviewReport::with(['user', 'review.book'])
            ->where('status', 'Ignored')
            ->orderBy('report_date', 'desc')
            ->take(10)
            ->get();

        return view('admin.reports.show_report', compact('pendingReports', 'resolvedReports', 'ignoredReports'));
    }


    public function handleReportAction(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:review_reports,review_report_id',
            'action' => 'required|in:flag,ignore,delete',
            'admin_notes' => 'nullable|string|max:500'
        ]);

        $report = ReviewReport::find($request->report_id);

        switch ($request->action) {
            case 'flag':
                // Review ko flag kar dein
                Review::where('review_id', $report->review_id)
                    ->update(['is_flaged' => 1]);

                $report->update([
                    'status' => 'Resolved',
                    'admin_notes' => $request->admin_notes ?: 'Review flagged as inappropriate'
                ]);

                return back()->with('success', 'Review successfully flagged!');

            case 'ignore':
                $report->update([
                    'status' => 'Ignored',
                    'admin_notes' => $request->admin_notes ?: 'Report rejected - no violation found'
                ]);

                return back()->with('success', 'Report ignored!');

            case 'delete':
                // *** IMPORTANT: Pehle saare reports delete karein, phir review ***

                // Step 1: Us review ke saare reports delete karein
                ReviewReport::where('review_id', $report->review_id)->delete();

                // Step 2: Ab review delete karein
                Review::where('review_id', $report->review_id)->delete();

                return back()->with('success', 'Review and all related reports permanently deleted!');
        }
    }

    public function getReportStats()
    {
        $stats = [
            'pending' => ReviewReport::where('status', 'Pending')->count(),
            'resolved' => ReviewReport::where('status', 'Resolved')->count(),
            'ignored' => ReviewReport::where('status', 'Ignored')->count(),
            'total' => ReviewReport::count()
        ];

        return $stats;
    }
}
