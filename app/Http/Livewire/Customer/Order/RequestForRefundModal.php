<?php

namespace App\Http\Livewire\Customer\Order;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ReturnReason;
use App\Models\CustomerOrder;
use App\Models\ReturnRequestImage;
use Illuminate\Support\Facades\Storage;

class RequestForRefundModal extends Component
{
    use WithFileUploads;

    public $model_id;

    public $returnreason,$description,$images;

    protected $validationAttributes = [
        'returnreason' => 'Reason',
    ];

    protected function rules()
    {
        return [
            'returnreason' => 'required|max:255',
            'description' => 'max:255',
            'images' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'returnreason' => 'required|max:255',
            'description' => 'max:255',
            'images' => 'required',
        ]);
    }

    protected $listeners = [
        'refreshChild' => '$refresh',
        'RequestforRefund'
    ];

    public function RequestforRefund($orderid){
        $this->model_id = $orderid;
        $this->dispatchBrowserEvent('openRequestForRefundModal');

    }

    public function cleanVars(){
        $this->model_id = null;
        $this->description = null;
        $this->returnreason = null;
        $this->photo = null;
    }
    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeRequestForRefundModal');

    }
    public function StoreRequestForRefund(){
        if (! Storage::disk('public')->exists('banner')) {
            Storage::disk('public')->makeDirectory('return_images', 0775, true);
        }

        $this->validate();

        $order = CustomerOrder::findorfail($this->model_id);
        $order->status = "Requesting For Refund";
        $order->refund_reason_id = $this->returnreason;
        $order->details = $this->description;
        $order->update();
        foreach($this->images as $image){
            $image->store('public/return_images');
            ReturnRequestImage::create([
                'customer_order_id' => $order->id,
                 'images' => $image->hashName(),
            ]);
        }
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeRequestForRefundModal');
        //temporary
        return redirect()->route('order.show',$order->id );


    }
    public function render()
    {
        $reasons = ReturnReason::get();
        return view('livewire.customer.order.request-for-refund-modal',[
            'reasons' => $reasons
        ]);
    }
}
