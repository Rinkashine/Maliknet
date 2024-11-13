<?php

namespace App\Http\Livewire\Admin\Transfer;

use Alert;
use App\Models\InventoryHistory;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrderTimeline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReceiveTransferForm extends Component
{
    public $transferproducts = [];

    public $receive = [];

    public $model_id;
    public function mount($orderinfo)
    {
        $this->model_id = $orderinfo->id;
        $this->transferproducts = PurchaseOrderItems::where('purchase_order_id', $orderinfo->id)
        ->join('product', 'purchase_order_items.product_id', '=', 'product.id')
        ->select('product.id as product_id', 'purchase_order_items.id as id', 'quantity', 'product.name as name', 'product.sku as SKU', 'purchase_order_items.price','purchase_order_items.discount')
        ->get()
        ->toArray();
    }

    public function rules()
    {
        return [
            'transferproducts.*.receive' => 'required|numeric|min:0',
        ];
    }

    protected $validationAttributes = [
        'transferproducts.*.receive' => 'accept quantity',

    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'transferproducts.*.receive' => 'required|numeric|min:0',
        ]);
    }


    public function StoreReceiveInventoryData()
    {
        $this->validate();

        foreach ($this->transferproducts as $transferproduct) {
            $product = Product::findorFail($transferproduct['product_id']);
            $PreviousStock = $product->stock;
            $order_items_quantity = $transferproduct['receive'];
            $latestStock = $PreviousStock + $order_items_quantity;
            $product->stock = $latestStock;
            $product->update();

            $operationvalue = "(+$order_items_quantity)";

            $order = PurchaseOrder::findorFail($this->model_id);
            $order->status = 'Received';
            $order->update();

            $item = PurchaseOrderItems::findorfail($transferproduct['id']);
            $item->accepted_quantity = $transferproduct['receive'];
            $item->update();

            InventoryHistory::create([
                'product_id' => $transferproduct['product_id'],
                'activity' => "Purchase Order #",
                'adjusted_by' => Auth::guard('web')->user()->name,
                'operation_value' => $operationvalue,
                'latest_value' => $product->stock,
                'purchase_order_id' => $order->id
            ]);

            PurchaseOrderTimeline::create([
                'purchase_order_id' => $this->model_id,
                'title' => 'Received the Items',
            ]);
        }

        Alert::success('Action Success', 'Proudct was successfully received');
        return redirect()->route('transfer.index');
    }

    public function render()
    {
        return view('livewire.admin.transfer.receive-transfer-form');
    }
}
