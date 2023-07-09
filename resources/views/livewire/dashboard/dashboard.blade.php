<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input
                                wire:model.debounce="lnbitsUrl"
                                type="url" label="LNbits URL" placeholder="LNbits URL"/>
                        </div>
                        <div>
                            <x-input
                                wire:model.debounce="lnbitsAdminApiKey"
                                type="password" label="LNbits Admin API Key" placeholder="LNbits Admin API Key"
                                hint="Bitte benutze diese Software self-hosted."
                                corner-hint="Vorsicht!"
                            />
                        </div>
                    </div>
                    @if($connected)
                        <div class="rounded-md bg-green-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">Verbunden mit {{ config('bitcoin.lnbits.url') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">Keine Verbindung zu {{ config('bitcoin.lnbits.url') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 divide-y divide-amber-500 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Bitcoin Geschenke') }}
                            </h2>
                        </div>
                        <div>
                            <x-button
                                :disabled="!$lnbitsUrl || !$lnbitsAdminApiKey"
                                icon="plus">
                                Neues Geschenk anlegen
                            </x-button>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 pt-6">
                        <div>
                            <x-input
                                wire:model.debounce="receiver"
                                label="Empfänger" placeholder="Empfänger"/>
                        </div>
                        <div>
                            <x-input
                                wire:model.debounce="amount"
                                type="number" label="Betrag" placeholder="Betrag"/>
                        </div>
                        <div>
                            <x-datetime-picker
                                without-time
                                wire:model.debounce="until" label="Ablaufdatum" placeholder="Ablaufdatum"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
