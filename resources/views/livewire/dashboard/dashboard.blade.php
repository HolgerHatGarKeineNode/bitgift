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
                    @if($connected)
                        <div class="rounded-md bg-green-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        Verbunden mit {{ config('bitcoin.lnbits.url') }}. Aufgeladen mit {{ number_format($balance / 1000, 0, ',', '.') }} Sats.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        Keine Verbindung
                                        zu {{ config('bitcoin.lnbits.url') }}
                                    </p>
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
                                :min="config('bitcoin.min_withdraw')"
                                wire:model.debounce="amount"
                                type="number" label="Sats" placeholder="Sats"/>
                        </div>
                        <div>
                            <x-datetime-picker
                                :clearable="false"
                                without-time
                                wire:model.debounce="until" label="Ablaufdatum" placeholder="Ablaufdatum"/>
                        </div>
                        <div>
                            @if($balance < 10000000)
                                <div class="rounded-md bg-red-50 p-4">
                                    <div class="flex">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-red-800">
                                                Lade deine LNbits Wallet mit mindestens 10.000 Sats auf, um Geschenke zu erstellen.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <x-button
                                    wire:click="createWithdrawLink"
                                    :disabled="!$lnbitsUrl || !$lnbitsAdminApiKey"
                                    icon="plus">
                                    Neues Geschenk anlegen
                                </x-button>
                            @endif
                        </div>
                    </div>
                    @foreach($withdrawLinks as $withdrawLink)
                        <div>
                            <div class="grid grid-cols-4 gap-4 pt-6" wire:key="withdrawlink_{{ $withdrawLink->id }}">
                                <div>
                                    <x-input
                                        readonly
                                        :value="$withdrawLink->title"
                                        label="Name des Empfängers" placeholder="Name des Empfängers"/>
                                </div>
                                <div>
                                    <x-input
                                        readonly
                                        :value="$withdrawLink->min_withdrawable"
                                        type="number" label="Sats" placeholder="Sats"/>
                                </div>
                                <div>
                                    <x-datetime-picker
                                        readonly
                                        :clearable="false"
                                        :value="$withdrawLink->valid_until"
                                        wire:model.debounce="until" label="Ablaufdatum" placeholder="Ablaufdatum"/>
                                </div>
                                <div>
                                    @if($withdrawLink->uses === $withdrawLink->used)
                                        <x-badge green label="wurde eingelöst"/>
                                    @else
                                        <div class="flex justify-between">
                                            <div>
                                                <x-button
                                                    xs
                                                    red
                                                    wire:click="delete({{ $withdrawLink->id }})"
                                                    icon="minus">
                                                    Löschen
                                                </x-button>
                                            </div>
                                            <div>
                                                <x-button
                                                    target="_blank"
                                                    :href="\Illuminate\Support\Facades\URL::signedRoute('redeem', ['withdrawLink' => $withdrawLink])"
                                                    icon="globe">
                                                    Link
                                                </x-button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>--}}
</div>
