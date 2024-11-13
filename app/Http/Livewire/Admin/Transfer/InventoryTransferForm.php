<?php

namespace App\Http\Livewire\Admin\Transfer;

use Alert;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\PurchaseOrderTimeline;
use App\Models\Supplier;
use Livewire\Component;

class InventoryTransferForm extends Component
{
    public $transferproducts = [];

    public $mindate;

    protected $listeners = [
        'Prod',
    ];

    public $selectedProducts = [];

    public $query;

    public $origin;

    public $shipping;

    public $tracking;

    public $remarks;

    public $products;

    public $Sproduct = [];

    public $Quantity = [];

    public $validatequantity;

    public $toggleinfo = false;



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

    protected $validationAttributes = [
        'origin' => 'Supplier',
        'shipping' => 'Estimated Arrival',
        'selectedProducts.*.quantity' => 'quantity',
        'selectedProducts.*.price' => 'price',
        'selectedProducts.*.discount' => 'discount'
    ];

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

    public function mount()
    {
        $this->origin = '';
        $this->query = '';
        $this->products = [];
        $this->selectedProducts = [];
    }

    public function updatedQuery()
    {
        $this->products = Product::where('name', 'like', $this->query.'%')->take(10)
        ->get();
        // ->toArray();
    }

    public function AddTd(array $product)
    {
        foreach ($this->selectedProducts as $selectedProd) {
            if ($selectedProd['id'] == $product['id']) {
                return;
            }
        }
        $selectedProd['t_quantity'] = 1;

        array_push($this->selectedProducts, $product);
        $this->query = '';
        $this->products = '';
    }

    public function DeleteTd(array $products)
    {
        $key = array_search($products, $this->selectedProducts);
        unset($this->selectedProducts[$key]);
    }

    public function Cancel()
    {
        return redirect()->route('transfer.index');
    }

    public function StoreTransferData()
    {
        $this->validate();

        $count = count($this->selectedProducts);
        if ($count == 0) {
            Alert::error('Invalid Transfer', 'Missing Products');

            return redirect()->route('transfer.create');
        } else {
            $purchaseorder = PurchaseOrder::create([
                'suppliers_id' => $this->origin,
                'status' => 'Draft',
                'shipping_date' => $this->shipping,
                'tracking' => $this->tracking,
                'remarks' => $this->remarks,
            ]);

            foreach ($this->selectedProducts as $product) {
                PurchaseOrderItems::create([
                    'purchase_order_id' => $purchaseorder->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'discount' => $product['discount'],
                ]);
            }
            PurchaseOrderTimeline::create([
                'purchase_order_id' => $purchaseorder->id,
                'title' => 'Created as Draft',
            ]);

            return redirect()->route('transfer.index')->with('success', 'Purchase Order Created Successfully');
        }
    }

    public function render()
    {
        $suppliers = Supplier::get();
        if ($this->origin != null) {
            $supplierinfo = Supplier::where('id', $this->origin)->get();
            $this->toggleinfo = true;
        } else {
            $supplierinfo = [];
            $this->toggleinfo = false;
        }

        return view('livewire.admin.transfer.inventory-transfer-form', [
            'suppliers' => $suppliers,
            'supplierinfo' => $supplierinfo,
        ]);
    }
}
