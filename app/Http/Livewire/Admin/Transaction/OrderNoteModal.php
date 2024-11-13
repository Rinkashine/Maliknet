<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\CustomerOrder;
use Livewire\Component;

class OrderNoteModal extends Component
{
    public $model_id;

    public $notes;

    protected $listeners = [
        'getOrderIdModal',
        'forceCloseModal',
    ];

    protected function rules()
    {
        return [
            'notes' => 'max:255',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'notes' => 'max:255',
        ]);
    }

    public function getOrderIdModal($modelId)
    {
        $this->model_id = $modelId;
        $model = CustomerOrder::findorfail($this->model_id);
        $this->notes = $model->order_notes;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeOrderNotesModal');
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function cleanVars()
    {
        $this->model_id = null;
        $this->notes = null;
    }

    public function StoreNoteData()
    {
        $this->validate();
        $model = CustomerOrder::findorfail($this->model_id);
        $model->order_notes = $this->notes;
        $model->update();
        $this->emit('refreshParent');
        $this->resetErrorBag();
        $this->cleanVars();
        $this->emit('refreshParent');

        $this->dispatchBrowserEvent('closeOrderNotesModal');

    }

    public function render()
    {
        return view('livewire.admin.transaction.order-note-modal');
    }
}
