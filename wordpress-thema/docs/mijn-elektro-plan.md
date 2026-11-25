# Plan "Mijn Elektro" — klantenzone met afspraken (fase 3)

Beslist op 25 november 2026: voorstel A (klantenzone in het thema + Cal.com voor afspraken).
**Gebouwd op 25 november 2026 (thema v2.4)** en getest op de WordPress.com-site met testklant "Jan Peeters".
Nog open: het Cal.com-account van de klant (zie onderaan).

![Stroomschema Mijn Elektro](mijn-elektro/schema.png)

## Wat de klant ziet (fictieve demo-inhoud)

Knop **Mijn Elektro** in het menu, naast "Gratis offerte".

- **Registreren**: naam, e-mail, telefoon, adres van de woning, wachtwoord → bevestigingsmail.
- **Inloggen** → eigen pagina. Alleen eigen gegevens, nooit die van anderen.
- **Mijn pagina**, van boven naar onder:
  1. Welkom + adres, knop "Gegevens wijzigen"
  2. Volgende afspraak (bv. "di 2 dec, 9:00–10:00: keuring zekeringkast", verzetten/annuleren) of de knop
     **Afspraak maken**
  3. Mijn installatie: wat we van de woning weten (zekeringkast 2024, laadpaal 11 kW 2025, keuringsattest
     geldig tot 2049)
  4. Documenten: offertes, facturen, keuringsverslagen als PDF
  5. Berichten: korte historiek ("Offerte verstuurd", "Afspraak bevestigd")
- **Afspraak maken**: soort (offertebezoek 1 u / herstelling 1 u / keuring 2 u) → vrije momenten (ma–vr 8–18;
  spoed via telefoon) → bevestigen → mail naar klant en elektricien; afspraak in zijn Google Agenda. Naam,
  e-mail en adres worden meegegeven, de klant typt niets opnieuw.

## Hoe het gebouwd wordt

| Onderdeel | Waar | Kost |
|---|---|---|
| Registratie, login, rol "Klant-portaal", pagina-sjabloon "Mijn pagina", profielvelden (adres, installatie, documenten, berichten), menupunt "Klanten" voor de beheerder | eigen code in het thema (`functions.php` + sjabloon) | €0 |
| Afspraken: afspraaktypes, beschikbaarheid, Google Agenda-koppeling, mails/sms, boekingspagina | Cal.com, gratis plan "Individuals": 1 gebruiker, onbeperkt afspraaktypes en agenda's, e-mail- en sms-meldingen, 100+ koppelingen; Cal.com-logo op de boekingspagina (cal.com/pricing, 25 nov 2026). Account op het e-mailadres van de klant. | €0 |
| Optioneel: afspraak terugschrijven op Mijn pagina | n8n: webhook van Cal.com → profielveld "volgende afspraak" + logboek | €0 (eigen n8n) |

Ingebed op "Mijn pagina" of als aparte boekingspagina (zoals motioncenter.be doet met Crossuite): nog te kiezen.

Alternatief B (niet gekozen): boekingsplugin in WordPress (Amelia/Bookly). Prijzen in bronnen tegenstrijdig
(Amelia $49/jaar Starter vs $79 eenmalig Basic; Bookly Pro $39–129); officiële Amelia-prijspagina onduidelijk.
Gratis versies beperkt tot 1 medewerker. Alleen zinvol bij betalingen of meerdere medewerkers in de boeking.

## Voorbeeld uit de praktijk

motioncenter.be (Tienen, gemaakt door Webhero): geen login of klantportaal; knop "Maak een afspraak" linkt
naar een externe boekingspagina van Crossuite (praktijksoftware); psychologen via intern aanmeldformulier.
Zelfde principe als voorstel A (site + aparte boekingstool), zonder de klantpagina.

## Gebouwd (thema v2.4) — hoe het werkt

![Inloggen / registreren](mijn-elektro/01_inloggen_registreren.jpg)
![Mijn pagina, ingelogd als Jan Peeters](mijn-elektro/02_mijn_pagina.jpg)
![Klanten beheren in het dashboard](mijn-elektro/03_klanten_beheer.png)

- **Pagina's**: `/mijn-elektro/` met shortcode `[es_mijn_pagina]`, `/afspraak/` met `[es_afspraak]`. Beide staan in het
  menu (kop en voet) via het thema.
- **Rol `es_portaal` (Klant-portaal)**: wordt automatisch toegekend bij registratie. Geen dashboard: elke poging naar
  `/wp-admin/` stuurt door naar Mijn Elektro; geen admin-balk; na inloggen altijd naar Mijn Elektro.
- **Registreren**: eigen formulier op de pagina (naam, e-mail, telefoon, adres, wachtwoord ≥ 8 tekens), verborgen
  honingpotveld tegen bots, gebruikersnaam = deel vóór de @ van het e-mailadres. Welkomstmail naar de klant, melding
  naar het e-mailadres uit Bedrijfsgegevens. De klant is meteen ingelogd. (Geen activatielink; wie een fout adres
  opgeeft, krijgt gewoon geen mail.)
- **Inloggen**: standaard WordPress-formulier op de pagina, met "Wachtwoord vergeten?".
- **Mijn pagina**: welkom + adres/telefoon, Volgende afspraak (+ knop Afspraak maken), Mijn installatie, Documenten
  (PDF's), Berichten, Mijn gegevens wijzigen (telefoon en adres; naam/e-mail via de elektricien).
- **Beheer**: dashboard → **Klanten** (zichtbaar voor beheerders én de rol Klant/Bea): lijst van portaalklanten; per
  klant telefoon, adres, installatie (één punt per regel), volgende afspraak, berichten (één per regel), documenten
  (meerkeuzelijst van PDF's uit de mediabibliotheek — eerst uploaden via Media). Dezelfde velden staan ook op het
  gebruikersprofiel (Gebruikers) voor beheerders.
- **Afspraak maken**: pagina `/afspraak/` toont Cal.com in een kader zodra in **Bedrijfsgegevens** het nieuwe veld
  "Cal.com-link voor afspraken" ingevuld is (bv. `https://cal.com/<naam>/afspraak`). Naam, e-mail en adres/telefoon van
  de ingelogde klant worden meegegeven (`?name=…&email=…&notes=…`). Zonder link: tekst "Bel … of mail …".
- Gegevens zitten als gebruikersmeta (`es_tel`, `es_adres`, `es_installatie`, `es_afspraak`, `es_berichten`, `es_docs`).

## Nog te doen

1. **Cal.com-account aanmaken** op het e-mailadres van de klant (cal.com → Sign up, gratis plan "Individuals"):
   afspraaktypes "Offertebezoek" (60 min), "Herstelling" (60 min), "Keuring" (120 min); beschikbaarheid ma–vr 8–18;
   Google Agenda koppelen (Settings → Calendars). Daarna de link van één afspraaktype (of de profielpagina
   `https://cal.com/<naam>`) in Bedrijfsgegevens plakken. Dit doet de klant zelf of David met de login van de klant.
2. Optioneel: n8n-webhook vanuit Cal.com om "Volgende afspraak" automatisch in te vullen (nu vult de elektricien dat
   in via Klanten).
3. Testklant "Jan Peeters" (jan.peeters@example.com) en de demo-gegevens verwijderen vóór oplevering aan een echte klant.
