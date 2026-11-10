# Dossier CyFun Small — Elektro Selders

| | |
|---|---|
| Klant | Elektro Selders, elektricien, Achel (testklant, fictief bedrijf) |
| Dienstverlener | Weblotus, David Genyn |
| Kader | CyFun Small, Centrum voor Cybersecurity België, versie 2023-03-01 |
| Datum opmaak | 10 november 2026 |
| Status | In uitvoering |

## 1. Scope

- Eén router: ASUS RT-AX55 (speelt de rol van de providerrouter van de klant).
- Eén kantoor-pc (Windows 11, virtuele machine in het lab).
- Kantoorwifi en gastwifi.
- Geen server.
- Microsoft 365: nog niet in scope.

Schema van de opstelling: `schema-lab.html`.

## 2. Nulmeting

| Punt | Vaststelling vóór | Bewijs |
|---|---|---|
| 4 Netwerk | Router in fabrieksstand. Standaardnaam ASUS_C0, standaardbeheerder admin, WPS aan, geen gastnetwerk, firmware verouderd. | Foto label router; schermafbeelding wizard-welkom; schermafbeelding firmware-melding |

## 3. Uitgevoerde maatregelen

| Punt | Maatregel | Datum | Bewijs |
|---|---|---|---|
| 4 | Fabrieksreset, beheerdersnaam en -wachtwoord gewijzigd (niet "admin") | 10-11-2026 | Schermafbeelding aanmeldpagina wizard (wachtwoord afgedekt) |
| 4 en 2 | Firmware bijgewerkt naar 3.0.0.4.386_53370 | 10-11-2026 | Schermafbeelding Netwerkkaart met firmwareversie |
| 4 | Kantoorwifi ElektroSelders, WPA2/WPA3-Personal, AES | 10-11-2026 | Schermafbeelding Draadloos > Algemeen (sleutel afgedekt) |
| 4 | Gastnetwerk ElektroSelders-Gast, toegang tot intranet uit, 2,4 en 5 GHz | 10-11-2026 | Schermafbeelding Gastnetwerk (sleutel afgedekt) |
| 4 | WPS uitgeschakeld | 10-11-2026 | Schermafbeelding Draadloos > WPS |
| 4 | Gasttest: routeradres onbereikbaar vanaf gastnetwerk, internet werkt | 10-11-2026 | Schermafbeelding mislukte verbinding |

## 4. Zelfevaluatie CyFun Small

| Punt | Omschrijving | Status |
|---|---|---|
| 1 | Multifactorauthenticatie | Nog niet behandeld |
| 2 | Beveiligingsupdates | Gedeeltelijk: router ja, kantoor-pc nog niet |
| 3 | Antivirus | Nog niet behandeld |
| 4 | Netwerk | Conform |
| 5 | Back-up | Nog niet behandeld |
| 6 | Beheerdersrechten | Nog niet behandeld |
| 7 | Slotaanbevelingen (fysiek, incidentcontact) | Nog niet behandeld |

## 5. Afspraken en open punten

- Beheerdersgegevens van de router: offline bewaard door de klant. Niet in dit dossier.
- Volgende sessie: kantoor-pc (punten 2, 3, 6), back-up (5), incidentcontactblad (7), MFA (1).

## 6. Bijlagen

- `schema-lab.html`: schema van de opstelling.
- Schermafbeeldingen: bewaard door de dienstverlener, nog niet toegevoegd aan dit dossier.
