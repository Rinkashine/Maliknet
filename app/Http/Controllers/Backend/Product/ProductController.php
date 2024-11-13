<?php

namespace App\Http\Controllers\Backend\Product;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    //Show Product Table
    public function index()
    {
        abort_if(Gate::denies('product_access'), 403);

        return view('admin.page.product.product');
    }

    //Show Add Product Form
    public function create()
    {
        abort_if(Gate::denies('product_create'), 403);
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('admin.page.product.productadd', [
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
        ]);
    }


    //Show Edit Product Page
    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), 403);
        //$product = Product::findorFail($id);
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $images = $product->images;

        return view('admin.page.product.productedit', compact('product'), [
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
            'images' => $images,
        ]);
    }

      //Show Product Archive Page
      public function ProductArchiveIndex()
      {
          abort_if(Gate::denies('product_archive_access'), 403);
          $products = Product::onlyTrashed()->orderBy('name')->paginate(20);

          return view('admin.page.product.productarchive', [
              'products' => $products,
          ]);
      }

    public function ProductInventoryHistory($id)
    {
        $product = Product::findorfail($id);

        return view('admin.page.product.inventoryhistory', [
            'product' => $product,
        ]);
    }

    public function FeaturedProductIndex(){
        abort_if(Gate::denies('product_edit'),403);

        return view('admin.page.product.productfeatured');
    }

    //Export Product to Excel
    public function exportproductexcel()
    {
        abort_if(Gate::denies('product_export'), 403);

        return Excel::download(new ProductExport, 'products.xlsx');
    }

    //Export Product to CSV
    public function exportproductcsv()
    {
        abort_if(Gate::denies('product_export'), 403);

        return Excel::download(new ProductExport, 'products.csv');
    }

    //Export Product to HTML
    public function exportproducthtml()
    {
        abort_if(Gate::denies('product_export'), 403);

        return Excel::download(new ProductExport, 'products.html');
    }

    //Export Product to PDF
    public function exportproductpdf()
    {
        abort_if(Gate::denies('product_export'), 403);

        return Excel::download(new ProductExport, 'products.pdf');
    }


}
