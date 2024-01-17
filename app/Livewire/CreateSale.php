<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Company;
use App\Models\Height;
use App\Models\Product;
use App\Models\Salesman;
use App\Models\Size;
use App\Models\Stock;
use App\Models\StockItem;
use Livewire\Component;

class CreateSale extends Component
{
    
    public $subtotal;
    public $advance;
    public $balance;
    public $total;

    public $is_replace = false;
    
    public $salesmen;
    public $selectedSaleman;
    public $date;
    public $delivery_date;
    public $note;

    public $fullypaid;
    public $cost;
    public $profit;
    public $delivery_at;
    
    public $rows = [
        [
            'selectedCompany' => null,
            'selectedCategory' => null,
            'selectedProduct' => null,
            'selectedSize' => null,
            'selectedHeight' => null,
            'qty' => 0,
            'amount' => 0,
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
        $this->salesmen = Salesman::all();
        $this->categories = Category::all();
        $this->is_replace = false;
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
            'amount' => 0,
            'products' => [],
            'sizes' => [],
            'heights' => [],
            'disabledVariation' => false
        ];
    }

    public function toggleIsReplace(){
        $this->is_replace = !$this->is_replace;
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
        dd($this->is_replace);
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
        return view('livewire.create-sale');
    }
}
