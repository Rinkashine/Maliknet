<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserEditForm extends Component
{
    public $user_id;

    public $name;

    public $email;

    public $role;

    public $gender;

    public $birthday;

    public $address;

    public $picture;

    public $phone;

    public $old_role;

    public function mount($user){
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

       $role =  $user->getRoleNames();
       $roles = Role::where('name', $role[0])->get()->first();

       $this->old_role = $roles->name;
        $this->role  = $roles->id;
        $this->gender = $user->gender;
        $this->birthday = $user->birthday;
        $this->address = $user->address;
        $this->phone = $user->phone_number;
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:40',
            'address' => 'required|max:100',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|phone:PH',
            'birthday' => 'required|date',
            'role' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:40',
            'address' => 'required|max:100',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|phone:PH',
            'birthday' => 'required|date',
            'role' => 'required',
        ]);
    }

    public function UpdateUserData()
    {
       $this->validate();

        $model = User::findorfail($this->user_id);
        $model->name = $this->name;
        $model->email = $this->email;
        $model->phone_number = $this->phone;
        $model->address = $this->address;
        $model->gender = $this->gender;
        $model->birthday = $this->birthday;
        $model->update();
        $model->removeRole($this->old_role);

        $model->assignRole($this->role);

        return redirect()->route('user.index')->with('success', $this->name.' was successfully updated');
    }



    public function render()
    {
        $roles = Role::whereNotIn('name', ['Super Admin'])->get();

        return view('livewire.admin.user.user-edit-form',[
            'roles' => $roles,
        ]);
    }
}
