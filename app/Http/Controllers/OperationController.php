<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /* ─── INDEX ─── */
    public function index()
    {
        $rows = Operation::orderBy('created_at', 'asc')->get()->map(function ($op) {
            $op->due = $op->due ? $op->due->format('Y-m-d') : null;
            return $op;
        });

        $trash = Operation::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $logs = ActivityLog::orderBy('created_at', 'desc')->limit(200)->get();

        $isMobile = preg_match('/(android|iphone|ipad|mobile)/i', request()->header('User-Agent'));

        if ($isMobile) {
            return view('operations.mobile', compact('rows', 'trash', 'logs'));
        }

        return view('operations.index', compact('rows', 'trash', 'logs'));
    }

    /* ─── STORE ─── */
    public function store(Request $request)
    {
        $data = $request->validate([
            'client' => 'required|string|max:255',
            'stage' => 'required|in:Homepage,Sitemap,All Pages,Final Homepage',
            'prop_assign' => 'nullable|string|max:100',
            'prop_remark' => 'nullable|string',
            'uiux_assign' => 'nullable|string',
            'uiux_status' => 'nullable|string',
            'dev_assign' => 'nullable|string|max:100',
            // Accept empty string OR one of the valid values
            'dev_fe' => 'nullable|string|in:,Done,In Progress,Pending',
            'dev_be' => 'nullable|string|in:,Done,In Progress,Pending',
            'fe' => 'nullable|integer|min:0|max:100',
            'be' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Done,On Hold,Revisions',
            'due' => 'nullable|date',
            'final_remark' => 'nullable|string',
        ]);

        // ── Normalise values ──
        $data['prop_assign'] = !empty($data['prop_assign']) ? $data['prop_assign'] : '—';
        $data['dev_assign'] = !empty($data['dev_assign']) ? $data['dev_assign'] : '—';
        $data['fe'] = $data['fe'] ?? 0;
        $data['be'] = $data['be'] ?? 0;
        $data['dev_fe'] = $data['dev_fe'] ?? '';
        $data['dev_be'] = $data['dev_be'] ?? '';
        $data['last_edited_by'] = $request->input('edited_by', 'System');
        $data['last_edited_field'] = 'created';

        // ── We need to insert a temporary unique tag first, then update it ──
        // Reason: we need the auto-incremented ID to generate the real tag,
        // but `tag` has a unique constraint so we can't leave it null/empty.
        $data['tag'] = 'TEMP-' . uniqid();  // placeholder to satisfy unique constraint

        $op = Operation::create($data);
        $op->tag = Operation::generateTag($op->client, $op->id);
        $op->save();

        ActivityLog::create([
            'type' => 'add',
            'message' => 'New client added',
            'detail' => $op->client . ' (' . $op->tag . ')',
            'user' => $data['last_edited_by'],
        ]);

        // Format due date back to plain string for JSON response
        $responseRow = $op->toArray();
        $responseRow['due'] = $op->due ? $op->due->format('Y-m-d') : null;

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'row' => $responseRow]);
        }

        return redirect()->route('operations.index')->with('toast', 'Client added ✓');
    }

    /* ─── PATCH (inline AJAX field update) ─── */
    public function update(Request $request, Operation $operation)
    {
        $allowed = [
            'client',
            'tag',
            'stage',
            'prop_assign',
            'prop_remark',
            'dev_assign',
            'dev_fe',
            'dev_be',
            'fe',
            'be',
            'status',
            'due',
            'final_remark',
        ];

        $field = $request->input('field');

        if (!in_array($field, $allowed)) {
            return response()->json(['error' => 'Invalid field'], 422);
        }

        $rules = [
            'value' => match ($field) {
                'fe', 'be' => 'required|integer|min:0|max:100',
                'stage' => 'required|in:Homepage,Sitemap,All Pages,Final Homepage',
                'status' => 'required|in:Done,On Hold,Revisions',
                'dev_fe', 'dev_be' => 'nullable|string',
                'due' => 'nullable|date',
                default => 'nullable|string|max:1000',
            },
        ];

        $validated = $request->validate($rules);

        $operation->$field = $validated['value'];
        $operation->last_edited_by = $request->input('edited_by', 'Unknown');
        $operation->last_edited_field = $field;
        $operation->save();

        ActivityLog::create([
            'type' => $field === 'status' ? 'status' : 'edit',
            'message' => ucfirst($field) . ' updated for ' . $operation->client,
            'detail' => $validated['value'],
            'user' => $operation->last_edited_by,
        ]);

        return response()->json([
            'success' => true,
            'last_edited_by' => $operation->last_edited_by,
            'last_edited_field' => $operation->last_edited_field,
            'updated_at' => $operation->updated_at->diffForHumans(),
        ]);
    }

    /* ─── DESTROY (Move to Recycle Bin) ─── */
    public function destroy(Operation $operation)
    {
        $clientName = $operation->client;
        $operation->delete();

        ActivityLog::create([
            'type' => 'delete',
            'message' => $clientName . ' moved to Recycle Bin',
            'user' => request()->input('edited_by', 'System'),
        ]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('operations.index')->with('toast', 'Moved to Bin ✓');
    }

    /* ─── RESTORE ─── */
    public function restore($id)
    {
        $operation = Operation::onlyTrashed()->findOrFail($id);
        $operation->restore();

        ActivityLog::create([
            'type' => 'restore',
            'message' => $operation->client . ' restored from Bin',
            'user' => request()->input('edited_by', 'System'),
        ]);

        $responseRow = $operation->toArray();
        $responseRow['due'] = $operation->due ? $operation->due->format('Y-m-d') : null;

        return response()->json(['success' => true, 'row' => $responseRow]);
    }

    /* ─── FORCE DELETE ─── */
    public function forceDelete($id)
    {
        $operation = Operation::onlyTrashed()->findOrFail($id);
        $clientName = $operation->client;
        $operation->forceDelete();

        ActivityLog::create([
            'type' => 'delete',
            'message' => $clientName . ' permanently deleted',
            'user' => request()->input('edited_by', 'System'),
        ]);

        return response()->json(['success' => true]);
    }

    /* ─── CLEAR LOGS ─── */
    public function clearLogs()
    {
        ActivityLog::truncate();
        return response()->json(['success' => true]);
    }
}
