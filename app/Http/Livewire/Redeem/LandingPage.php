<?php

namespace App\Http\Livewire\Redeem;

use App\Bitcoin\WalletAPIInterface;
use App\Models\LNbitsWithdrawLink;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LandingPage extends Component
{
    public LNbitsWithdrawLink $withdrawLink;
    public string $qrCode;

    public int $euroRate = 0;

    public bool $used = false;

    public function mount(WalletAPIInterface $walletAPI)
    {
        $withdrawLink = $walletAPI->getWithdrawLink($this->withdrawLink->id);

        if ($withdrawLink['used'] === $withdrawLink['uses']) {
            $this->used = true;
        }

        $response = Http::get('https://api.coingecko.com/api/v3/exchange_rates');

        $this->euroRate = $response->json('rates.eur.value');

        $this->qrCode = base64_encode(QrCode::format('png')
                                            ->size(300)
                                            ->merge('/public/img/btc-logo.png', .3)
                                            ->errorCorrection('H')
                                            ->generate($this->withdrawLink->lnurl));
    }

    public function pollLink(WalletAPIInterface $walletAPI)
    {
        $withdrawLink = $walletAPI->getWithdrawLink($this->withdrawLink->id);

        if ($withdrawLink['used'] === $withdrawLink['uses']) {
            $this->used = true;
        }
    }

    public function render()
    {
        return view('livewire.redeem.landing-page')->layout('layouts.guest', [
            'SEOData' => new SEOData(
                title: number_format($this->withdrawLink->min_withdrawable, 0, ',', '.')
                       .' Satoshis für dich als Geschenk',
                description: 'Nichts ist einfacher als Bitcoin zu verschenken. Mit diesem Link kannst du dir '.
                             number_format($this->withdrawLink->min_withdrawable, 0, ',', '.')
                             .' Satoshis abholen. Du brauchst nur eine Lightning Wallet.',
                image: asset('img/btc-logo.png'),
            ),
        ]);
    }
}
