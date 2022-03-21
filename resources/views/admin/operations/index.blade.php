@extends('layouts.admin')

@section('title', 'Операции')

@section('content')
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
                                id
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                сумма
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                счет компании
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                счет пользователя
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 leading-5 font-medium">
                                дата создания
                            </th>
                            <th class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200  leading-5 font-medium">
                                тип операции
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($operations as $operation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$operation->id}}</td>
                                @if($operation->type === true)
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                                        +{{$operation->amount}}</td>
                                @else
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                                        -{{$operation->amount}}</td>
                                @endif
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$operation->recipient}}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$operation->sender}}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">{{$operation->created_at}}</td>
                                    @if($operation->type === true)
                                        <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                                            входящая
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                                            исходящая
                                        </td>
                                    @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$operations->links()}}
                    <form action="{{route('admin.import.excel')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file">
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
