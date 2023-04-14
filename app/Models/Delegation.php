<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delegation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'worker_id',
        'country_id',
        'start',
        'end',
        'amount_due'
    ];

    /**
     * @var string
     */
    protected $table = 'delegations';

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class)->without('delegations');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
