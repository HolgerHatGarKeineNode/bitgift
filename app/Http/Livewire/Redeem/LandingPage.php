<?php

namespace App\Http\Livewire\Redeem;

use App\Models\LNbitsWithdrawLink;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LandingPage extends Component
{
    public LNbitsWithdrawLink $withdrawLink;
    public string $qrCode;

    public int $euroRate = 0;

    public function mount()
    {
        $response = Http::get('https://api.coingecko.com/api/v3/exchange_rates');

        $this->euroRate = $response->json('rates.eur.value');

        $this->qrCode = base64_encode(QrCode::format('png')
                                            ->size(300)
                                            ->merge('/public/img/btc-logo.png', .3)
                                            ->errorCorrection('H')
                                            ->generate($this->withdrawLink->lnurl));
    }

    public function render()
    {
        return view('livewire.redeem.landing-page')->layout('layouts.guest');
    }
}
