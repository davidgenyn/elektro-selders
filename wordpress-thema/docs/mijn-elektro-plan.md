# Plan "Mijn Elektro" — klantenzone met afspraken (fase 3)

Beslist op 25 november 2026: voorstel A (klantenzone in het thema + Cal.com voor afspraken). Nog niet gebouwd;
bouwen gebeurt na de domeinkoppeling en na een aparte wijzigingenlijst met akkoord.

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
