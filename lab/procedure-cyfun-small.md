# Procedure CyFun Small bij een micro-kmo

Stand: 10 november 2026. Gebaseerd op CyFun Small, versie 2023-03-01 (CCB). Het Small-document is bij de update naar CyFun 2025 niet herzien; de vereisten zijn dus in beide versies gelijk.

Dit is de interne werkinstructie van Weblotus. Het klantdossier staat apart in `dossier/`.

## Vóór je begint

- Vraag welke router de klant heeft (meestal de providerrouter). Noteer merk, model, en of hij nog firmware-updates krijgt. Zonder updates: vervangen adviseren.
- Maak van elke instellingspagina een schermafbeelding vóór en ná. Dek wachtwoordvelden af. Dat is het bewijs voor het dossier.
- Noteer datum en wie de handeling deed.
- Een auditor wil zien dát een wachtwoord gewijzigd is, niet wát het is. Geheimen horen nooit in het dossier.

## Punt 4 — Netwerk (router)

Wat het CCB vraagt: een geactiveerde en bijgewerkte firewall tussen intern netwerk en internet (mag de providerrouter zijn), beheerderswachtwoord van de firewall wijzigen, WPA2 of WPA3 met AES, wifi-wachtwoord met niemand delen, en waar nodig een apart gastnetwerk.

1. Fabrieksreset als de router van een vorige eigenaar of installateur komt. Reset-knop 5 à 10 s ingedrukt houden terwijl de router aanstaat.
2. Verbinden via het standaardnetwerk van de router (naam op het label onderaan). Beheerpagina openen (ASUS: http://192.168.50.1 of http://router.asus.com).
3. Wizard doorlopen: wifi-naam op bedrijfsnaam, wachtzin van minstens drie willekeurige woorden. Banden 2,4 en 5 GHz samen laten (één naam), tenzij een toestel per se 2,4 GHz nodig heeft.
4. Beheerdersnaam wijzigen (niet "admin"), eigen sterk wachtwoord, anders dan de wifi-sleutel. De klant bewaart dit offline (incidentcontactblad, punt 7).
5. Firmware bijwerken. Dit is meteen ook punt 2 (updates) voor de router.
6. Verificatie op WPA2/WPA3-Personal, codering AES. WPA3 maakt offline raden van het wachtwoord onmogelijk; de gemengde stand laat oude toestellen op WPA2.
7. Gastnetwerk aanmaken: eigen naam en eenvoudiger sleutel (die geef je aan bezoekers), WPA2/WPA3-Personal, toegangstijd onbeperkt, SSID niet verbergen, **toegang tot intranet uitschakelen**. Op beide banden met dezelfde naam en sleutel.
8. WPS uitschakelen. De WPS-pincode van 8 cijfers is in enkele uren te raden door een ontwerpfout (de router controleert hem in twee helften). Met WPS aan is een sterk wifi-wachtwoord waardeloos.
9. Test: laptop op het gastnetwerk, het routeradres openen. Moet mislukken. Daarnaast een gewone website openen: moet lukken.

### ASUS RT-AX55 — specifiek

- De wizard vraagt de firmware-upgrade meteen na het aanmaken van het beheerdersaccount. De router herstart; de browser toont even "Page Unresponsive". Op Wait klikken, niet de stroom onderbreken.
- Bij het kiezen van WPA2/WPA3-Personal geeft ASUS een waarschuwing over AiMesh en oude toestellen. Zonder mesh gewoon OK klikken.
- Gastnetwerk: menu Gastnetwerk, per band drie plaatsen; de eerste gebruiken. De derde is voor Amazon Alexa.
- WPS: menu Draadloos, tabblad WPS, schakelaar op OFF.
- Firmware: ASUS brengt nog updates uit voor dit model (laatste gezien: 3.0.0.4.386_53370, 4 september 2026). In 2023 waren er ernstige lekken in dit model; die zijn via firmware gedicht.

## Valkuilen

- ASUS toont de wifi-sleutel in klare tekst op de Netwerkkaart en onder Draadloos > Algemeen. Afdekken bij schermafbeeldingen. Beheerinterface sluiten na gebruik bij de klant. Wie het routerwachtwoord kent, kent de wifi-sleutel: daarom moet dat routerwachtwoord echt apart zijn.
- Na de reset verbind je via het standaardnetwerk van de router. Na de wizard verandert die naam; opnieuw verbinden.
- Na een herstart van de router springt de laptop vaak terug naar een ander bekend wifi-netwerk. Eerst controleren op welk netwerk je zit vóór je "router onbereikbaar" besluit.
- De gasttest op de laptop doen, niet op een smartphone. Browsers op een telefoon behandelen een kaal IP-adres als zoekopdracht; een typfout zoals "https//" (zonder dubbele punt) gaat ook naar de zoekmachine.
- De WPS-pincode staat op het label onderaan de router. Een foto van dat label is een foto van een toegangssleutel, zolang WPS aanstaat.
- Een wachtwoord dat ergens leesbaar is beland (schermafbeelding, chat, mail) geldt als gelekt en wordt vervangen. Dat is ook de regel van het CCB.

## Nog niet in deze procedure

Punten 1 (MFA), 2 (Windows-updates), 3 (antivirus), 5 (back-up), 6 (beheerdersrechten) en 7 (slotaanbevelingen) volgen.

## Bron

- CyFun Small NL, versie 2023-03-01: https://ccb.belgium.be/sites/default/files/cyberfundamentals/CYFUN_SMALL_NL_20230301.pdf
- CyberFundamentals Framework (Safeonweb@work): https://atwork.safeonweb.be/nl/tools-resources/cyberfundamentals-framework
