# Dossier CyFun Small — Elektro Selders

| | |
|---|---|
| Klant | Elektro Selders, elektricien, Achel (testklant, fictief bedrijf) |
| Dienstverlener | Weblotus, David Genyn |
| Kader | CyFun Small, Centrum voor Cybersecurity België, versie 2023-03-01 |
| Datum opmaak | 10 november 2026 |
| Laatste bijwerking | 11 november 2026 |
| Status | Afgerond voor de 7 punten; twee open handelingen bij de klant: AutoPlay uit (5e) en incidentcontactblad invullen (5b) |

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
| 4 en 2 | Firmware bijgewerkt naar 3.0.0.4.386_53370 | 10-11-2026 | `bewijs/2026-11-10_p4_netwerkkaart-firmware-wpa.png` |
| 4 | Kantoorwifi ElektroSelders, WPA2/WPA3-Personal, AES | 10-11-2026 | `bewijs/2026-11-10_p4_draadloos-algemeen.png` (sleutel afgedekt) |
| 4 | Gastnetwerk ElektroSelders-Gast, toegang tot intranet uit, 2,4 en 5 GHz | 10-11-2026 | `bewijs/2026-11-10_p4_gastnetwerk.png` (sleutels afgedekt) |
| 4 | WPS uitgeschakeld | 10-11-2026 | Schermafbeelding Draadloos > WPS |
| 4 | Gasttest: routeradres onbereikbaar vanaf gastnetwerk, internet werkt | 10-11-2026 | Schermafbeelding mislukte verbinding |
| 2 | Windows Update uitgevoerd tot "You're up to date"; automatische updates aan (standaard) | 11-11-2026 | `bewijs/2026-11-11_p2_windows-update-up-to-date.png` |
| 3 | Defender nagekeken: realtime, cloudbescherming, sample submission en Tamper Protection aan; geen uitsluitingen; Quick scan uitgevoerd | 11-11-2026 | `bewijs/2026-11-11_p3_defender-instellingen-1.png`, `…-2-tamper.png` |
| 6 | Beheerdersaccount `labadmin` enkel voor beheer; dagelijks account `David` als Standard user; account aangemaakt lokaal, zonder Microsoft-account | 11-11-2026 | `bewijs/2026-11-11_p6_david-standard-user.png`, `…-geen-accountbeheer.png` |
| 5 | Bestandsgeschiedenis (File History) aan naar externe schijf Elements; eerste kopie 20:13; omvat Documenten, Bureaublad, Afbeeldingen, Muziek, Video's | 11-11-2026 | `bewijs/2026-11-11_p5_file-history-aan.png` |
| 5 | Restore getest: bestand verwijderd (inclusief prullenbak) en teruggezet uit File History | 11-11-2026 | Geen schermafbeelding; restore uitgevoerd en vastgesteld door de dienstverlener op 11-11-2026. Volgende keer vastleggen met het venster "Restore personal files" open. |
| 5 | Schijf veilig verwijderd en losgekoppeld (offline kopie) | 11-11-2026 | — |
| 1 | Tweestapsverificatie op de mailbox, methode authenticator-app (Microsoft Authenticator); back-upcodes offline bewaard door de klant | 11-11-2026 | `bewijs/2026-11-11_p1_gmail-2-step-verification-on.png` |
| 7 | Incidentcontactblad opgesteld (sjabloon), af te drukken en in te vullen door de klant | 11-11-2026 | `incidentcontactblad-sjabloon.md` |

## 4. Toets aan het Small-document (CCB, versie 2023-03-01)

Elke eis uit het Small-document, met wat er in dit dossier tegenover staat. Bron: `CYFUN_SMALL_NL_20230301.pdf` (CCB).

| Punt | Eis uit het Small-document | Stand | Waar |
|---|---|---|---|
| 1 | MFA waar mogelijk, altijd bij toegang op afstand | Conform | Mailbox: 2-Step Verification, authenticator-app. Geen toegang op afstand (geen VPN/RDP) in scope. |
| 1 | Sterke wachtwoorden (wachtzin van 3 woorden of lang gemengd), niet hergebruikt, wijzigen bij vermoeden van lek | Conform | Router, `labadmin`, `David`, mailbox: wachtzinnen, elk verschillend. Niet in dossier. |
| 1 | MFA met een tool met meerdere opties | Conform | Authenticator-app plus back-upcodes offline. |
| 2 | Updates meteen installeren, automatisch waar mogelijk | Conform | Windows Update automatisch (standaard); router-firmware handmatig bijgewerkt. |
| 2 | Alleen nodige software, alleen ondersteunde versies | Conform | Kantoor-pc: Windows 11 (ondersteund) en Edge; geen andere software. Softwarelijst in 5d. |
| 2 | Maandelijkse controledag als er geen updateprogramma is | Afspraak 5d | Router heeft geen automatische firmware-update: maandelijks nakijken. |
| 3 | Antivirus op alle toestellen, dagelijkse updates, volledige scan na update | Conform | Defender, handtekeningen automatisch; Quick scan gedaan, volledige scan toe te voegen (5e). |
| 3 | Geen USB-media delen tussen privé en werk; geen onbekende USB-sticks | Afspraak 5e | Regel voor de klant; back-upschijf uitsluitend voor de back-up. |
| 3 | AutoRun/AutoPlay voor verwisselbare media uit | **Open: 5e** | Nog niet ingesteld op de kantoor-pc. |
| 3 | Geen illegale software | Conform | Evaluatieversie van Microsoft; geen andere software. |
| 4 | Firewall tussen intern netwerk en internet, actief en bijgewerkt | Conform | Router (firmware 10-11-2026) en Windows Defender Firewall op de pc (standaard aan). |
| 4 | Beheerderswachtwoord firewall gewijzigd bij installatie en regelmatig nadien | Conform, deels afspraak | Gewijzigd 10-11-2026; jaarlijkse wissel in 5d. |
| 4 | Minstens WPA2, liefst WPA3, met AES | Conform | WPA2/WPA3-Personal, AES. |
| 4 | Wifi-wachtwoord met niemand delen; apart gastnetwerk | Conform | Gastnetwerk zonder toegang tot intranet. |
| 4 | Toegang op afstand beveiligen | Niet van toepassing | Geen toegang op afstand; routerbeheer vanaf internet uit. |
| 5 | Automatische, regelmatige back-up van de essentiële gegevens | Conform | File History, elk uur bij aangesloten schijf; essentiële gegevens = Documenten (boekhouding, facturen, klanten). |
| 5 | Offline kopie, wekelijks of om de paar weken, media apart bewaard | Afspraak 5a | Techniek klaar; routine vastgelegd in 5a. |
| 5 | Back-up na grote wijzigingen | Afspraak 5a | |
| 5 | Restore regelmatig testen | Conform | Getest 11-11-2026; halfjaarlijks herhalen (5a). |
| 6 | Niemand werkt dagelijks met beheerdersrechten; accounts gescheiden | Conform | `labadmin` / `David`. |
| 6 | MFA op beheerdersaccounts | Beperking | Lokaal Windows-account en router hebben geen MFA. Compenserend: beheerder enkel fysiek aan het toestel, sterk wachtwoord, routerbeheer enkel vanuit het eigen netwerk. |
| 7 | Toestellen fysiek beschermen; toegang tot gebouw, back-ups, netwerk beperken; sleutels en alarmcodes strikt beheren | Advies 5c | |
| 7 | Mobiele toestellen: "Find my phone", eventueel MDM | Advies 5c | |
| 7 | Offline document: wie bel je, wat heb je nodig, wat zal men vragen | Conform, mits 5b | Sjabloon geleverd; invullen door de klant. |
| 7 | CCB-gids incidentbeheer | Verwezen | Link in de procedure. |

## 5. Afspraken en open punten

- Beheerdersgegevens van de router en van `labadmin`: offline bewaard door de klant. Niet in dit dossier.
- **5a. Back-uproutine (punt 5):** elke vrijdag om 16u steekt de zaakvoerder de schijf in, klikt "Nu uitvoeren", wacht tot de kopie klaar is, verwijdert de schijf veilig en legt ze in de afgesloten kast. Ook na een grote wijziging (nieuw boekhoudjaar, nieuwe pc). Tweede schijf voor afwisseling en bewaring buiten het gebouw: aangeraden, aankoop gepland, nog niet in gebruik. Restore-test elke zes maanden, samen met de herziening van het incidentcontactblad.
- **5b. Incidentcontactblad (punt 7):** klant vult het sjabloon in, drukt het af en legt het bij de back-upschijf en de MFA-back-upcodes. Herziening elke zes maanden. Stand: nog niet ingevuld.
- **5c. Fysieke beveiliging (punt 7), advies gegeven:** laptop en telefoon niet in het voertuig laten; back-upschijf in een afgesloten kast, niet naast de pc; sleutels en alarmcodes op naam en innemen bij vertrek; op telefoons "Zoek mijn telefoon" aanzetten. Geen technische maatregel in scope.
- **5d. Software en updates (punt 2):** softwarelijst kantoor-pc: Windows 11, Microsoft Edge, Microsoft Defender. Elke maand (eerste werkdag) nakijken: router-firmware (ASUS, Beheer > Firmware-upgrade) en Windows Update. Routerwachtwoord jaarlijks wijzigen.
- **5e. USB en AutoPlay (punt 3), open:** AutoPlay uitzetten op de kantoor-pc (Instellingen > Bluetooth en apparaten > Automatisch afspelen > uit). Regel: back-upschijf enkel voor back-up, geen privé-USB op de werk-pc, onbekende USB-sticks niet insteken. Eén volledige Defender-scan uitvoeren na de eerste handtekeningupdate.
- Verschil lab/klant: in het lab hangt de kantoor-pc via NAT van VirtualBox aan internet, niet achter de ASUS. Voor de Small-maatregelen maakt dat geen verschil; bij een klant wordt de pc aan het kantoornetwerk van de router gehangen.
- CyFun Small is een eerste beoordeling, geen formeel NIS2-niveau. Dat wordt zo aan de klant gezegd.
- Volgende stap: CyFun Basic (eigen dossier).

## 6. Bijlagen

- `schema-lab.html`: schema van de opstelling.
- `incidentcontactblad-sjabloon.md`: sjabloon voor punt 7.
- `bewijs/`: schermafbeeldingen van 11-11-2026 (bestandsnaam = datum, punt, onderwerp). Van 10-11-2026 zijn de drie kernschermen van de router opgenomen (firmware en WPA, Draadloos > Algemeen, Gastnetwerk). De overige routerschermen (label, wizard, WPS, gasttest) en de nulmeting zijn bij de dienstverlener en niet in dit dossier.
