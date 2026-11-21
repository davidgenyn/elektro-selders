# Procedure CyFun Basic bij een micro-kmo

Stand: 21 november 2026. Gebaseerd op CyFun Basic, CyFun 2025, versie 2025-10-01 (CCB). Basic 2025 telt 34 eisen (6 functies, met de nieuwe functie Govern) en 13 key measures. Versie 2023-03-01 blijft tijdelijk naast 2025 bestaan; daarna aanvaardt het CCB alleen nog 2025. Werk dus op 2025.

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

## Valkuilen

- Zoeken naar "what is my public ip" in Bing toont het adres van Bings eigen bot (Microsoft, msnbot), niet het jouwe. Rechtstreeks een IP-site openen (ifconfig.me). Het publieke adres van een klant is herleidbaar: afdekken in het dossier.
- Een router die via zijn WAN-poort achter een andere router hangt (lab: thuisrouter) is niet de grens met internet. Het WAN IP op de Netwerkkaart verraadt dit (privé-adres 192.168.x.x). Bij de klant nakijken of de providerrouter nog een eigen firewall heeft; dan zijn er twee.
- De firewallpagina van ASUS toont geen wachtwoorden of sleutels; schermafbeeldingen kunnen zonder afdekken.

## Nog niet in deze procedure

Stappen 2 tot 5 volgen.
