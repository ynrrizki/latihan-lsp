<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spp extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'amount'];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
