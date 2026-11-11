# Dossier CyFun Small — Elektro Selders

| | |
|---|---|
| Klant | Elektro Selders, elektricien, Achel (testklant, fictief bedrijf) |
| Dienstverlener | Weblotus, David Genyn |
| Kader | CyFun Small, Centrum voor Cybersecurity België, versie 2023-03-01 |
| Datum opmaak | 10 november 2026 |
| Laatste bijwerking | 11 november 2026 |
| Status | Technisch afgerond; drie afspraken met de klant nog vast te leggen (zie 5) |

## 1. Scope

- Eén router: ASUS RT-AX55 (speelt de rol van de providerrouter van de klant).
- Eén kantoor-pc: Windows 11 Enterprise (in het lab: virtuele machine Win11-Lab in VirtualBox, evaluatieversie 26H2).
- Eén externe USB-schijf voor back-up (WD Elements, 1 TB, NTFS).
- Eén zakelijke mailbox (Gmail, lotusflow.contact@gmail.com).
- Kantoorwifi en gastwifi.
- Geen server.
- Microsoft 365: nog niet in scope.

Schema van de opstelling: `schema-lab.html`.

## 2. Nulmeting

| Punt | Vaststelling vóór | Bewijs |
|---|---|---|
| 1 MFA | Mailbox beveiligd met alleen een wachtwoord. | — |
| 2 Updates | Kantoor-pc vers geïnstalleerd, beveiligingsupdates sinds de installatiemedia ontbreken. | — |
| 3 Antivirus | Microsoft Defender standaard aan; nog nooit gescand, geen uitsluitingen. | `bewijs/2026-11-11_p3_defender-status.png` |
| 4 Netwerk | Router in fabrieksstand. Standaardnaam ASUS_C0, standaardbeheerder admin, WPS aan, geen gastnetwerk, firmware verouderd. | Foto label router; schermafbeelding wizard-welkom; schermafbeelding firmware-melding |
| 5 Back-up | Geen back-up. | — |
| 6 Beheerdersrechten | Eén account, met beheerdersrechten, voor alles. | — |
| 7 Slotaanbevelingen | Geen incidentcontactblad. | — |

## 3. Uitgevoerde maatregelen

| Punt | Maatregel | Datum | Bewijs |
|---|---|---|---|
| 4 | Fabrieksreset, beheerdersnaam en -wachtwoord gewijzigd (niet "admin") | 10-11-2026 | Schermafbeelding aanmeldpagina wizard (wachtwoord afgedekt) |
| 4 en 2 | Firmware bijgewerkt naar 3.0.0.4.386_53370 | 10-11-2026 | Schermafbeelding Netwerkkaart met firmwareversie |
| 4 | Kantoorwifi ElektroSelders, WPA2/WPA3-Personal, AES | 10-11-2026 | Schermafbeelding Draadloos > Algemeen (sleutel afgedekt) |
| 4 | Gastnetwerk ElektroSelders-Gast, toegang tot intranet uit, 2,4 en 5 GHz | 10-11-2026 | Schermafbeelding Gastnetwerk (sleutel afgedekt) |
| 4 | WPS uitgeschakeld | 10-11-2026 | Schermafbeelding Draadloos > WPS |
| 4 | Gasttest: routeradres onbereikbaar vanaf gastnetwerk, internet werkt | 10-11-2026 | Schermafbeelding mislukte verbinding |
| 2 | Windows Update uitgevoerd tot "You're up to date"; automatische updates aan (standaard) | 11-11-2026 | `bewijs/2026-11-11_p2_windows-update-up-to-date.png` |
| 3 | Defender nagekeken: realtime, cloudbescherming, sample submission en Tamper Protection aan; geen uitsluitingen; Quick scan uitgevoerd | 11-11-2026 | `bewijs/2026-11-11_p3_defender-instellingen-1.png`, `…-2-tamper.png` |
| 6 | Beheerdersaccount `labadmin` enkel voor beheer; dagelijks account `David` als Standard user; account aangemaakt lokaal, zonder Microsoft-account | 11-11-2026 | `bewijs/2026-11-11_p6_david-standard-user.png`, `…-geen-accountbeheer.png` |
| 5 | Bestandsgeschiedenis (File History) aan naar externe schijf Elements; eerste kopie 20:13; omvat Documenten, Bureaublad, Afbeeldingen, Muziek, Video's | 11-11-2026 | `bewijs/2026-11-11_p5_file-history-aan.png` |
| 5 | Restore getest: bestand verwijderd (inclusief prullenbak) en teruggezet uit File History | 11-11-2026 | Schermafbeelding nog toe te voegen |
| 5 | Schijf veilig verwijderd en losgekoppeld (offline kopie) | 11-11-2026 | — |
| 1 | Tweestapsverificatie op de mailbox, methode authenticator-app (Microsoft Authenticator); back-upcodes offline bewaard door de klant | 11-11-2026 | Schermafbeelding "2-Step Verification: On" nog toe te voegen |
| 7 | Incidentcontactblad opgesteld (sjabloon), af te drukken en in te vullen door de klant | 11-11-2026 | `incidentcontactblad-sjabloon.md` |

## 4. Zelfevaluatie CyFun Small

| Punt | Omschrijving | Status | Opmerking |
|---|---|---|---|
| 1 | Multifactorauthenticatie | Conform | Op de mailbox. De lokale Windows-accounts en de router bieden geen MFA; compenserend: punt 6, sterk routerwachtwoord, routerbeheer enkel vanuit het eigen netwerk. |
| 2 | Beveiligingsupdates | Conform | Router en kantoor-pc. |
| 3 | Antivirus | Conform | Microsoft Defender, Tamper Protection aan. |
| 4 | Netwerk | Conform | |
| 5 | Back-up | Conform, mits afspraak 5a | Techniek en restore getest; de offline-routine is een afspraak met de klant (zie 5). |
| 6 | Beheerdersrechten | Conform | |
| 7 | Slotaanbevelingen (fysiek, incidentcontact) | Conform, mits afspraak 5b en 5c | Sjabloon geleverd; invullen en fysieke maatregelen zijn aan de klant. |

## 5. Afspraken en open punten

- Beheerdersgegevens van de router en van `labadmin`: offline bewaard door de klant. Niet in dit dossier.
- **5a. Back-uproutine (punt 5):** wie steekt de schijf wanneer in (voorstel: wekelijks, vast moment), en een tweede schijf die afwisselend gebruikt wordt en buiten het gebouw ligt. Vast te leggen met de klant: datum, naam, ja/nee tweede schijf.
- **5b. Incidentcontactblad (punt 7):** klant vult het sjabloon in, drukt het af en legt het bij de back-upschijf en de MFA-back-upcodes. Herziening elke zes maanden.
- **5c. Fysieke beveiliging (punt 7):** advies aan de klant: laptop niet in het voertuig laten, back-upschijf in een afgesloten kast, sleutels en alarmcodes op naam. Geen technische maatregel; wordt genoteerd als gegeven advies.
- Verschil lab/klant: in het lab hangt de kantoor-pc via NAT van VirtualBox aan internet, niet achter de ASUS. Voor de Small-maatregelen maakt dat geen verschil; bij een klant wordt de pc aan het kantoornetwerk van de router gehangen.
- CyFun Small is een eerste beoordeling, geen formeel NIS2-niveau. Dat wordt zo aan de klant gezegd.
- Volgende stap: CyFun Basic.

## 6. Bijlagen

- `schema-lab.html`: schema van de opstelling.
- `incidentcontactblad-sjabloon.md`: sjabloon voor punt 7.
- `bewijs/`: schermafbeeldingen van 11-11-2026 (bestandsnaam = datum, punt, onderwerp). Nog toe te voegen: restore-test, 2-Step Verification On, en de routerschermen van 10-11-2026.
