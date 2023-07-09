<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input
                                wire:model="lnbitsUrl"
                                type="url" label="LNbits URL" placeholder="LNbits URL"/>
                        </div>
                        <div>
                            <x-input
                                wire:model="lnbitsAdminApiKey"
                                type="password" label="LNbits Admin API Key" placeholder="LNbits Admin API Key"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Bitcoin Geschenke') }}
                            </h2>
                        </div>
                        <div>
                            <x-button icon="plus">
                                Neues Geschenk anlegen
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
