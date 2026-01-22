<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ProductsImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $data = $row->toArray();
        if (empty($data['sku'])) {
            return;
        }
        $product = Product::where('sku', $data['sku'])->first();
        $fields = [];
        if (isset($data['name'])) $fields['name'] = $data['name'];
        if (isset($data['barcode'])) $fields['barcode'] = $data['barcode'];
        if (isset($data['description'])) $fields['description'] = $data['description'];
        if (isset($data['price'])) $fields['price'] = $data['price'];
        if (isset($data['cost_price'])) $fields['cost_price'] = $data['cost_price'];
        if (isset($data['stock'])) $fields['stock'] = $data['stock'];
        if (isset($data['min_stock'])) $fields['min_stock'] = $data['min_stock'];
        if (isset($data['category'])) $fields['category_id'] = Category::where('name', $data['category'])->value('id');
        if (isset($data['supplier'])) $fields['supplier_id'] = Supplier::where('name', $data['supplier'])->value('id');
        if (isset($data['warehouse'])) $fields['warehouse_id'] = Warehouse::where('name', $data['warehouse'])->value('id');
        if (isset($data['weight'])) {
            $fields['weight'] = is_numeric($data['weight']) ? floatval($data['weight']) : 0;
        }

        if ($product) {
            $product->update($fields);
        } else {
            $fields['sku'] = $data['sku'];
            Product::create($fields);
        }
    }
}
