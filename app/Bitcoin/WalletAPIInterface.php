<?php

namespace App\Bitcoin;

interface WalletAPIInterface
{

    public function checkConnection(): bool;

    public function getWithdrawLinks(): array;

    public function getWithdrawLink(): array;

    public function createWithdrawLink(
        string $title,
        int $min_withdrawable,
        int $max_withdrawable,
        int $uses,
        int $wait_time,
        bool $is_unique,
        string $webhook_url,
        string $valid_until
    ): array;

    public function updateWithdrawLink(): array;

    public function deleteWithdrawLink(int $id): bool;

    public function getWithdrawImage(): string;

}
