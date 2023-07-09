<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="space-y-6">
        <p>
            Hallo {{ $withdrawLink->title }},
        </p>
        <p>
            ich möchte dir gerne <span class="font-bold text-xl">{{ $withdrawLink->min_withdrawable }} sats</span>
            schenken.
        </p>
        <p>
            Dies sind derzeit ungefähr: {{ money(($withdrawLink->min_withdrawable / 100000000) * $euroRate, 'EUR') }} €
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
            Am {{ $withdrawLink->valid_until->asDate() }} verfällt das Geschenk.
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
            <img id="redeem" src="{{ 'data:image/png;base64, '. $this->qrCode }}" alt="qrcode">
        </div>
    </div>
</div>
