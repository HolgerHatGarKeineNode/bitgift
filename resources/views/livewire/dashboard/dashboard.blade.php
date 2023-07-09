<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Geschenke') }}
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
                                    <p class="text-sm font-medium text-green-800">Verbunden
                                        mit {{ config('bitcoin.lnbits.url') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">Keine Verbindung
                                        zu {{ config('bitcoin.lnbits.url') }}</p>
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
                    </div>
                    <div class="grid grid-cols-4 gap-4 pt-6" wire:key="createNew">
                        <div>
                            <x-input
                                wire:model.debounce="receiver"
                                label="Empfänger" placeholder="Empfänger"/>
                        </div>
                        <div>
                            <x-input
                                min="10000"
                                wire:model.debounce="amount"
                                type="number" label="Sats" placeholder="Sats"/>
                        </div>
                        <div>
                            <x-datetime-picker
                                without-time
                                wire:model.debounce="until" label="Ablaufdatum" placeholder="Ablaufdatum"/>
                        </div>
                        <div>
                            <x-button
                                wire:click="createWithdrawLink"
                                :disabled="!$lnbitsUrl || !$lnbitsAdminApiKey"
                                icon="plus">
                                Neues Geschenk anlegen
                            </x-button>
                        </div>
                    </div>
                    @foreach($withdrawLinks as $withdrawLink)
                        <div>
                            <div class="grid grid-cols-4 gap-4 pt-6" wire:key="withdrawlink_{{ $withdrawLink->id }}">
                                <div>
                                    <x-input
                                        :value="$withdrawLink->title"
                                        label="Name des Empfängers" placeholder="Name des Empfängers"/>
                                </div>
                                <div>
                                    <x-input
                                        :value="$withdrawLink->min_withdrawable"
                                        type="number" label="Sats" placeholder="Sats"/>
                                </div>
                                <div>
                                    <x-datetime-picker
                                        :value="$withdrawLink->valid_until"
                                        wire:model.debounce="until" label="Ablaufdatum" placeholder="Ablaufdatum"/>
                                </div>
                                <div>
                                    @if($withdrawLink->uses === $withdrawLink->used)
                                        <x-badge green label="wurde eingelöst"/>
                                    @else
                                        <x-button
                                            wire:click="delete({{ $withdrawLink->id }})"
                                            icon="minus">
                                            Löschen
                                        </x-button>
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div>
                                    <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
                                        <div class="flex">
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    Teile diesen Link mit dem Empfänger:
                                                    <a
                                                        target="_blank"
                                                        href="{{ \Illuminate\Support\Facades\URL::signedRoute('redeem', ['withdrawLink' => $withdrawLink]) }}"
                                                       class="font-medium text-yellow-700 underline hover:text-yellow-600">
                                                        LINK ZUM EINLÖSEN DES GESCHENKS
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div>
                                    <x-input.simple-mde wire:model.defer="libraryItem.value"/>
                                </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>--}}
</div>
