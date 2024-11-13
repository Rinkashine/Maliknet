<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Alert;
class EmployeeChangeInformation extends Component
{
    protected $listeners = [
        'forceCloseEditModal',
        'getModelInfo',
    ];

    public $name;

    public $phone;

    public $gender;

    public $birthday;

    public $address;

    public $employee_id;


    public $modelId;

    public function getModelInfo($modelId){
        $this->modelId = $modelId;

        $employee_info = User::find($this->modelId);

        $this->employee_id = $employee_info->id;
        $this->name = $employee_info->name;
        $this->phone = $employee_info->phone_number;
        $this->gender = $employee_info->gender;
        $this->birthday = $employee_info->birthday;
        $this->address = $employee_info->address;
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:50',
            'phone' => 'required|phone:PH',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required|max:50',

        ];
    }

    public function update($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:50',
            'phone' => 'required|phone:PH',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required|max:50',
        ]);
    }

    public function cleanVars()
    {
        $this->name = null;
        $this->phone = null;
        $this->gender = null;
        $this->birthday = null;
        $this->address = null;

    }

    public function UpdateProfileInformation()
    {
        $this->validate();
        $employee_info = User::findorfail($this->employee_id);
        $employee_info->name = $this->name;
        $employee_info->phone_number = $this->phone;
        $employee_info->gender = $this->gender;
        $employee_info->birthday = $this->birthday;
        $employee_info->address = $this->address;
        $employee_info->update();

        Alert::success('Success', 'Profile Information was updated successfully');

        return redirect()->route('profile.index');
    }

    public function CloseModal()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseEditInfoModal');
    }

    public function ForceClose()
    {
        $this->emit('CloseModal');
    }
    public function render()
    {
        return view('livewire.admin.profile.employee-change-information');
    }
}
