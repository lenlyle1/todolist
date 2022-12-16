<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public const INCOMPLETE = 'incomplete';

    public const COMPLETE = 'complete';

    public const DELETED = 'deleted';

    protected $fillable = [
        'title',
        'priority',
        'status' => self::INCOMPLETE
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withPivot('id', 'name');
    }
}
