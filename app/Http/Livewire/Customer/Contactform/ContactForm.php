<?php

namespace App\Http\Livewire\Customer\Contactform;

use Alert;
use App\Jobs\ContactJob;
use Http;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;

    public $email;

    public $phone;

    public $subject;

    public $message;

    public $captcha = 0;

    protected $validationAttributes = [
        'name' => 'Full Name',
        'email' => 'Email Address',
        'phone' => 'phone number',
        'subject' => 'Subject',
        'message' => 'Message',
    ];

    protected function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required|phone:ph',
            'subject' => 'required|max:50',
            'message' => 'required|max:255',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required|phone:ph',
            'subject' => 'required|max:50',
            'message' => 'required|max:255',
        ]);
    }

    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret='.env('CAPTCHA_SECRET_KEY').'&response='.$token);
        $this->captcha = $response->json()['score'];

        if ($this->captcha > .3) {
            $this->store();
        } else {
            Alert::error('Message Successfully Sent', '');

            return redirect()->route('contact');
        }
    }

    public function store()
    {
        $this->validate();
        $contact = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
        dispatch(new ContactJob($contact));
        Alert::success('Message Successfully Sent', '');

        return redirect()->route('contact');
    }

    public function render()
    {
        return view('livewire.customer.contactform.contact-form');
    }
}
