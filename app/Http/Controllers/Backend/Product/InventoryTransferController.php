<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderTimeline;
use Illuminate\Support\Facades\Gate;

class InventoryTransferController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inventory_transfer_access'), 403);

        return view('admin.page.product.inventorytransfer');
    }

    public function create()
    {
        abort_if(Gate::denies('inventory_transfer_create'), 403);

        return view('admin.page.product.inventorytransferadd');
    }

    public function edit($id)
    {
        $orderinfo = PurchaseOrder::findorfail($id);

        if ($orderinfo->status == 'Received') {
            return redirect()->route('transfer.show', $id);
        }
        abort_if(Gate::denies('inventory_transfer_edit'), 403);

        return view('admin.page.product.inventorytransferedit', [
            'orderinfos' => $orderinfo,
        ]);
    }

    public function receive($orderinfo)
    {
        abort_if(Gate::denies('inventory_transfer_receive'), 403);
        $orderinfo = PurchaseOrder::findorfail($orderinfo);

        return view('admin.page.product.inventoryreceive', [
            'orderinfo' => $orderinfo,
        ]);
    }

    public function show($id)
    {
        abort_if(Gate::denies('inventory_transfer_show'), 403);

        $orderinfo = PurchaseOrder::with('suppliers', 'ordered_items')->findorfail($id);
        $purchase_order_timeline = PurchaseOrderTimeline::where('purchase_order_id', $id)->get();
        if ($orderinfo->status != 'Received') {
            return redirect()->route('transfer.edit', $id);
        }

        return view('admin.page.product.inventoryreceiveshow', [
            'orderinfo' => $orderinfo,
            'purchase_order_timeline' => $purchase_order_timeline,
        ]);
    }
}
