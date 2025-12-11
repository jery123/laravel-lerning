<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{   
    public function AllPurchase(){
        $purchases = Purchase::orderBy('id', 'desc')->get();

        return view('admin.backend.purchase.all_purchase', compact('purchases'));
    }

    public function AddPurchase(){
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        return view('admin.backend.purchase.add_purchase', compact('suppliers', 'warehouses'));
    }

    public function PurchaseProductSearch(Request $request){
        $query = $request->input('query');
        $warehouse_id = $request->input('warehouse_id');

        $product = Product::where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('product_code', 'LIKE', "%{$query}%");
        })->where('warehouse_id', function($q) use ($warehouse_id) {
            $q->where('warehouse_id', $warehouse_id);
        })
        ->select('id', 'name', 'product_code', 'price', 'product_qty')
        ->limit(10)
        ->get();

        return response()->json($product);
    }
}
