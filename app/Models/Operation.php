<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client',
        'tag',
        'stage',
        'prop_assign',
        'prop_remark',
        'uiux_assign',
        'uiux_status',
        'uiux_due',  // ← uiux_due added
        'dev_assign',
        'dev_fe',
        'is_archived',
        'archived_at',
        'dev_be',
        'dev_due',  // ← dev_due added
        'fe',
        'be',
        'status',
        'due',
        'final_remark',
        'deployment_status',
        'last_edited_by',
        'last_edited_field',
        'deleted_at',
    ];

    protected $casts = [
        'fe' => 'integer',
        'be' => 'integer',
        'due' => 'date:Y-m-d',
        'uiux_due' => 'date:Y-m-d',  // ← add
        'dev_due' => 'date:Y-m-d',  // ← add
        'is_archived' => 'boolean',
        'archived_at' => 'datetime',
    ];

    /**
     * Generate a tag from the first letter of each word in the client name.
     *
     * Examples matching the screenshot:
     *   "Quantum Labs"  → #QL-001
     *   "Nova Digital"  → #ND-002
     *   "Bluewave Co."  → #BW-003
     *   "Stellarify"    → #ST-004
     */
    public static function generateTag(string $client, int $id): string
    {
        // Strip punctuation from each word for cleaner initials
        $words = preg_split('/\s+/', trim($client));
        $words = array_map(fn($w) => preg_replace('/[^a-zA-Z0-9]/', '', $w), $words);
        $words = array_values(array_filter($words));  // remove empty

        $prefix = '';

        if (count($words) >= 2) {
            $second = $words[1];
            // If second word is a short filler (Co, Inc, Ltd, etc.), use first 2 chars of first word
            $fillers = ['co', 'inc', 'ltd', 'llc', 'the', 'and', 'of'];
            if (in_array(strtolower($second), $fillers)) {
                $prefix = strtoupper(substr($words[0], 0, 2));
            } else {
                $prefix = strtoupper(substr($words[0], 0, 1) . substr($second, 0, 1));
            }
        } else {
            // Single word: take first 2 chars — "Stellarify" → ST
            $prefix = strtoupper(substr($words[0], 0, 2));
        }

        return '#' . $prefix . '-' . str_pad($id, 3, '0', STR_PAD_LEFT);
    }
}
