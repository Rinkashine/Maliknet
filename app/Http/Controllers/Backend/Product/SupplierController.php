<?php

namespace App\Http\Controllers\Backend\Product;

use App\Exports\SupplierExport;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    //Show Supplier Page
    public function index()
    {
        abort_if(Gate::denies('supplier_access'), 403);

        return view('admin.page.product.supplier');
    }

    //Show Supplier Create Page
    public function create()
    {
        abort_if(Gate::denies('supplier_create'), 403);

        return view('admin.page.product.supplieradd');
    }

    //Show Supplier Edit Page
    public function edit(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_edit'), 403);

        return view('admin.page.product.supplieredit', [
            'supplier' => $supplier,
        ]);
    }

    //Show Supplier Info Page
    public function show(Supplier $supplier)
    {
        abort_if(Gate::denies('supplier_show'), 403);

        return view('admin.page.product.suppliershow', [
            'supplier' => $supplier,
        ]);
    }

    //Show Supplier Archive Page
    public function SupplierArchiveIndex()
    {
        abort_if(Gate::denies('supplier_archive_access'), 403);

        return view('admin.page.product.supplierarchive');
    }

     //Export Supplier to Excel
    public function exportsupplierexcel()
    {
        abort_if(Gate::denies('supplier_export'), 403);

        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }

    //Export Supplier to CSV
    public function exportsuppliercsv()
    {
        abort_if(Gate::denies('supplier_export'), 403);

        return Excel::download(new SupplierExport, 'supplier.csv');
    }

    //Export Supplier to HTML
    public function exportsupplierhtml()
    {
        abort_if(Gate::denies('supplier_export'), 403);

        return Excel::download(new SupplierExport, 'supplier.html');
    }

    //Export Supplier to PDF
    public function exportsupplierpdf()
    {
        abort_if(Gate::denies('supplier_export'), 403);

        return Excel::download(new SupplierExport, 'supplier.pdf');
    }
}
