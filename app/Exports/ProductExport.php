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
            $product->price,
            $product->description,
        ];
    }

    public function headings(): array
    {
        return [
            'Product Name',
            'Category Name',
            'Price',
            'Description',
        ];
    }
}
