# Procedure CyFun Small bij een micro-kmo

Stand: 11 november 2026. Gebaseerd op CyFun Small, versie 2023-03-01 (CCB). Het Small-document is bij de update naar CyFun 2025 niet herzien; de vereisten zijn dus in beide versies gelijk.

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

## Punt 2 — Beveiligingsupdates (kantoor-pc)

Wat het CCB vraagt: alleen ondersteunde software, automatisch bijgewerkt.

1. Windows-versie nakijken: Instellingen > Systeem > Info. Windows 10 is sinds 14 oktober 2025 niet meer ondersteund; dan vervangen of upgraden, niet "beveiligen".
2. Instellingen > Windows Update > Zoeken naar updates. Alles installeren, herstarten, opnieuw zoeken tot "U bent up-to-date". Dit kan meerdere herstarts vragen.
3. Nakijken dat updates niet gepauzeerd zijn (knop "Updates pauzeren" niet actief).
4. Schermafbeelding van "U bent up-to-date" met datum voor het dossier.
5. Klok en tijdzone nakijken (Instellingen > Tijd en taal). Een verkeerde tijd geeft fouten bij updates en certificaten.

Ook de andere software van de klant valt hieronder (browser, boekhoudpakket, Office). Die lijst noteren en nakijken.

## Punt 3 — Antivirus

Wat het CCB vraagt: een antivirus die actief is en automatisch bijwerkt.

1. Start > Windows-beveiliging > Virus- en bedreigingsbeveiliging. Wie beschermt? Bij twee pakketten naast elkaar (bv. een verlopen betaald pakket plus Defender) er één laten en de andere verwijderen.
2. Instellingen beheren: realtime-beveiliging, cloudbeveiliging, automatische verzending van voorbeelden en **manipulatiebeveiliging (Tamper Protection)** allemaal aan.
3. Uitsluitingen: lijst leeg, of elke regel verklaard. "C:\" of "Downloads" als uitsluiting is een gat.
4. Snelle scan uitvoeren; resultaat en duur noteren.
5. Waar je nakijkt wat Defender gedaan heeft: Windows-beveiliging > Beveiligingsgeschiedenis, en Logboeken > Toepassingen en services > Microsoft > Windows > Windows Defender > Operational (ID 1116 detectie, 1117 actie, 5001/5004 realtime uit/aan).

## Punt 5 — Back-up

Wat het CCB vraagt: regelmatige back-ups, getest, met een offline kopie.

1. Externe USB-schijf, NTFS. Wat erop staat blijft staan; Bestandsgeschiedenis maakt een eigen map `FileHistory` aan.
2. Configuratiescherm > Systeem en beveiliging > Bestandsgeschiedenis (zit niet in Instellingen) > schijf kiezen > Inschakelen. Standaard: elk uur, alle versies bewaren. Omvat Documenten, Bureaublad, Afbeeldingen, Muziek, Video's.
3. Eerste back-up loopt meteen; "Nu uitvoeren" start er later één zonder te wachten.
4. **Restore-test:** een bestand verwijderen, prullenbak leegmaken, terugzetten via "Persoonlijke bestanden terugzetten". Zonder deze test is er geen bewijs dat de back-up werkt.
5. Schijf veilig verwijderen en loskoppelen.
6. Routine afspreken en in het dossier zetten: wie, wanneer (bv. wekelijks op een vast moment), en bij voorkeur twee schijven afwisselend, waarvan één buiten het gebouw. Een permanent aangesloten schijf is geen offline kopie en wordt bij ransomware mee versleuteld.

Zet de boekhouding, facturen en klantbestanden in Documenten; wat daarbuiten staat (bv. een map op C:\), wordt niet meegenomen tenzij je ze toevoegt aan een bibliotheek.

## Punt 6 — Beheerdersrechten

Wat het CCB vraagt: niemand werkt dagelijks met beheerdersrechten; beheerders- en gebruikersaccounts gescheiden.

1. Eén lokaal beheerdersaccount (bv. `beheer`), wachtwoord offline bij de klant. Enkel voor installaties en instellingen.
2. Per persoon een gewoon account: Instellingen > Accounts > Andere gebruikers > Account toevoegen > "Ik heb de aanmeldingsgegevens van deze persoon niet" > "Gebruiker zonder Microsoft-account toevoegen". Accounttype **Standaardgebruiker** laten.
3. Controle: als gewone gebruiker ziet Instellingen > Accounts de pagina "Andere gebruikers" niet, en vraagt elke installatie het beheerderswachtwoord. Dat is de bedoeling; zo uitleggen aan de klant.
4. Lokaal account versus Microsoft-account: bij een micro-kmo zonder Microsoft 365 volstaan lokale accounts. Bij een Windows 11 Enterprise/Pro-installatie: in de wizard "Aanmeldopties" > "Domein toevoegen" kiezen; dat maakt gewoon een lokaal account.

## Punt 1 — Multifactorauthenticatie

Wat het CCB vraagt: MFA op alle accounts waar het kan, verplicht op beheerdersaccounts en op diensten op afstand.

1. Lijst van de online diensten van de klant: mailbox, bank, boekhouding, domeinregistrar, website, sociale media. Per dienst: MFA aan, methode authenticator-app (geen sms als het anders kan).
2. Mailbox eerst. Gmail: myaccount.google.com > Beveiliging > Verificatie in twee stappen > Authenticator-app koppelen (QR-code scannen in Microsoft of Google Authenticator) > daarna **ook "Inschakelen" klikken**: het koppelen van de app alleen zet de verificatie niet aan.
3. Back-upcodes genereren en offline bewaren bij het incidentcontactblad. Zonder codes sluit een verloren telefoon de klant buiten.
4. Lokale Windows-accounts en de router hebben geen MFA. In het dossier noteren als beperking met compenserende maatregelen (punt 6, sterk routerwachtwoord, geen beheer vanaf internet).

## Punt 7 — Slotaanbevelingen

1. Incidentcontactblad: sjabloon in `dossier/incidentcontactblad-sjabloon.md`. Klant vult in, drukt af, legt bij back-upschijf en back-upcodes. Herziening elke zes maanden.
2. Fysieke beveiliging: als advies meegeven en noteren (toestellen niet in het voertuig, back-up in afgesloten kast, sleutels en alarmcodes op naam).

## Valkuilen (vervolg, 11-11-2026)

- Bij het inschakelen van tweestapsverificatie bij Google verschijnt na het koppelen van de app nog een knop "Inschakelen". Zonder die klik staat er niets aan.
- Bestandsgeschiedenis vindt de schijf alleen als die NTFS is en als vaste letter zichtbaar is.
- De 48-cijferige BitLocker-herstelsleutel en MFA-back-upcodes zijn geheimen: nooit in het dossier, nooit in een chat.
- Een klant die zegt dat "alles twee keer beveiligd is" omdat hij twee antivirusprogramma's ziet staan: nakijken; meestal is er maar één actief en hinderen ze elkaar.

### Lab-specifiek (VirtualBox op Windows 11)

- Op een Windows-laptop blijft een hypervisor vaak draaien, ook na het verwijderen van Hyper-V, door Virtualization-based Security (Credential Guard, Windows Hello-isolatie). Controle: `systeminfo | findstr Hyper-V`. Wat het hier oploste: Hyper-V-rol verwijderd, `bcdedit /set hypervisorlaunchtype off`, `bcdedit /set vsmlaunchtype off`, en in `HKLM\SYSTEM\CurrentControlSet\Control\DeviceGuard\Scenarios` de sleutels `CredentialGuard` en `WindowsHello` op `Enabled=0`. Elke wijziging aan de opstartconfiguratie kan BitLocker om de herstelsleutel laten vragen: die eerst veiligstellen.
- Een toestel dat ooit in Entra/Intune zat, blijft beleid toepassen: `dsregcmd /status`, en loskoppelen met `dsregcmd /leave`.
- `bcdedit` met accolades in PowerShell faalt stil; in de klassieke Opdrachtprompt uitvoeren.
- Guest Additions installeren na de eerste start (Devices > Insert Guest Additions CD image, dan via Deze pc het dvd-station openen; Windows start de cd niet vanzelf). Gedeeld klembord: Devices > Shared Clipboard > Bidirectional.
- Snapshot nemen vóór elke test (Machine > Take Snapshot). De 90-dagen-evaluatie van Windows 11 Enterprise verloopt op 9 februari 2027; dan opnieuw installeren.

## Bron

- CyFun Small NL, versie 2023-03-01: https://ccb.belgium.be/sites/default/files/cyberfundamentals/CYFUN_SMALL_NL_20230301.pdf
- CyberFundamentals Framework (Safeonweb@work): https://atwork.safeonweb.be/nl/tools-resources/cyberfundamentals-framework
