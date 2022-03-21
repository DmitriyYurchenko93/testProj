<?php

namespace App\Http\Controllers;

use App\Models\CompanyCount;
use App\Models\Operation;
use App\Models\UserCount;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        $companyCounts = CompanyCount::all();
        return view('payment', compact('companyCounts'));
    }

    public function paymentUser(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0,01'],
            'recipient' => ['required', 'int'],
        ]);
        $userCount = UserCount::whereUserId(auth('web')->id())->first();
        $companyCount = CompanyCount::whereId($data['recipient'])->first();
        $operation = Operation::create([
            'amount' => $data['amount'],
            'recipient' => $companyCount->id,
            'company_count_name' => $companyCount->name,
            'sender' => $userCount->id,
            'user_email' => $userCount->user_email,
            'type' => true,
        ]);
        if ($operation) {
            $userCount->balance = ($userCount->balance) - ($data['amount']);
            if (($userCount->balance) >= 0) {
                $userCount->save();
            } else {
                Operation::latest('created_at', 'desc')->first()->delete();
                return redirect(route('payment'))->withErrors(['amount' => 'вашего баланса недостаточно для данной операции']);
            }
            $companyCount->balance = ($companyCount->balance) + ($data['amount']);
            $companyCount->save();
            return redirect(route('home.user'));
        }
        return redirect(route('payment'))->withErrors(['amount' => 'произошла ошибка']);
    }
}
