<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Operation
 *
 * @property int $id
 * @property float $amount
 * @property int $recipient
 * @property int $sender
 * @property string $created_at
 * @property string $company_count_name
 * @property string $user_email
 * @property string $type
 * @method static Builder|Operation newModelQuery()
 * @method static Builder|Operation newQuery()
 * @method static Builder|Operation query()
 * @method static Builder|Operation whereCreatedAt($value)
 * @method static Builder|Operation whereId($value)
 * @method static Builder|Operation whereAmount($value)
 * @method static Builder|Operation whereRecipient($value)
 * @method static Builder|Operation whereSender($value)
 * @method static Builder|Operation whereType($value)
 * @method static Builder|Operation whereCompanyCountName($value)
 * @method static Builder|Operation whereUserEmail($value)
 * @mixin \Eloquent
 */
class Operation extends Model
{
    protected $fillable = [
        'amount',
        'recipient',
        'company_count_name',
        'sender',
        'user_email',
        'type',
        'created_at'
    ];

    public function companyCount() {
        return $this->hasOne(CompanyCount::class,'id', 'recipient');
    }
}
