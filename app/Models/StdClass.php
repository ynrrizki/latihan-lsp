<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StdClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'name',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }
}
