<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserCount
 *
 * @property int $id
 * @property int $user_id
 * @property float $balance
 * @property string $created_at
 * @property string $user_email
 * @method static Builder|UserCount newModelQuery()
 * @method static Builder|UserCount newQuery()
 * @method static Builder|UserCount query()
 * @method static Builder|UserCount whereCreatedAt($value)
 * @method static Builder|UserCount whereId($value)
 * @method static Builder|UserCount whereUserId($value)
 * @method static Builder|UserCount whereUserEmail($value)
 * @method static Builder|UserCount whereBalance($value)
 * @mixin \Eloquent
 */
class UserCount extends Model
{
    protected $fillable = [
        'user_id',
        'user_email'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
