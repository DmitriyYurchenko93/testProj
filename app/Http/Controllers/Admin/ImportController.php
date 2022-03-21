<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ExcelImport;
use App\Models\CompanyCount;
use App\Models\Operation;
use App\Models\User;
use App\Models\UserCount;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{
    public function importExcel(Request $request)
    {
        Excel::import(new ExcelImport(), $request->file('file'));

//        /** @var Collection $items*/
//        $items = $importData->data;
//        $amount_list = $items->pluck('amount')->unique()->all();
//        $company_names = $items->pluck('company_count_name')->unique()->all();
//        $user_email = $items->pluck('user_email')->unique()->all();
//
//        $company_list = CompanyCount::whereIn('name', $company_names)->get();
//        $user_list = User::whereIn('email', $user_email)->get();
//
//        $company_ids = $company_list->pluck('id')->all();
//        $user_ids = $user_list->pluck('id')->all();
//
//        $operations = Operation::select('amount', 'recipient', 'sender', 'type', 'created_at')
//            ->whereIn('recipient', $company_ids)
//            ->whereIn('sender', $user_ids)
//            ->whereIn('amount', $amount_list)
//            ->get();
        return redirect(route('admin.operations.index'));
    }
}
