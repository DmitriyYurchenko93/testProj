<?php

namespace App\Imports;

use App\Models\CompanyCount;
use App\Models\Operation;
use App\Models\User;
use App\Models\UserCount;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;


class ExcelImport implements toArray, WithHeadingRow
{
//    /**
//     * @var Collection
//     */
//    public $data;
//
//    public function __construct()
//    {
//        $this->data = collect();
//    }
//
//    public function model(array $row)
//    {
//        $this->data->push((object)$row);
//    }

    public function array(array $array)
    {
        $recipients = CompanyCount::select('name')->pluck('name')->all();
        $senders = User::select('email')->pluck('email')->all();
        $operations = Operation::select('amount', 'company_count_name', 'user_email', 'type', 'created_at')
            ->get();
        foreach ($array as $item) {
            $date = (new \DateTime($item['data']))->format('Y-m-d H:i:s');
            $type = settype($item['type'], "bool");
            if (!(in_array($item['company_count_name'], $recipients)) and $item['company_count_name'] !== null) {
                $company_count = new CompanyCount();
                $company_count->name = $item['company_count_name'];
                $company_count->balance = $item['company_count_balance'];
                $company_count->saveOrFail();
            }
            if (!(in_array($item['user_email'], $senders)) and $item['user_email'] !== null) {
                $user = new User();
                $user->name = $item['user_name'];
                $user->email = $item['user_email'];
                $user->password = bcrypt($item['user_password']);
                $user->saveOrFail();
                $countUser = new UserCount();
                $countUser->user_id = $user->id;
                $countUser->user_email = $user->email;
                $countUser->saveOrFail();
            }
            if (($operations->where('amount', $item['amount'])
                    ->where('company_count_name', $item['company_count_name'])
                    ->where('user_email', $item['user_email'])
                    ->where('type', $type)
                    ->where('created_at', $date)
                    ->first()) === null) {
                $companyCount = CompanyCount::whereName($item['company_count_name'])->first();
                $userCount = UserCount::whereUserEmail($item['user_email'])->first();
                $operation = new Operation();
                $operation->amount = $item['amount'];
                $operation->recipient = $companyCount->id;
                $operation->company_count_name = $item['company_count_name'];
                $operation->user_email = $item['user_email'];
                $operation->type = $type;
                $operation->created_at = $date;
                $operation->sender = $userCount->id;
                $operation->save();

                if ($type == true) {
                    $userCount->balance = ($userCount->balance) - ($item['amount']);
                    $userCount->save();

                    $companyCount->balance = ($companyCount->balance) + ($item['amount']);
                    $companyCount->save();
                } else {
                    $companyCount->balance = ($companyCount->balance) - ($item['amount']);
                    $companyCount->save();

                    $userCount->balance = ($userCount->balance) + ($item['amount']);
                    $userCount->save();
                }
            }
        }
    }
}
