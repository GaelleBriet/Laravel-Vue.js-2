<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstimateFieldValue extends Model
{
    use HasFactory;

    public function field(): BelongsTo
    {
        return $this->belongsTo(EstimateField::class);
    }
}
