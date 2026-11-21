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

Let op welk profiel actief is. Achter de router van de klant is dat Privé. In het lab (VirtualBox NAT) is het Openbaar. Noteer het als lab-verschil.

## Valkuilen

- Een router die via zijn WAN-poort achter een andere router hangt (lab: thuisrouter) is niet de grens met internet. Het WAN IP op de Netwerkkaart verraadt dit (privé-adres 192.168.x.x). Bij de klant nakijken of de providerrouter nog een eigen firewall heeft; dan zijn er twee.
- De firewallpagina van ASUS toont geen wachtwoorden of sleutels; schermafbeeldingen kunnen zonder afdekken.

## Nog niet in deze procedure

Stappen 2 tot 5 volgen.
