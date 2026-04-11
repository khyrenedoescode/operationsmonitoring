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
        $userId = auth()->id();

        $rows = Operation::where('user_id', $userId)
            ->where('is_archived', false)
            ->orderBy('created_at', 'asc')
            ->get()->map(function ($op) {
                $op->due = $op->due ? $op->due->format('Y-m-d') : null;
                $op->uiux_due = $op->uiux_due ? $op->uiux_due->format('Y-m-d') : null;
                $op->dev_due = $op->dev_due ? $op->dev_due->format('Y-m-d') : null;
                return $op;
            });

        $trash = Operation::onlyTrashed()
            ->where('user_id', $userId)
            ->orderBy('deleted_at', 'desc')->get();

        $archived = Operation::where('user_id', $userId)
            ->where('is_archived', true)
            ->orderBy('archived_at', 'desc')->get();

        $logs = ActivityLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(200)->get();

        $isMobile = preg_match('/(android|iphone|ipad|mobile)/i', request()->header('User-Agent'));

        if ($isMobile) {
            return view('operations.mobile', compact('rows', 'trash', 'logs'));
        }

        return view('operations.index', compact('rows', 'trash', 'archived', 'logs'));
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
            'dev_fe' => 'nullable|string|in:,Done,In Progress,Pending',
            'dev_be' => 'nullable|string|in:,Done,In Progress,Pending',
            'fe' => 'nullable|integer|min:0|max:100',
            'be' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:Done,On Hold,Revisions',
            'uiux_due' => 'nullable|date',
            'dev_due' => 'nullable|date',
            'due' => 'nullable|date',
            'final_remark' => 'nullable|string',
            'deployment_status' => 'nullable|string',
        ]);

        $data['user_id'] = auth()->id();
        $data['prop_assign'] = !empty($data['prop_assign']) ? $data['prop_assign'] : '—';
        $data['dev_assign'] = !empty($data['dev_assign']) ? $data['dev_assign'] : '—';
        $data['fe'] = $data['fe'] ?? 0;
        $data['be'] = $data['be'] ?? 0;
        $data['dev_fe'] = $data['dev_fe'] ?? '';
        $data['dev_be'] = $data['dev_be'] ?? '';
        $data['last_edited_by'] = $request->input('edited_by', 'System');
        $data['last_edited_field'] = 'created';
        $data['tag'] = 'TEMP-' . uniqid();

        $op = Operation::create($data);
        $op->tag = Operation::generateTag($op->client, $op->id);
        $op->save();

        ActivityLog::create([
            'type' => 'add',
            'message' => 'New client added',
            'detail' => $op->client . ' (' . $op->tag . ')',
            'user' => $data['last_edited_by'],
            'user_id' => auth()->id(),
        ]);

        $responseRow = $op->toArray();
        $responseRow['due'] = $op->getRawOriginal('due');
        $responseRow['uiux_due'] = $op->getRawOriginal('uiux_due');
        $responseRow['dev_due'] = $op->getRawOriginal('dev_due');

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'row' => $responseRow]);
        }

        return redirect()->route('operations.index')->with('toast', 'Client added ✓');
    }

    /* ─── PATCH ─── */
    public function update(Request $request, Operation $operation)
    {
        $allowed = [
            'client', 'tag', 'stage', 'prop_assign', 'prop_remark',
            'uiux_assign', 'uiux_status', 'uiux_due', 'dev_assign',
            'dev_fe', 'dev_be', 'dev_due', 'fe', 'be', 'status',
            'due', 'final_remark', 'deployment_status',
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
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'last_edited_by' => $operation->last_edited_by,
            'last_edited_field' => $operation->last_edited_field,
            'updated_at' => $operation->updated_at->diffForHumans(),
        ]);
    }

    /* ─── DESTROY ─── */
    public function destroy(Operation $operation)
    {
        $clientName = $operation->client;
        $operation->delete();

        ActivityLog::create([
            'type' => 'delete',
            'message' => $clientName . ' moved to Recycle Bin',
            'user' => request()->input('edited_by', 'System'),
            'user_id' => auth()->id(),
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
            'user_id' => auth()->id(),
        ]);

        $responseRow = $operation->toArray();
        $responseRow['due'] = $operation->due ? $operation->due->format('Y-m-d') : null;
        $responseRow['uiux_due'] = $operation->uiux_due ? $operation->uiux_due->format('Y-m-d') : null;
        $responseRow['dev_due'] = $operation->dev_due ? $operation->dev_due->format('Y-m-d') : null;

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
            'user_id' => auth()->id(),
        ]);

        return response()->json(['success' => true]);
    }

    /* ─── ARCHIVE ─── */
    public function archive($id)
    {
        $operation = Operation::findOrFail($id);
        $operation->is_archived = true;
        $operation->archived_at = now();
        $operation->save();

        ActivityLog::create([
            'type' => 'edit',
            'message' => $operation->client . ' moved to Archive',
            'user' => request()->input('edited_by', 'System'),
            'user_id' => auth()->id(),
        ]);

        return response()->json(['success' => true]);
    }

    /* ─── UNARCHIVE ─── */
    public function unarchive($id)
    {
        $operation = Operation::findOrFail($id);
        $operation->is_archived = false;
        $operation->archived_at = null;
        $operation->save();

        ActivityLog::create([
            'type' => 'restore',
            'message' => $operation->client . ' restored from Archive',
            'user' => request()->input('edited_by', 'System'),
            'user_id' => auth()->id(),
        ]);

        $responseRow = $operation->toArray();
        $responseRow['due'] = $operation->getRawOriginal('due');
        $responseRow['uiux_due'] = $operation->getRawOriginal('uiux_due');
        $responseRow['dev_due'] = $operation->getRawOriginal('dev_due');

        return response()->json(['success' => true, 'row' => $responseRow]);
    }

    /* ─── CLEAR LOGS ─── */
    public function clearLogs()
    {
        try {
            ActivityLog::where('user_id', auth()->id())->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /* ─── EMPTY BIN ─── */
    public function emptyBin()
    {
        try {
            Operation::onlyTrashed()
                ->where('user_id', auth()->id())
                ->forceDelete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}