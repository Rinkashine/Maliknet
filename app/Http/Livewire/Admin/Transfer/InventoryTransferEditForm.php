<?php

namespace App\Http\Livewire\Admin\Transfer;

use Alert;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrderTimeline;
use App\Models\Supplier;
use Livewire\Component;

class InventoryTransferEditForm extends Component
{
    public $transferproducts = [];

    protected $listeners = [
        'Prod',
        'refreshChild' => '$refresh',
    ];

    public $status;

    public $selectedProducts = [];

    public $query;

    public $origin;

    public $shipping;

    public $tracking;

    public $remarks;

    public $model_id;

    public $products;

    public $timeline;

    public $Sproduct = [];

    public $Quantity = [];

    public $validatequantity;

    public $toggleinfo = false;

    public function Prod($value, $id, $index)
    {
        $this->selectedProducts[$index]['t_quantity'] = $value;
    }

    public function rules()
    {
        return [
            'origin' => 'required',
            'shipping' => 'required',
            'selectedProducts.*.quantity' => 'required|numeric|min:1',
            'selectedProducts.*.price' => 'required|numeric|min:0',
            'selectedProducts.*.discount' => 'required|numeric|min:0|max:100',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'origin' => 'required',
            'shipping' => 'required',
            'selectedProducts.*.quantity' => 'required|numeric|min:1',
            'selectedProducts.*.price' => 'required|numeric|min:0',
            'selectedProducts.*.discount' => 'required|numeric|min:0|max:100',
        ]);
    }

    protected $validationAttributes = [
        'origin' => 'Supplier',
        'shipping' => 'Estimated Arrival',
        'selectedProducts.*.quantity' => 'quantity',
        'selectedProducts.*.price' => 'price',
        'selectedProducts.*.discount' => 'discount'
    ];

    public $received_items;

    public function mount($orderinfos)
    {
        $this->model_id = $orderinfos->id;
        $this->origin = $orderinfos->suppliers_id;
        $this->shipping = $orderinfos->shipping_date;
        $this->tracking = $orderinfos->tracking;
        $this->remarks = $orderinfos->remarks;
        $this->status = $orderinfos->status;
        $this->products = [];
        $this->selectedProducts = [];

        $this->selectedProducts = PurchaseOrderItems::where('purchase_order_id', $orderinfos->id)
        ->join('product', 'purchase_order_items.product_id', '=', 'product.id')
        ->select('product.id as product_id', 'purchase_order_items.id as id', 'quantity', 'product.name as name', 'product.sku as SKU', 'purchase_order_items.price','purchase_order_items.discount')
        ->get()
        ->toArray();

        if ($this->status == 'Received') {
            $this->received_items = PurchaseOrderItems::where('purchase_order_id', $orderinfos->id)->get();
        }
    }

    public function updatedQuery()
    {
        $this->products = Product::where('name', 'like', $this->query.'%')->take(10)
        ->get()
        ->toArray();
    }

    public function UpdateTransferData()
    {
        $this->validate();

        $count = count($this->selectedProducts);
        if ($count == 0) {
            Alert::error('Invalid Transfer', 'Missing Products');

            return redirect()->route('transfer.create');
        } else {
            $model = PurchaseOrder::find($this->model_id);
            $model->suppliers_id = $this->origin;
            $model->shipping_date = $this->shipping;
            $model->tracking = $this->tracking;
            $model->remarks = $this->remarks;
            $model->update();
            $purchase_items = PurchaseOrderItems::where('purchase_order_id', $this->model_id)->delete();

            foreach ($this->selectedProducts as $key => $item) {
                PurchaseOrderItems::create([
                    'purchase_order_id' => $model->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount']
                ]);
            }

            return redirect()->route('transfer.edit', $this->model_id);
        }
    }

    public function AddTd(array $product)
    {
        foreach ($this->selectedProducts as $selectedProd) {
            if ($selectedProd['product_id'] == $product['id']) {
                return;
            }
        }
        $product['product_id'] = $product['id'];
        $product['quantity'] = 1;
        $product['price'] = 1;
        $product['discount'] = 0;
        $product['isAdded'] = true;
        array_push($this->selectedProducts, $product);
        $this->query = '';
        $this->products = '';
    }

    public function DeleteTd(array $product, $index)
    {
        $key = array_search($product, $this->selectedProducts);
        array_slice($this->selectedProducts, $index);
        $item = PurchaseOrderItems::find($product['id']);
        if (! $item) {
            return 0;
        }
        $item->delete();

        return redirect()->route('transfer.edit', $this->model_id);
    }

    public function Cancel()
    {
        return redirect()->route('transfer.index');
    }

    public function render()
    {
        $timeline = PurchaseOrderTimeline::where('purchase_order_id', $this->model_id)->get();
        $suppliers = Supplier::get();
        if ($this->origin != null) {
            $supplierinfo = Supplier::where('id', $this->origin)->get();
            $this->toggleinfo = true;
        } else {
            $supplierinfo = [];
            $this->toggleinfo = false;
        }



        return view('livewire.admin.transfer.inventory-transfer-edit-form', [
            'suppliers' => $suppliers,
            'supplierinfo' => $supplierinfo,
            'selectedProducts' => $this->selectedProducts,
            'purchase_order_timeline' => $timeline,

        ]);
    }
}
