<?php

namespace App\Bitcoin;

interface WalletAPIInterface
{

    public function checkConnection(): bool;

    public function getWithdrawLinks(): array;

    public function getWithdrawLink(): array;

    public function createWithdrawLink(): array;

    public function updateWithdrawLink(): array;

    public function deleteWithdrawLink(): bool;

    public function getWithdrawImage(): string;

}
