@extends('admin.layouts.app')

@section('content')
@include('admin.layouts.message')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Review Reports Management</h3>
                </div>
                <div class="card-body">
                    {{-- Stats Cards --}}
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-warning">
                                <div class="card-body text-white">
                                    <h4>{{ $pendingReports->count() }}</h4>
                                    <p>Pending Reports</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success">
                                <div class="card-body text-white">
                                    <h4>{{ $resolvedReports->count() }}</h4>
                                    <p>Resolved Reports</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-secondary">
                                <div class="card-body text-white">
                                    <h4>{{ $ignoredReports->count() }}</h4>
                                    <p>Ignored Reports</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabs --}}
                    <ul class="nav nav-tabs" id="reportTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab"
                                data-bs-target="#pending" type="button">
                                Pending ({{ $pendingReports->count() }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="resolved-tab" data-bs-toggle="tab" data-bs-target="#resolved"
                                type="button">
                                Resolved ({{ $resolvedReports->count() }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ignored-tab" data-bs-toggle="tab" data-bs-target="#ignored"
                                type="button">
                                Ignored ({{ $ignoredReports->count() }})
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="reportTabsContent">
                        {{-- Pending Reports --}}
                        <div class="tab-pane fade show active" id="pending" role="tabpanel">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Reporter</th>
                                            <th>Book</th>
                                            <th>Review</th>
                                            <th>Rating</th>
                                            <th>Reason</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pendingReports as $report)
                                        <tr>
                                            <td>{{ $report->user->name }}</td>
                                            <td>{{ $report->review->book->title ?? 'N/A' }}</td>
                                            <td>
                                                <div class="review-text">
                                                    {{ Str::limit($report->review->review, 80) }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $report->review->rating }}/5</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">{{ $report->reason }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"
                                                    onclick="openActionModal({{ $report->review_report_id }}, '{{ $report->reason }}')">
                                                    Take Action
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No pending reports</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Resolved Reports --}}
                        <div class="tab-pane fade" id="resolved" role="tabpanel">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Reporter</th>
                                            <th>Reason</th>
                                            <th>Admin Notes</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($resolvedReports as $report)
                                        <tr>
                                            <td>{{ $report->user->name }}</td>
                                            <td>{{ $report->reason }}</td>
                                            <td>{{ $report->admin_notes }}</td>
                                            <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No resolved reports</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Ignored Reports --}}
                        <div class="tab-pane fade" id="ignored" role="tabpanel">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Reporter</th>
                                            <th>Reason</th>
                                            <th>Admin Notes</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ignoredReports as $report)
                                        <tr>
                                            <td>{{ $report->user->name }}</td>
                                            <td>{{ $report->reason }}</td>
                                            <td>{{ $report->admin_notes }}</td>
                                            <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No ignored reports</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Action Modal --}}
<div class="modal fade" id="actionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Take Action on Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.reports.action') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="report_id" id="action_report_id">

                    <div class="mb-3">
                        <label class="form-label">Action:</label>
                        <select name="action" class="form-select" required>
                            <option value="">Select Action</option>
                            <option value="flag">Flag Review (Keep but mark as inappropriate)</option>
                            <option value="delete">Delete Review Permanently</option>
                            <option value="ignore">Ignore Report (No action needed)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Admin Notes (Optional):</label>
                        <textarea name="admin_notes" class="form-control" rows="3"
                            placeholder="Add notes about your decision..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Action</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('java_script')
<script>
    function openActionModal(reportId, reason) {
        document.getElementById('action_report_id').value = reportId;
        new bootstrap.Modal(document.getElementById('actionModal')).show();
    }
</script>
@endsection