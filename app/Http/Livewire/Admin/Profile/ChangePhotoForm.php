<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Alert;
use App\Models\User;

class ChangePhotoForm extends Component
{
    use WithFileUploads;

    public $photo;

    protected function rules()
    {
        return [
            'photo' => 'required|image|mimes:png,jpeg,jpg,svg|max:2048',
        ];
    }

    public function update($fields)
    {
        $this->validateOnly($fields, [
            'photo' => 'required|image|mimes:png,jpeg,jpg,svg|max:2048',
        ]);
    }

    private function cleanVars()
    {
        $this->photo = null;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseChangePhotoModal');
    }


    public function StoreUserProfile(){
        $this->validate();
        $user_id = Auth::guard('web')->user()->id;
        $user_info = User::findorfail($user_id);

        if (! Storage::disk('public')->exists('employee_profile_picture')) {
            Storage::disk('public')->makeDirectory('employee_profile_picture', 0775, true);
        }
        Storage::delete('public/employee_profile_picture/'.$user_info->photo);
        $this->photo->store('public/employee_profile_picture');

        $user_info->photo = $this->photo->hashName();
        $user_info->update();

        Alert::success('Success', 'Profile Picture was changed successfully');

        return redirect()->route('profile.index');
    }
    public function render()
    {
        return view('livewire.admin.profile.change-photo-form');
    }


}
