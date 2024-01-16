<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Stock') }}
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
                                <th>Product</th>
                                <th>Size</th>
                                <th>Thickness</th>
                                <th>Stock In</th>
                                <th>Stock Out</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product['name']}}</td>
                                <td>{{$product['size']}}</td>
                                <td>{{$product['height']}}</td>
                                <td>{{$product['stock_in']}}</td>
                                <td>0</td>
                                <td>{{$product['stock_in']}}</td>
                                <td>Action</td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
