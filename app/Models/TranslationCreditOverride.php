<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranslationCreditOverride extends Model
{
    use HasUuids;

    protected $fillable = [
        'translator_id',
        'created_by',
        'approved_by',
        'displayName',
        'avatarUrl',
        'url',
        'hide',
    ];

    protected $casts = [
        'hide' => 'boolean',
    ];

    public function translator(): BelongsTo
    {
        return $this->belongsTo(Translator::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
