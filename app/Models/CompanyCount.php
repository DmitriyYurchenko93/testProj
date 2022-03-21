<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CompanyCount
 *
 * @property int $id
 * @property string $name
 * @property float $balance
 * @property string $created_at
 * @method static Builder|CompanyCount newModelQuery()
 * @method static Builder|CompanyCount newQuery()
 * @method static Builder|CompanyCount query()
 * @method static Builder|CompanyCount whereCreatedAt($value)
 * @method static Builder|CompanyCount whereId($value)
 * @method static Builder|CompanyCount whereName($value)
 * @method static Builder|CompanyCount whereBalance($value)
 * @mixin \Eloquent
 */
class CompanyCount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'balance',
    ];

    public function operations() {
        return $this->hasMany(Operation::class,'recipient', 'id');
    }
}
