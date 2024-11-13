<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UserCreateForm extends Component
{
    use WithFileUploads;

    public $name;

    public $email;

    public $role;



    public $gender;

    public $birthday;

    public $address;

    public $picture;

    public $phone;

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

    public function StoreUserData()
    {
        $this->validate();
        $imagename = $this->email.Str::random(10);
        $password = "Onepiece25!";
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone,
            'address' => $this->address,
            'password' => $password,
            'photo' => $imagename.'.png',
            'gender' => $this->gender,
            'birthday' => $this->birthday,

        ];

        $user = User::create($data);

        if (! Storage::disk('public')->exists('employee_profile_picture')) {
            Storage::disk('public')->makeDirectory('employee_profile_picture', 0775, true);
        }

        $avatar = Avatar::create($this->name)->save(storage_path('app/public/employee_profile_picture/'.$imagename.'.png'));
        $user->assignRole($this->role);

        return redirect()->route('user.index')->with('success', $this->name.' was successfully inserted');
    }

    public function render()
    {
        $roles = Role::whereNotIn('name', ['Super Admin'])->get();

        return view('livewire.admin.user.user-create-form', [
            'roles' => $roles,
        ]);
    }
}
