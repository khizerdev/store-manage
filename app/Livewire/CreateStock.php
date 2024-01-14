<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\Height;
use App\Models\Product;
use App\Models\Size;
use App\Models\Vendor;
use Livewire\Component;

class CreateStock extends Component
{
    public $date;
    public $challan_no;

    public $selectedVendor;
    public $vendors;

    public $rows = [
        [
            'selectedCompany' => null,
            'selectedCategory' => null,
            'selectedProduct' => null,
            'selectedSize' => null,
            'selectedHeight' => null,
            'products' => [],
        ],
    ];

    public $companies;
    public $categories;
    public $products;
    public $sizes;
    public $heights;
    
    // public $selectedCompany;
    // public $selectedCategory;
    // public $selectedProduct;
    // public $selectedSize;
    // public $selectedHeight;

    public function mount(){
        $this->companies = Company::all();
        $this->vendors = Vendor::all();
        $this->categories = Category::all();
        $this->products = [];
        $this->sizes = [];
        $this->heights = [];
    }

    public function addRow()
    {
        $this->rows[] = [
            'selectedCompany' => null,
            'selectedCategory' => null,
            'selectedProduct' => null,
            'selectedSize' => null,
            'selectedHeight' => null,
            'products' => [],
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
    }

    public function fetchProduct($index)
    {
        $companyId = $this->rows[$index]['selectedCompany'];
        $this->rows[$index]['products'] = Product::where('company_id', $companyId)->get();
    }


    public function submit()
    {
        dd($this->rows);
    }

    public function render()
    {
        return view('livewire.create-stock');
    }
}
