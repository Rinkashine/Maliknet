<?php

namespace App\Http\Livewire\Customer\Auth;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Alert;
class CustomerSetPasswordForm extends Component
{
    protected $listeners = [
        'getCustomerId',
    ];

    public $model_id;

    public $password;

    public $password_confirmation;

    public function getCustomerId($id){
        $this->modelId = $id;


    }
    public function cleanVars(){
        $this->password = null;
        $this->password_confirmation  = null;
    }

    public function forceCloseModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseSetPasswordModal');
    }

    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseSetPasswordModal');
    }

    public function StoreNewPassword(){
        $this->validate();
        $model = Customer::find($this->modelId);
        $model->password = Hash::make($this->password);
        $model->update();
        Alert::success('Password was changed', 'Your password was changed successfully');
        return redirect()->route('customer.profile');
    }

    protected function rules(){
        return [
            'password' => ['required', Password::defaults(),'same:password_confirmation'],
        ];
    }

    public function render()
    {
        return view('livewire.customer.auth.customer-set-password-form');
    }
}
