<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Models\Stock;
use App\Models\StockItem;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('items')->get();
        
        return view('stock.index', compact('stocks'));
    }

    public function create()
    {
        return view('stock.create');
    }

    public function productStock(){
        
        $stockItems = StockItem::with('product','size','height')->get();
        // dd($stockItems);
        
        $products = new Collection();

        foreach ($stockItems as $groupKey => $entries) {
            $key = $entries->product_id.'-'.$entries->size_id;

            if($products->has($key)){
                $product = $products->get($key);
                $product['stock_in'] += $entries->qty;
                $products->put($key, [
                    'name' => $entries->product->name,
                    'size' => $entries->size->name,
                    'height' => $entries->height->name,
                    'product_id' => $entries->product_id,
                    'size_id' => $entries->size_id,
                    'stock_in' => $product['stock_in']
                ]);
            } else {
                $products->put($key, [
                    'name' => $entries->product->name,
                    'size' => $entries->size->name,
                    'height' => $entries->height->name,
                    'product_id' => $entries->product_id,
                    'size_id' => $entries->size_id,
                    'stock_in' => $entries->qty
                ]);
            }
            
        }

        $products = $products->sortBy('name');

        return view('stock.products-stock' , compact('products'));
    }
}
