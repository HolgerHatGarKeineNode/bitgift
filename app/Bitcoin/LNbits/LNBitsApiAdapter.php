<?php

namespace App\Bitcoin\LNbits;

use App\Models\LNbitsWithdrawLink;
use Illuminate\Support\Facades\Http;

class LNBitsApiAdapter implements \App\Bitcoin\WalletAPIInterface
{
    public function checkConnection(): bool
    {
        $response = Http::lnbits()
                        ->get('api/v1/wallet');

        if ($response->json('id')) {
            return true;
        }

        return false;
    }

    public function getWithdrawLinks(): array
    {
        $response = Http::lnbits()
                        ->get('withdraw/api/v1/links');

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function getWithdrawLink(int $id): array
    {
        $lnbitsId = LNbitsWithdrawLink::query()
                                      ->where('id', $id)
                                      ->value('lnbits_id');

        $response = Http::lnbits()
                        ->get("withdraw/api/v1/links/{$lnbitsId}");

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function createWithdrawLink(
        string $title,
        int $min_withdrawable,
        int $max_withdrawable,
        int $uses,
        int $wait_time,
        bool $is_unique,
        string $webhook_url,
        string $valid_until
    ): array {
        $response = Http::lnbits()
                        ->post('withdraw/api/v1/links', [
                            'title'            => $title,
                            'min_withdrawable' => $min_withdrawable,
                            'max_withdrawable' => $max_withdrawable,
                            'uses'             => $uses,
                            'wait_time'        => $wait_time,
                            'is_unique'        => $is_unique,
                        ]);

        if ($response->successful()) {
            LNbitsWithdrawLink::query()
                              ->create(
                                  [
                                      ...collect($response->json())
                                          ->except('id')
                                          ->toArray(),
                                      'lnbits_id'   => $response->json('id'),
                                      'valid_until' => $valid_until,
                                  ]
                              );

            return $response->json();
        }

        return [];
    }

    public function updateWithdrawLink(): array
    {
        // TODO: Implement updateWithdrawLink() method.
    }

    public function deleteWithdrawLink(int $id): bool
    {
        $lnbitsId = LNbitsWithdrawLink::query()
                                      ->where('id', $id)
                                      ->value('lnbits_id');
        $response = Http::lnbits()
                        ->delete("withdraw/api/v1/links/{$lnbitsId}");

        if ($response->successful()) {
            LNbitsWithdrawLink::query()
                              ->where('id', $id)
                              ->delete();

            return true;
        }

        return false;
    }

    public function getWithdrawImage(): string
    {
        // TODO: Implement getWithdrawImage() method.
    }
}
