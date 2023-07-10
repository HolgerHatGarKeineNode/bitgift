<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    @if($used)
        <div class="space-y-6">
            <div class="rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">Du hast die Satoshis erfolgreich auf deine eigene
                            Wallet abgehoben.</p>
                        <p class="text-sm font-medium text-green-800">Viel Freude beim Ausgeben deiner Satoshis oder
                            einfach nur Hodln.</p>
                        <p class="mt-6 text-sm font-medium text-green-800">
                            Hier ein Link auf <a target="_blank" class="text-sm font-bold text-green-800 underline"
                                                 href="https://btcmap.org">BTCmap.org</a>.
                            Auf dieser Seite findest du Shops in deiner Nähe, die Satoshis als Zahlungsmittel
                            aktzeptieren.</p>
                    </div>
                </div>
            </div>

        </div>
    @else
        <div class="space-y-6">
            <div class="bg-white">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Ein Geschenk von {{ \App\Models\User::first()->name }}</h2>
            </div>
            <p>
                Hallo {{ $withdrawLink->title }},
            </p>
            <p>
                ich möchte dir gerne <span class="font-bold text-xl">{{ number_format($withdrawLink->min_withdrawable, 0, ',', '.') }} sats</span>
                schenken.
            </p>
            <p>
                Dies sind derzeit
                ungefähr: {{ money(($withdrawLink->min_withdrawable / 100000000) * $euroRate, 'EUR') }}
            </p>
            <div>
                <x-button
                    href="#redeem"
                    orange
                    icon="arrow-down"
                >
                    Jetzt einlösen und abheben
                </x-button>
            </div>
            <p>
                Mit der sicheren <span class="font-bold text-green-500">Phoenix Wallet</span> kannst du dieses
                Bitcoin-Geschenk einlösen.
                Du hast allerdings nur 1 Monat Zeit dafür.
            </p>
            <p>
                Am {{ $withdrawLink->valid_until->asDate() }} gehen die Satoshis zurück in meine Wallet.
            </p>
            <p class="text-orange-500">
                Benutze die Phoenix Wallet bitte nur für <span class="font-semibold underline">kleine Beträge</span>. Für größere Beträge nimmt man bei Bitcoin eine Hardware-Wallet.
                Aber dazu kannst mich gerne anschreiben.
            </p>

            <nav aria-label="Progress">
                <ol role="list" class="overflow-hidden">
                    <li class="relative pb-10">
                        <div class="absolute left-4 top-4 -ml-px mt-0.5 h-full w-0.5 bg-green-600"
                             aria-hidden="true"></div>
                        <x-steps.current title="Phoenix Wallet runterladen">
                            <x-slot name="description">
                                <div class="flex space-x-4">
                                    <a href="https://play.google.com/store/apps/details?id=fr.acinq.phoenix.mainnet"
                                       target="_blank"><img
                                            class="h-10"
                                            src="{{ asset('img/googleplay.png') }}" alt="googleplay"></a>
                                    <a href="https://apps.apple.com/us/app/phoenix-wallet/id1544097028" target="_blank"><img
                                            class="h-10"
                                            src="{{ asset('img/appstore.svg') }}"
                                            alt="googleplay"></a>
                                </div>
                            </x-slot>
                        </x-steps.current>
                    </li>
                    <li id="redeem" class="relative pb-10">
                        <div class="absolute left-4 top-4 -ml-px mt-0.5 h-full w-0.5 bg-green-600"
                             aria-hidden="true"></div>
                        <x-steps.current title="Geld abheben">
                            <x-slot name="description">
                                <div class="flex flex-col space-y-4">
                                    <h2 class="font-bold">1. Variante Wallet direkt öffnen (im Handy)</h2>
                                    <div>
                                        <x-button
                                            lg
                                            green
                                            :href="'lightning:'.$withdrawLink->lnurl"
                                        >
                                            Wallet öffnen
                                        </x-button>
                                    </div>
                                    <h2 class="font-bold">2. Variante QR-Code scannen</h2>
                                    Öffne die Phoenix Wallet und scanne den QR-Code.
                                    <div>
                                        <img class="h-24" src="{{ asset('img/redeem.png') }}" alt="redeem">
                                    </div>
                                    <div>
                                        <a href="lightning:{{ $withdrawLink->lnurl }}">
                                            <img id="redeem" src="{{ 'data:image/png;base64, '. $this->qrCode }}"
                                                 alt="qrcode">
                                        </a>
                                    </div>
                                </div>
                            </x-slot>
                        </x-steps.current>
                    </li>
                    <li class="relative pb-10">
                        <div class="absolute left-4 top-4 -ml-px mt-0.5 h-full w-0.5 bg-green-600"
                             aria-hidden="true"></div>
                        <x-steps.current title="Redeem/Einlösen bestätigen">
                            <x-slot name="description">
                                <img
                                    class="h-12"
                                    src="{{ asset('img/redeem_btn.png') }}" alt="phoenix">
                                Nachdem du auf Redeem/Einlösen geklickt hast, wird der Betrag in deine Wallet
                                transferiert.
                            </x-slot>
                        </x-steps.current>
                    </li>
                    <li class="relative">
                        <x-steps.current title="Dein Backup Seed Phrase aufschreiben">
                            <x-slot name="description">
                                <img
                                    class="h-18"
                                    src="{{ asset('img/settings.png') }}" alt="settings">
                                <img
                                    class="h-18"
                                    src="{{ asset('img/recovery.png') }}" alt="recovery">
                                Eine Seed Phrase ist eine Liste von Wörtern, die die Schlüsselinformation zum
                                Wiederherstellen eines Bitcoin-Wallets speichert.
                            </x-slot>
                        </x-steps.current>
                    </li>
                </ol>
            </nav>
            <p>
                Öffne diesen Link dazu am Besten auf deinem Rechner, damit du den QR-Code mit deinem Handy vom
                Monitor abscannen kannst.
            </p>
            <p class="text-orange-500 font-semibold">
                Warum Bitcoin?
            </p>
            <x-embed url="https://www.youtube.com/watch?v=zdVwgg036KE"/>
            <ul class="list-decimal leading-10 pl-8 text-orange-500 italic">
                <li>
                    Unabhängige Währung, keine Zentralbank.
                </li>
                <li>
                    Weltweite Transaktionen in Sekundenschnelle.
                </li>
                <li>
                    Unveränderliche Transaktionshistorie, hohe Datensicherheit.
                </li>
                <li>
                    Knapper als Gold, nur 21 Millionen BTC.
                </li>
                <li>
                    Fördert grüne Energie-Entwicklung.
                </li>
            </ul>
            <p>
                Freue mich, wenn dein Interesse geweckt wurde!
            </p>
            <p>
                Es gibt noch mehr darüber zu erfahren.
            </p>
            <p>
                Mit Bitcoin behältst du die Kontrolle über dein Geld. Du bist deine eigene Bank und unabhängig von
                staatlicher
                Aufsicht. Bitcoin kennt keine Grenzen und dein Recht auf Privatsphäre bleibt gewahrt.
            </p>
            <div wire:poll.keep-alive.2000ms="pollLink"></div>
        </div>
    @endif
</div>
