<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
       
        <form class=" text-gray-900 dark:text-gray-100 mt-10" wire:submit="submit">
       
            <div class="border-b border-gray-900/10 pb-4">
                <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Enter Products</h2>
                @foreach($rows as $index => $row)
                <div class="mb-6" wire:key="{{$index}}">
                    <div class="flex flex-col sm:flex-row md:flex-row gap-4">

                        {{-- company  --}}
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Select Company</label>
                            <select wire:model="rows.{{ $index }}.selectedCompany" class="form-select" wire:change="fetchProductByCompany({{ $index }})">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- category  --}}
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Select Category</label>
                            <select wire:model="rows.{{ $index }}.selectedCategory" class="form-select" wire:change="fetchRowData({{ $index }})">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- products  --}}
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Select Product</label>
                            <select wire:model="rows.{{ $index }}.selectedProduct" class="form-select">
                                <option value="">Select Product</option>
                                @foreach($row['products'] as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- size  --}}
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Select Size</label>
                            <select wire:model="rows.{{ $index }}.selectedSize" class="form-select" @if($row['disabledVariation']) disabled @endif>
                                <option value="">Select Size</option>
                                @foreach($row['sizes'] as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- thickness  --}}
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Select Thickness</label>
                            <select wire:model="rows.{{ $index }}.selectedHeight" class="form-select" @if($row['disabledVariation']) disabled @endif>
                                <option value="">Select Thickness</option>
                                @foreach($row['heights'] as $height)
                                    <option value="{{ $height->id }}">{{ $height->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full ">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Qty</label>
                            <div class="mt-2">
                                <x-text-input wire:model="rows.{{ $index }}.qty" class="block mt-1 w-full" type="number" min="1" required />
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Amount</label>
                            <div class="mt-2">
                                <x-text-input wire:model="rows.{{ $index }}.amount" class="block mt-1 w-full" type="number" min="1" required />
                            </div>
                        </div>
                        
                        <div class="w-full flex basis-0 items-end">
                            @if($loop->last)
                            <x-primary-button class="ms-3 mb-2 w-full justify-center" type="button" wire:click="addRow">
                                Add
                            </x-primary-button>
                            @endif
                            @if($index > 0)
                                <x-danger-button class="ms-3 mb-2 w-full justify-center" type="button" wire:click="removeRow({{$index}})">
                                    X
                                </x-danger-button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="flex items-center mb-4">
                    <input id="default-checkbox" wire:change="toggleIsReplace" type="checkbox" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox" class="ms-2 text-base font-medium text-gray-900 dark:text-gray-300">Is Replacement ?</label>
                </div>
                @if($is_replace)
                <div class="mb-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Enter Product</h2>
                    <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                        <div class="w-full">
                            <div class="flex">
                                <x-text-input wire:model="subtotal" class="block mt-1" type="number" required readonly/>
                                <x-primary-button class="ms-3 mb-2 justify-center" type="button" wire:click="addRow">
                                    Add
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Amount Information</h2>
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Subtotal</label>
                            <div class="mt-2">
                                <x-text-input wire:model="subtotal" class="block mt-1 w-full" type="number" required readonly/>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Advance</label>
                            <div class="mt-2">
                                <x-text-input wire:model="advance" class="block mt-1 w-full" type="number" required/>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Balance</label>
                            <div class="mt-2">
                                <x-text-input wire:model="balance" class="block mt-1 w-full" type="number" required readonly/>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Total</label>
                            <div class="mt-2">
                                <x-text-input wire:model="total" class="block mt-1 w-full" type="number" required readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Sale Information</h2>
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Select Salesman</label>
                            <select wire:model="selectedSaleman"class="form-select" required>
                                <option value="">Select Salesman</option>
                                @foreach($salesmen as $salesman)
                                    <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Sale Date</label>
                            <div class="mt-2">
                                <x-text-input wire:model="date" class="block mt-1 w-full" type="date" required />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Delivery Date</label>
                            <div class="mt-2">
                                <x-text-input wire:model="delivery_date" class="block mt-1 w-full" type="date" required />
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Delivery Note</label>
                            <div class="mt-2">
                                <x-text-input wire:model="note" class="block mt-1 w-full" type="text"   />
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        
            <div class="flex items-center justify-start">
                <x-primary-button>
                    {{ __('Create') }}
                </x-primary-button>
            </div>
     
        </form>
</div>