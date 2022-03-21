@extends('layouts.admin')

@section('title', 'Пользователи')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Пользователи</h3>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">id</th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">имя</th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">email</th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">дата регистрации</th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">личный счёт</th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 leading-5 font-medium">баланс</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($userCounts as $userCount)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$userCount->user->id}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$userCount->user->name}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$userCount->user->email}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$userCount->user->created_at}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$userCount->id}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$userCount->balance}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$userCounts->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
