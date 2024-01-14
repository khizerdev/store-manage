<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class=" text-gray-900 dark:text-gray-100">
            Create Stock
        </div>
        <form class=" text-gray-900 dark:text-gray-100 mt-10" wire:submit="submit">
            <div class="space-y-4">
    
                <div class="border-b border-gray-900/10 pb-4">
                
                    <div class="mb-4">
                        <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Select Vendor</label>
                                <select wire:model="selectedVendor"class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1" required>
                                    <option value="">Select Vendors</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Challan No</label>
                                <div class="mt-2">
                                    <x-text-input wire:model="challan_no" class="block mt-1 w-full" type="text"  autofocus />
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                                <div class="mt-2">
                                    <x-text-input wire:model="date" class="block mt-1 w-full" type="date" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($rows as $index => $row)
               
                    <div class="mb-4" wire:key="{{$index}}">
                        <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                            {{-- company  --}}
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Select Company</label>
                                <select wire:model="rows.{{ $index }}.selectedCompany" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1"  wire:change="fetchProduct({{ $index }})" >
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- category  --}}
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Select Category</label>
                                <select wire:model="rows.{{ $index }}.selectedCategory" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full  mt-1">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- products  --}}
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Select Product</label>
                                <select wire:model="rows.{{ $index }}.selectedProduct" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1">
                                    <option value="">Select Product</option>
                                    @foreach($row['products'] as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- size  --}}
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Select Size</label>
                                <select wire:model="rows.{{ $index }}.selectedSize" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1">
                                    <option value="">Select Size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- thickness  --}}
                            <div class="w-full">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Select Thickness</label>
                                <select wire:model="rows.{{ $index }}.selectedHeight" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full  mt-1">
                                    <option value="">Select Thickness</option>
                                    @foreach($heights as $height)
                                        <option value="{{ $height->id }}">{{ $height->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full flex items-end">
                                <x-primary-button class="ms-3 mb-2 w-full justify-center" type="button" wire:click="addRow">
                                    Add
                                </x-primary-button>
                                @if($index > 0)
                                    <x-danger-button class="ms-3 mb-2 w-full justify-center" type="button">
                                        X
                                    </x-danger-button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            
                <div class="flex items-center justify-start">
                    <x-primary-button>
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
</div>