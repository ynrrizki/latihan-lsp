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
        'total',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'nisn', 'nisn');
    }

    public function spp(): BelongsTo
    {
        return $this->belongsTo(Spp::class);
    }
}
