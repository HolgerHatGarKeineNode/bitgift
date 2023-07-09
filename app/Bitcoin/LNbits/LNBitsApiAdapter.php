<?php

namespace App\Bitcoin\LNbits;

use Illuminate\Support\Facades\Http;

class LNBitsApiAdapter implements \App\Bitcoin\WalletAPIInterface
{
    public function checkConnection(): bool
    {
        $response = Http::withHeaders([
            'X-Api-Key' => config('bitcoin.lnbits.admin_api_key'),
        ])
                        ->get(config('bitcoin.lnbits.url').'/api/v1/wallet');

        if ($response->json('id')) {
            return true;
        }

        return false;
    }

    public function getWithdrawLinks(): array
    {
        // TODO: Implement getWithdrawLinks() method.
    }

    public function getWithdrawLink(): array
    {
        // TODO: Implement getWithdrawLink() method.
    }

    public function createWithdrawLink(): array
    {
        // TODO: Implement createWithdrawLink() method.
    }

    public function updateWithdrawLink(): array
    {
        // TODO: Implement updateWithdrawLink() method.
    }

    public function deleteWithdrawLink(): bool
    {
        // TODO: Implement deleteWithdrawLink() method.
    }

    public function getWithdrawImage(): string
    {
        // TODO: Implement getWithdrawImage() method.
    }
}
