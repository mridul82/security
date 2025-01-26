<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InventoryProduct;
use App\Models\StockIssuance;
use App\Models\Employee;
use App\Models\Client;

class StockIssuanceController extends Controller
{
    public function index()
    {
        $issuances = StockIssuance::all();
        foreach ($issuances as $issuance) {
            $issuance->product = InventoryProduct::find($issuance->inventory_product_id);
            if($issuance->issued_to_type == 'employee') {
                $issuance->issued_to = Employee::find($issuance->issued_to_id);
            } else {
                $issuance->issued_to = Client::find($issuance->issued_to_id);
            }
        }
       // dd($issuances);
        return view('inventory.stock-issuance.index', compact('issuances'));
    }
}
