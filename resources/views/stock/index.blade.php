<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stock') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class=" text-gray-900 dark:text-gray-100">
                    Stock Entries
                </div>
                <div class="py-12">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Vendor</th>
                                <th>Challan</th>
                                <th>Date</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)    
                                <tr>
                                    <td>{{$stock->id}}</td>
                                    <td>{{$stock->vendor->name}}</td>
                                    <td>{{$stock->challan}}</td>
                                    <td>{{$stock->date}}</td>
                                    <td>{{$stock->created_at->format('d F Y')}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
