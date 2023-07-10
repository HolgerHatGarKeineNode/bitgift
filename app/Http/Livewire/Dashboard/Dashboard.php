<?php

namespace App\Http\Livewire\Dashboard;

use App\Bitcoin\WalletAPIInterface;
use App\Models\LNbitsWithdrawLink;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Dashboard extends Component
{
    public $lnbitsUrl = '';
    public $lnbitsAdminApiKey = '';
    public $receiver = '';
    public $balance = 0;
    public $amount = 3000;
    public $until;
    public $connected = false;
    public Collection $withdrawLinks;

    public function rules()
    {
        return [
            'lnbitsUrl'         => 'required|url',
            'lnbitsAdminApiKey' => 'required',

            'receiver' => 'required|string',
            'amount'   => 'required|integer|min:3000',
            'until'    => 'required|date',
        ];
    }

    public function mount(WalletAPIInterface $walletAPI)
    {
        $currentUser = auth()->user();
        $this->until = now()
            ->addMonth()
            ->format('Y-m-d');
        $this->lnbitsUrl = $currentUser->lnbits_url;
        $this->lnbitsAdminApiKey = $currentUser->lnbits_admin_api_key;

        $this->balance = $walletAPI->checkConnection();
        $this->connected = $this->balance !== false;
        collect(
            $walletAPI->getWithdrawLinks())->each(
            fn($withdrawLink) => LNbitsWithdrawLink::query()
                                                   ->updateOrCreate(
                                                       [
                                                           'lnbits_id' => $withdrawLink['id'],
                                                       ],
                                                       $withdrawLink
                                                   )
        );
        $this->withdrawLinks = LNbitsWithdrawLink::query()
                                                 ->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createWithdrawLink(WalletAPIInterface $walletAPI)
    {
        $this->validate();

        $walletAPI->createWithdrawLink(
            title: $this->receiver,
            min_withdrawable: $this->amount,
            max_withdrawable: $this->amount,
            uses: 1,
            wait_time: 1,
            is_unique: false,
            webhook_url: url()->route('webhook'),
            valid_until: $this->until
        );
        $this->amount = 10000;
        $this->receiver = '';
        $this->until = now()
            ->addMonth()
            ->format('Y-m-d');
        $this->withdrawLinks = LNbitsWithdrawLink::query()
                                                 ->get();
        $this->balance = $walletAPI->checkConnection();
        $this->connected = $this->balance !== false;
    }

    public function delete($id, WalletAPIInterface $walletAPI)
    {
        $walletAPI->deleteWithdrawLink((int) $id);
        $this->withdrawLinks = LNbitsWithdrawLink::query()
                                                 ->get();
        $this->balance = $walletAPI->checkConnection();
        $this->connected = $this->balance !== false;
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
