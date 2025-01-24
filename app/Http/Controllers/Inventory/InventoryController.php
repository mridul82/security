<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InventoryCategory;
use App\Models\InventorySubCategory;
use App\Models\InventoryProduct;
use App\Models\StockIssuance;


class InventoryController extends Controller
{
    public function categories()
    {
        $categories = InventoryCategory::with('subCategories')->get();
        return view('inventory.categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        InventoryCategory::create($validatedData);
        return redirect()->back()->with('success', 'Category added successfully');
    }

    public function addSubCategory(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_category_id' => 'required|exists:inventory_categories,id',
            'name' => 'required|string|max:255'
        ]);

        InventorySubCategory::create($validatedData);
        return redirect()->back()->with('success', 'Sub-category added successfully');
    }

    public function products()
    {
        $products = InventoryProduct::with('subCategory.category')->get();
        $categories = InventoryCategory::with('subCategories')->get();
        $stockIssuances = StockIssuance::with('product')->get();
        return view('inventory.products', compact('products', 'categories', 'stockIssuances'));
    }

    public function addProduct(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_sub_category_id' => 'required|exists:inventory_sub_categories,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'type' => 'required|in:employee,client'
        ]);

        InventoryProduct::create($validatedData);
        return redirect()->back()->with('success', 'Product added successfully');
    }

    public function issueStock(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_product_id' => 'required|exists:inventory_products,id',
            'quantity' => 'required|integer|min:1',
            'issued_to_type' => 'required|in:employee,client',
            'issued_to_id' => 'required|integer'
        ]);

        // Create stock issuance record
        $issuance = StockIssuance::create([
            'inventory_product_id' => $validatedData['inventory_product_id'],
            'quantity' => $validatedData['quantity'],
            'issued_to_type' => $validatedData['issued_to_type'],
            'issued_to_id' => $validatedData['issued_to_id'],
            'issued_at' => now()
        ]);

        // Update product quantity
        $product = InventoryProduct::find($validatedData['inventory_product_id']);
        $product->decrement('quantity', $validatedData['quantity']);

        return redirect()->back()->with('success', 'Stock issued successfully');
    }
}
