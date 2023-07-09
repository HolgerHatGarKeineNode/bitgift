<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public $lnbitsUrl = '';
    public $lnbitsAdminApiKey = '';
    public $receiver = 'Markus Turm';
    public $amount = 21000;
    public $until;

    public function rules()
    {
        return [
            'lnbitsUrl'         => 'required|url',
            'lnbitsAdminApiKey' => 'required',
        ];
    }

    public function mount()
    {
        $currentUser = auth()->user();
        $this->until = now()->addDays(7)->format('Y-m-d');
        $this->lnbitsUrl = $currentUser->lnbits_url;
        $this->lnbitsAdminApiKey = $currentUser->lnbits_admin_api_key;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
