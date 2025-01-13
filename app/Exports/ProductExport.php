<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::with('category')->get();
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->category->name,
            $product->brand->name,
            $product->stock,
            $product->SKU,
            $product->cprice,
            $product->sprice,
            $product->weight,
            $product->description,
        ];
    }

    public function headings(): array
    {
        return [
            'Product Name',
            'Category Name',
            'Brand Name',
            'Inventory Stock',
            'SKU',
            'Cost Price',
            'Selling Price',
            'Weight',
            'Description',
        ];
    }
}
