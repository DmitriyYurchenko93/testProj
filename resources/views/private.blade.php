@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
    <nav
        class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
        <div class="mb-2 sm:mb-0 inner">

            <a class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">Личный
                кабинет</a><br>

        </div>

        <div class="sm:mb-0 self-center">
            @auth('web')
                <a>{{auth('web')->user()->name}}</a>
                <a href="{{route('logout')}}"
                   class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Выйти</a>
            @endauth

        </div>
    </nav>

    <div class="sm:mb-0 self-center" style="padding-top: 50px">
        <div class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1" style="padding-left:50px">
            Личный счёт: {{$userCount->id}}</div>

        <div class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1" style="padding-left:50px">
            Баланс: {{$userCount->balance}}</div>

        <div style="padding-left:50px"><a href="{{route('payment')}}" type="button"
                                          class="text-center bg-blue-900 rounded-md text-white py-2 font-medium">отправить
                платеж</a></div>
    </div>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Операции</h3>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                #
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                сумма
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                cчет компании
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                тип операции
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($operations as $operation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$loop->index+1}}</td>
                                @if($operation->type === true)
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">-{{$operation->amount}}</td>
                                @else
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">+{{$operation->amount}}</td>
                                @endif
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$operation->recipient}}</td>
                                @if($operation->type === true)
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                                        исходящая
                                    </td>
                                @else
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                                        входящая
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
