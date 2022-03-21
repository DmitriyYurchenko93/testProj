<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCount;
use App\Models\Operation;
use App\Models\UserCount;
use Illuminate\Http\Request;


class AdminPaymentController extends Controller
{
    public function showPaymentForm()
    {
        $companyCounts = CompanyCount::all();
        return view('admin.payment', compact('companyCounts'));
    }

    public function paymentAdmin(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0,01'],
            'sender' => ['required', 'numeric', 'min:1'],
            'recipient' => ['required', 'int'],
        ]);
        $userCount = UserCount::whereId($data['sender'])->first();
        $companyCount = CompanyCount::whereId($data['recipient'])->first();
        if ($userCount) {
            $operation = Operation::create([
                'amount' => $data['amount'],
                'recipient' => $data['recipient'],
                'company_count_name' => $companyCount->name,
                'sender' => $userCount->id,
                'user_email' => $userCount->user_email,
                'type' => false,
            ]);
            if ($operation) {
                $companyCount->balance = ($companyCount->balance) - ($data['amount']);
                if (($companyCount->balance) >= 0) {
                    $companyCount->save();
                } else {
                    Operation::latest('created_at', 'desc')->first()->delete();
                    return redirect(route('admin.payment'))->withErrors(['amount' => 'баланса на счете компании недостаточно для данной операции']);
                }
                $userCount->balance = ($userCount->balance) + ($data['amount']);
                $userCount->save();
                return redirect(route('admin.operations.index'));
            }
        }
        return redirect(route('admin.payment'))->withErrors(['sender' => 'такого счета не существует']);
    }
}
