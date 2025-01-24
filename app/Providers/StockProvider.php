<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\PurchaseOrderItem;

class StockProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('AdminStock', function () {
            return new class {
                /**
                 * Get aggregated stock data with current stock and supplier information.
                 *
                 * @return \Illuminate\Support\Collection
                 */
                public function getAdminCurrentStock()
                {
                    $aggregatedStockData = PurchaseOrderItem::selectRaw(
                        'purchase_order_items.product_id,
                         purchase_orders.supplier_id,
                         SUM(purchase_order_items.quantity) as total_quantity,
                         AVG(purchase_order_items.unit_price) as avg_unit_price'
                    )
                        ->join('purchase_orders', 'purchase_orders.id', '=', 'purchase_order_items.purchase_order_id') // Join Purchase Orders
                        ->whereNull('purchase_orders.deleted_at') // Exclude soft-deleted purchase orders
                        ->groupBy('purchase_order_items.product_id', 'purchase_orders.supplier_id') // Group by Product and Supplier
                        ->get();

                    $aggregatedStockData->each(function ($item) {
                        $supplier = Supplier::find($item->supplier_id); // Fetch supplier by ID
                        $item->supplier_name = $supplier ? $supplier->company_name : 'Unknown Supplier'; // Attach name or fallback
                        $currentStock = $this->getTotalCurrentStock($item->product_id); // Calculate current stock
                        $item->current_stock = $currentStock;
                    });

                    return $aggregatedStockData;
                }
                /**
                 * Calculate total current stock for a given product ID.
                 *
                 * @param int $productId
                 * @return float
                 */
                private function getTotalCurrentStock($productId)
                {
                    // Add logic to calculate current stock for a given product
                    return \App\Models\Stock::where('product_id', $productId)->sum('quantity');
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
