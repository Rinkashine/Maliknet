<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\CustomerOrder;

class EditOrderNoteModal extends Component
{

    public $model_id;

    public $notes;

    protected $listeners = [
        'getOrderIdNoteModal',
        'forceCloseModal',
    ];

    protected function rules()
    {
        return [
            'notes' => 'required|max:255',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'notes' => 'required|max:255',
        ]);
    }

    public function getOrderIdNoteModal($modelId)
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

    public function UpdateNoteData()
    {
        $this->validate();
        $model = CustomerOrder::findorfail($this->model_id);
        $model->order_notes = $this->notes;
        $model->update();

        return redirect()->route('orders.show', $this->model_id);
    }


    public function render()
    {
        return view('livewire.admin.transaction.edit-order-note-modal');
    }
}
