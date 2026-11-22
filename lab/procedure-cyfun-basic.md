# Procedure CyFun Basic bij een micro-kmo

Stand: 22 november 2026. Gebaseerd op CyFun Basic, CyFun 2025, versie 2025-10-01 (CCB). Basic 2025 telt 34 eisen (6 functies, met de nieuwe functie Govern) en 13 key measures. Versie 2023-03-01 blijft tijdelijk naast 2025 bestaan; daarna aanvaardt het CCB alleen nog 2025. Werk dus op 2025.

Dit is de interne werkinstructie van Weblotus. Het klantdossier staat apart in `dossier/`. Vooraf: Small volledig afgerond en gedocumenteerd; Basic bouwt daarop verder.

## Volgorde

1. Firewall-bewijs (PR.IR-01.1, DE.CM-01.1) — kwartier.
2. Logs (PR.PS-04.1, DE.AE-03.1) — nieuw tegenover Small, twee key measures.
3. Toegangsrechten (PR.AA-05.1, 05.2, 05.3) — één tabel voor een micro-kmo.
4. Inventaris en gegevens (ID.AM-01.1, 02.1, 07.1).
5. Beleid, risicoanalyse, overige papieren eisen (Govern, ID.RA, PR.AT, RS, RC).

Technisch eerst, papier daarna: het beleid schrijf je af van wat je in de techniek hebt vastgesteld.

## Stap 1 — Firewall (PR.IR-01.1, DE.CM-01.1)

Wat het CCB vraagt: firewalls op alle netwerken, geconfigureerd en actief onderhouden (PR.IR-01.1), én firewalls aan de netwerkgrens inclusief op de endpoints (DE.CM-01.1). "Standaard aan" volstaat niet; er moet bewijs zijn van configuratie.

### Router (ASUS RT-AX55)

Geavanceerde instellingen > Firewall > tabblad Algemeen. Eerst een schermafbeelding vóór (nulmeting), dan:

- Firewall inschakelen: Ja (standaard).
- DoS-beveiliging inschakelen: **Ja** (standaard Nee).
- Logged packets type: **Beide** (standaard Geen). Zonder dit houdt de router geen firewall-log bij. Dit is meteen de aanzet voor DE.AE-03.1.
- Respond ICMP Echo (ping) Request from WAN: Nee (standaard).
- IPv6-firewall inschakelen: Ja (standaard).
- Toepassen, dan schermafbeelding ná.

### Kantoor-pc (Windows 11)

Windows-beveiliging > Firewall en netwerkbeveiliging. Drie profielen (Domein, Privé, Openbaar), elk met "Firewall is ingeschakeld". Eén schermafbeelding van dat overzicht. Niet aanmelden als beheerder; het overzicht is leesbaar als Standard user.

Let op welk profiel actief is. Op het kantoornetwerk hoort Privé: Instellingen > Netwerk en internet > Ethernet > Netwerkprofieltype: Privé. Lukte als Standard user zonder beheerdersvraag. Schermafbeelding.

### Lab: VM achter de router hangen

Met VirtualBox op NAT (standaard) zit de VM op 10.0.2.x met VirtualBox als gateway; de ASUS is dan geen firewall voor de VM. Omzetten:

1. Laptop verbinden met het klantnetwerk (ElektroSelders), niet met de thuiswifi: een bridged VM volgt het netwerk van de kaart waaraan ze hangt.
2. VM afsluiten. Settings > Network > Adapter 1 > Attached to: Bridged Adapter; Name: de wifi-kaart van de laptop (Intel Wi-Fi 6 AX201). OK.
3. VM starten, `ipconfig`: adres 192.168.50.x, gateway 192.168.50.1. Website openen als internettest.

Bridged over wifi werkte op deze laptop. Werkt het niet (adres 169.254.x.x of nog 10.0.2.x): kabel van laptop naar ASUS en de Ethernet-kaart kiezen.

## Stap 2 — Logs (PR.PS-04.1, DE.AE-03.1)

Wat het CCB vraagt: logs bijhouden, documenteren en monitoren (PR.PS-04.1); logging van beveiligingstools aan, logs geback-upt, een vooraf bepaalde bewaartermijn, en regelmatig nakijken (DE.AE-03.1). Techniek is het kleine deel; de routine (wie, wanneer, wat) is de eis.

### Kantoor-pc (Windows 11)

1. Nulmeting als Standard user: Event Viewer openen, overzicht. Security-log toont N/A en Administrative Events geeft "Access is denied". Schermafbeelding: dat is bewijs voor least privilege (PR.AA-05.3).
2. Afmelden, aanmelden als beheerder. Event Viewer > Custom Views > Administrative Events. Elke Error en Critical aanklikken en duiden. Opzoeken wat je niet kent; niet gokken.
3. Windows Logs > Security > rechtsklik > Properties. Maximum log size op 102400 KB; "Archive the log when full, do not overwrite events". OK. Schermafbeelding vóór en ná.
4. Noteer in het dossier: wat genegeerd wordt en waarom (met bron), wat de bewaartermijn is, wie wanneer nakijkt.

### Router (ASUS RT-AX55)

Systeemlogboek > Algemeen logboek. Sinds "Logged packets type: Beide" (stap 1) staan er `kernel: DROP`-regels in, plus `HTTPD: [LOGIN]` voor aanmeldingen op de beheerpagina. Knop **Opslaan** downloadt het log als bestand; dat is de enige manier om het te bewaren. "Externe logboekserver" leeg laten bij een micro-kmo.

### Routine voor de klant

Op de maandelijkse controledag: Administrative Events en Security nakijken als beheerder; routerlog nakijken op onbekende aanmeldingen en opslaan in Documenten\Logs. Staat in het dossier als afspraak.

## Stap 3 — Toegangsrechten (PR.AA-05.1, 05.2, 05.3)

Wat het CCB vraagt: rechten bepaald, beheerd, afgedwongen en herzien; wie heeft toegang tot bedrijfskritieke informatie en hoe; least privilege.

Voor een micro-kmo is dit één document (`dossier/toegangsrechten.md`), vier delen:
1. Tabel per systeem: account, wie, rechten, waarvoor, hoe aanmelden. Ook de wifi-sleutels en de back-upschijf, want dat zijn toegangen zonder account.
2. Bedrijfskritieke informatie: waar staat ze, wie kan erbij, hoe.
3. Least privilege: per account wat het níet kan.
4. Beheer: wat gebeurt bij wijziging en vertrek; halfjaarlijkse herziening; wijzigingslog.

Vul het in vanuit wat er al is: Small punt 6 (accounts), punt 4 (wifi), punt 5 (back-up), stap 2 (Standard user leest het Security-log niet). Geen wachtwoorden in het document.

Eigen account voor de dienstverlener: bij deze testklant niet; je werkt met het beheerdersaccount van de klant onder toezicht. Bij een echte klant is een eigen account traceerbaar en intrekbaar, maar het is een extra account dat beheerd moet worden. Beslissing per klant, en ze staat in deel 1.

## Valkuilen

- Als Standard user zie je het Security-log niet en geeft Administrative Events een foutmelding. Niet proberen te omzeilen; aanmelden als beheerder.
- Regedit en Event Viewer-instellingen: ook als beheerder werkt een wijziging soms pas met "Run as administrator" (UAC).
- Event 2042 "Config Read Failed, Config 18, Access is denied", tweemaal bij elke start: bekend Microsoft-probleem (Windows 11 24H2, sinds juni 2025), firewall werkt. Niet als defect noteren. Eerst opzoeken, dan duiden: de eerste lezing "komt door de netwerkwissel" was fout.
- Het routerlog staat in het geheugen van de router en verdwijnt bij herstart. Opslaan als bestand, of het is weg.
- Het routerlog bevat MAC- en IP-adressen. Schermafbeelding afsnijden boven het logvenster voor het dossier; het opgeslagen logbestand blijft bij de klant.
- Een aanmelding vanaf een onbekend adres in het routerlog kan een tweede toestel van jezelf zijn (laptop naast VM). Nakijken met `ipconfig`, dan pas concluderen.
- Zoeken naar "what is my public ip" in Bing toont het adres van Bings eigen bot (Microsoft, msnbot), niet het jouwe. Rechtstreeks een IP-site openen (ifconfig.me). Het publieke adres van een klant is herleidbaar: afdekken in het dossier.
- Een router die via zijn WAN-poort achter een andere router hangt (lab: thuisrouter) is niet de grens met internet. Het WAN IP op de Netwerkkaart verraadt dit (privé-adres 192.168.x.x). Bij de klant nakijken of de providerrouter nog een eigen firewall heeft; dan zijn er twee.
- De firewallpagina van ASUS toont geen wachtwoorden of sleutels; schermafbeeldingen kunnen zonder afdekken.

## Nog niet in deze procedure

Stappen 4 en 5 volgen.
