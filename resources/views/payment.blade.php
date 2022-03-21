@extends('layouts.app')

@section('title', 'Платеж')

@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Создание платежа</h1>

            <form action="{{route('payment.user')}}" class="space-y-5 mt-5" method="POST">
                @csrf
                <input name="amount" type="number" step="0.01" class="w-full h-12 border border-gray-800 rounded px-3 @error('amount') border-red-500 @enderror" placeholder="сумма платежа"/>
                @error('amount')
                <p class="text-red-500">{{$message}}</p>
                @enderror

                <select name="recipient" class="w-full h-12 border border-gray-800 rounded px-3">
                    <option disabled>выберите счёт компании</option>
                    @foreach($companyCounts as $companyCount)
                        <option value="{{ $companyCount->id }}">{{ $companyCount->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">
                    Отправить
                </button>
            </form>
        </div>
    </div>
@endsection

