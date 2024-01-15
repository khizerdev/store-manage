<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Company;
use App\Models\Height;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use App\Models\StockItem;
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
            'qty' => 0,
            'products' => [],
            'sizes' => [],
            'heights' => [],
            'disabledVariation' => false
        ],
    ];

    public $companies;
    public $categories;
    
    public function mount(){
        $this->companies = Company::all();
        $this->vendors = Vendor::all();
        $this->categories = Category::all();
    }

    public function addRow()
    {
        $this->rows[] = [
            'selectedCompany' => null,
            'selectedCategory' => null,
            'selectedProduct' => null,
            'selectedSize' => null,
            'selectedHeight' => null,
            'qty' => 0,
            'products' => [],
            'sizes' => [],
            'heights' => [],
            'disabledVariation' => false
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
    }

    public function fetchProductByCompany($index)
    {
        $this->rows[$index]['products'] = [];
        $categoryId = $this->rows[$index]['selectedCategory'];
        
        if($categoryId){
            $companyId = $this->rows[$index]['selectedCompany'];
            $this->rows[$index]['products'] = Product::where('company_id', $companyId)->where('category_id', $categoryId)->get();
        }
    }
    public function fetchRowData($index)
    {
        $companyId = $this->rows[$index]['selectedCompany'];

        if($companyId){
            $categoryId = $this->rows[$index]['selectedCategory'];
            $this->rows[$index]['products'] = Product::where('company_id', $companyId)->where('category_id', $categoryId)->get();

            if($categoryId == "3"){
                $this->rows[$index]['disabledVariation'] = true;
                $this->rows[$index]['sizes'] = [];
                $this->rows[$index]['heights'] = [];
            } else {
                $this->rows[$index]['disabledVariation'] = false;
                $this->rows[$index]['sizes'] = Size::where('category_id' , null)->get();
                $this->rows[$index]['heights'] = Height::where('category_id' , $categoryId)->get();
            }
        }
        
    }

    public function submit()
    {
        DB::transaction(function () {
            
            $stock = Stock::create([
                'vendor_id' => $this->selectedVendor,
                'challan_no' => $this->challan_no,
                'date' => $this->date,
            ]);

            foreach ($this->rows as $row) {
                StockItem::create([
                    'stock_id' => $stock->id,
                    'product_id' => $row['selectedProduct'],
                    'size_id' => $row['selectedSize'],
                    'height_id' => $row['selectedHeight'],
                    'qty' => $row['qty'],
                ]);
            };
            
        });
    }

    public function render()
    {
        return view('livewire.create-stock');
    }
}
