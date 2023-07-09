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
                Mit der sicheren Phoenix Wallet kannst du dieses Bitcoin-Geschenk einlösen.
                Du hast allerdings nur 1 Monat Zeit dafür.
            </p>
            <p>
                Öffne diesen Link dazu am Besten auf deinem Rechner, damit du den QR-Code mit deinem Handy auf dem
                Monitor abscannen kannst.
            </p>
            <p>
                Am {{ $withdrawLink->valid_until->asDate() }} gehen die Satoshis zurück in meine Wallet.
            </p>
            <p>
                Warum Bitcoin?
            </p>
            <ul class="list-decimal leading-10 pl-8">
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
            <div class="pb-16">
                <a href="{{ $withdrawLink->lnurl }}">
                    <img id="redeem" src="{{ 'data:image/png;base64, '. $this->qrCode }}" alt="qrcode">
                </a>
            </div>
            <div wire:poll.keep-alive.1000ms="pollLink"></div>
        </div>
    @endif
</div>
