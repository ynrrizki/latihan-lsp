<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nisn',
        'spp_id',
        'pay_on',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
