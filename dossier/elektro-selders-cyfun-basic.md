# Dossier CyFun Basic — Elektro Selders

| | |
|---|---|
| Klant | Elektro Selders, elektricien, Achel (testklant, fictief bedrijf) |
| Dienstverlener | Weblotus, David Genyn |
| Kader | CyFun Basic, Centrum voor Cybersecurity België, CyFun 2025, versie 2025-10-01 |
| Vorig niveau | CyFun Small, afgerond 11 november 2026 (`elektro-selders-cyfun-small.md`) |
| Datum opmaak | 21 november 2026 |
| Laatste bijwerking | 22 november 2026 |
| Status | In uitvoering. Stap 1 firewall aangetoond; stap 2 logs technisch ingericht, controleroutine vastgelegd (4b), back-up van de logs open (4c). |

Bron: `CyFun2025_Booklet-BASIC.pdf` (CCB). Basic telt 34 eisen in 6 functies; 13 daarvan zijn key measures (Annex A). Het CCB schrijft dat de key measures op dit niveau verplicht aangepakt moeten worden.

## 1. Scope

Overgenomen uit het Small-dossier, ongewijzigd:

- Eén router: ASUS RT-AX55 (speelt de rol van de providerrouter van de klant).
- Eén kantoor-pc: Windows 11 Enterprise (in het lab: virtuele machine Win11-Lab in VirtualBox, evaluatieversie 26H2).
- Eén externe USB-schijf voor back-up (WD Elements, 1 TB, NTFS).
- Eén zakelijke mailbox (Gmail, lotusflow.contact@gmail.com).
- Kantoorwifi en gastwifi.
- Geen server. Geen toegang op afstand (geen VPN, geen extern bureaublad).
- Microsoft 365: niet in scope.

Nog toe te voegen aan de scope voor Basic: de smartphone met de authenticator-app (DE.CM-01.2 vraagt antimalware op alle toestellen; ID.AM-01.1 vraagt een inventaris van alle hardware).

Schema van de opstelling: `schema-lab.html`.

## 2. Uitgevoerde maatregelen

| Eis | Maatregel | Datum | Bewijs |
|---|---|---|---|
| PR.IR-01.1 | Nulmeting routerfirewall: firewall aan (standaard), DoS-beveiliging uit, pakketlogging "Geen", ping vanaf WAN uit, IPv6-firewall aan | 21-11-2026 | `bewijs/2026-11-21_fw_asus-firewall-voor.png` |
| PR.IR-01.1, DE.AE-03.1 | Routerfirewall geconfigureerd: DoS-beveiliging aan, pakketlogging "Beide" (toegelaten en geweigerde pakketten naar het systeemlogboek), ping vanaf WAN uit | 21-11-2026 | `bewijs/2026-11-21_fw_asus-firewall-na.png` |
| DE.CM-01.1 | Windows Defender Firewall op de kantoor-pc: aan voor de profielen Domein, Privé en Openbaar | 21-11-2026 | `bewijs/2026-11-21_fw_windows-firewall-3-profielen.png` |
| PR.IR-01.1 | Kantoor-pc achter de router gehangen (lab: VirtualBox bridged op de wifi-kaart, voorheen NAT). Adres 192.168.50.245, gateway 192.168.50.1 (ASUS). Internet getest. | 21-11-2026 | `bewijs/2026-11-21_fw_vm-ipconfig-achter-asus.png` |
| DE.CM-01.1 | Netwerkprofiel kantoor-pc op Privé gezet (kantoornetwerk); firewallprofiel Privé actief | 21-11-2026 | `bewijs/2026-11-21_fw_windows-netwerkprofiel-prive.png` |
| PR.PS-04.1 | Nulmeting Windows-logs als Standard user `David`: logs aanwezig, "Overwrite events as needed"; Security-log en een deel van de Administrative Events niet leesbaar ("Access is denied") | 21-11-2026 | `bewijs/2026-11-21_log_eventviewer-overzicht-david.png`, `…_log_eventviewer-access-denied-david.png` |
| PR.PS-04.1 | Logcontrole als beheerder `labadmin`: Administrative Events nagekeken en geduid (zie 4a) | 21-11-2026 | `bewijs/2026-11-21_log_admin-events-labadmin.png`, `…_log_event-2042.png` |
| DE.AE-03.1 | Security-log nulmeting: 20 MB, oudste events overschreven, geen bewaartermijn | 22-11-2026 | `bewijs/2026-11-22_log_security-properties-voor.png` |
| DE.AE-03.1 | Security-log ingesteld: 100 MB, "Archive the log when full, do not overwrite" (archieven in `C:\Windows\System32\winevt\Logs`); niets gaat verloren | 22-11-2026 | `bewijs/2026-11-22_log_security-properties-na.png`, `…_log_winevt-logs-map.png` |
| DE.AE-03.1 | Routerlog nagekeken (Systeemlogboek): firewall logt sinds 21-11-2026 (DROP van broadcasts op WAN; aanmeldingen op de beheerpagina). Geen externe logserver; log staat in het geheugen van de router en verdwijnt bij herstart. Log opgeslagen als bestand op de kantoor-pc | 22-11-2026 | `bewijs/2026-11-22_log_asus-syslog.png` (logregels afgesneden: bevatten MAC- en IP-adressen) |

## 3. Toets aan het Basic-document (CCB, CyFun 2025, versie 2025-10-01)

Elke eis, met de stand op 21 november 2026. "Aangetoond" = maatregel met datum en bewijs in dit dossier of in het Small-dossier. "Gedeeltelijk" = een deel is aangetoond, een deel van wat Basic vraagt niet. "Afwezig" = niets in de dossiers. Of een eis conform is, beslist de verificateur.

### Key measures (13)

| Eis | Omschrijving | Stand | Waar / wat ontbreekt |
|---|---|---|---|
| ID.AM-08.2 | Patches en beveiligingsupdates geïnstalleerd | Aangetoond | Small: Windows Update, routerfirmware; maandelijkse controle (Small 5d) |
| PR.AA-01.1 | Identiteiten en wachtwoorden beheerd | Gedeeltelijk | Aparte accounts, routerbeheerder hernoemd (Small). Geen procedure voor aanmaken en intrekken van accounts |
| PR.AA-03.2 | MFA bij toegang op afstand | Aangetoond | Geen toegang op afstand in scope; mailbox met MFA (Small punt 1) |
| PR.AA-05.1 | Toegangsrechten bepaald, beheerd, afgedwongen, herzien | Afwezig | |
| PR.AA-05.2 | Wie heeft toegang tot bedrijfskritieke informatie, en hoe | Gedeeltelijk | Tabel "Waar ligt wat" in het incidentcontactblad, nog niet ingevuld |
| PR.AA-05.3 | Least privilege | Afwezig | |
| PR.AA-05.4 | Niemand admin voor dagelijks werk | Aangetoond | Small punt 6: `labadmin` / `David` |
| PR.DS-11.1 | Back-up op een ander systeem | Aangetoond | Small punt 5: File History naar externe schijf, restore getest |
| PR.PS-04.1 | Logs bijgehouden, gedocumenteerd, gemonitord | Gedeeltelijk | Logs aanwezig en nagekeken (dit dossier); maandelijkse controle vastgelegd (4b). Nog geen eerste uitvoering van die routine |
| PR.IR-01.1 | Firewall op alle netwerken, geconfigureerd en onderhouden | Aangetoond | Dit dossier, 21-11-2026 |
| PR.IR-01.2 | Segmentatie | Gedeeltelijk | Gastnetwerk gescheiden en getest (Small punt 4). Verder niets |
| DE.CM-01.2 | Antimalware geïnstalleerd en bijgewerkt | Gedeeltelijk | Defender op de pc (Small punt 3). Smartphone niet in scope |
| DE.AE-03.1 | Logging van beveiligingstools aan, geback-upt, bewaard, nagekeken | Gedeeltelijk | Logging aan (router, Windows); bewaartermijn Security-log vastgelegd (archiveren, 100 MB); controleroutine 4b. Back-up van de Windows-logs nog open (4c) |

### Overige eisen (21)

| Eis | Omschrijving | Stand | Waar / wat ontbreekt |
|---|---|---|---|
| GV.OC-03.1 | Wettelijke en reglementaire eisen geïdentificeerd | Afwezig | |
| GV.RM-03.1 | Strategie voor cyberrisico's | Afwezig | |
| GV.RR-04.1 | Personeel met toegang tot kritieke info geauthenticeerd | Gedeeltelijk | Persoonlijke accounts; MFA alleen op de mailbox |
| GV.PO-01.1 | Beleid en procedures vastgelegd, goedgekeurd, gecommuniceerd | Afwezig | Small-afspraken 5a–5e zijn afspraken, geen beleid |
| ID.AM-01.1 | Inventaris infrastructuur | Gedeeltelijk | Scope-lijst; smartphone ontbreekt; geen herziening |
| ID.AM-02.1 | Inventaris software en diensten | Gedeeltelijk | Softwarelijst pc (Small 5d) en Gmail |
| ID.AM-05.1 | Prioritering van middelen | Afwezig | |
| ID.AM-07.1 | Gegevens geïdentificeerd | Gedeeltelijk | "Essentiële gegevens = Documenten" (Small, toets punt 5) |
| ID.RA-01.1 | Dreigingen en kwetsbaarheden geïdentificeerd | Gedeeltelijk | Nulmeting Small: zwaktes, geen dreigingen |
| ID.RA-05.1 | Risicoanalyse | Afwezig | |
| ID.IM-03.1 | Evaluatie na incident | Afwezig | |
| PR.AA-03.1 | Wifi veilig ingesteld, beheerd en gemonitord | Gedeeltelijk | Instellingen aangetoond (Small punt 4); monitoring niet |
| PR.AA-06.1 | Fysieke toegang ("should") | Gedeeltelijk | Advies gegeven (Small 5c) |
| PR.AT-01.1 | Opleidingsprogramma | Afwezig | |
| PR.DS-01.9 | Veilige afvoer van toestellen | Afwezig | |
| PR.PS-05.1 | Web- en e-mailfilters | Afwezig | |
| DE.CM-01.1 | Firewall aan de netwerkgrens en op de endpoints | Aangetoond | Dit dossier, 21-11-2026 |
| DE.CM-03.1 | Gebruikersgedrag gemonitord | Afwezig | |
| RS.MA-01.1 | Incidentresponsplan met rollen en bevoegdheden | Gedeeltelijk | Incidentcontactblad met eerste handelingen |
| RS.CO-02.1 | Incidentinformatie naar personeel | Gedeeltelijk | Eén regel in het incidentcontactblad |
| RC.RP-01.1 | Herstelproces voor rampen en incidenten | Gedeeltelijk | Alleen cyberincidenten; brand, inbraak, natuurramp ontbreken |

### Telling

| | Alle 34 | Key measures (13) |
|---|---|---|
| Aangetoond | 6 | 5 |
| Gedeeltelijk | 15 | 6 |
| Afwezig | 13 | 2 |

## 4. Afspraken en open punten

- Verschil lab/klant: de ASUS hangt met zijn WAN-poort achter de thuisrouter (WAN IP 192.168.1.5), niet rechtstreeks aan internet. Bewijs: `bewijs/2026-11-21_asus-netwerkkaart-wan.png`. Bij een klant is de router de grens met internet.
- Het lab-verschil uit het Small-dossier (kantoor-pc via NAT van VirtualBox, niet achter de ASUS) is op 21-11-2026 weggewerkt: de pc hangt nu achter de ASUS, zoals bij een klant.
- **4a. Logcontrole 21-11-2026, bevindingen:** event 2042 "Windows Firewall With Advanced Security, Config Read Failed, Config 18, Access is denied", tweemaal bij elke start. Bekend Microsoft-probleem in Windows 11 24H2 sinds de preview-update van juni 2025; de firewall werkt (drie profielen aan). Genegeerd. Bron: Microsoft Q&A, november 2026. Service Control Manager 7023 "Downloaded Maps Manager": kaartendienst, niet in gebruik, genegeerd. DistributedCOM 10016, DeviceSetupManager 137, TPM-WMI 1040, User Device Registration 360: standaardruis bij opstarten. Geen Critical bij de herstart van 21-11-2026.
- **4b. Logcontrole, routine:** op de maandelijkse controledag (Small 5d), als beheerder: Event Viewer > Custom Views > Administrative Events, Errors en Criticals sinds de vorige controle duiden; Windows Logs > Security, mislukte aanmeldingen (4625) nakijken. Router: Systeemlogboek nakijken op onbekende aanmeldingen (`HTTPD: [LOGIN]`) en met Opslaan als bestand bewaren in Documenten\Logs (bestandsnaam = datum). Jaarlijks: archieven van het Security-log ouder dan twee jaar verwijderen. Uitgevoerd op 21/22-11-2026 door de dienstverlener.
- **4c. Back-up van de logs, open:** File History neemt `C:\Windows\System32\winevt\Logs` niet mee. Het opgeslagen routerlog in Documenten wel. Oplossing voor de Windows-logs nog te bepalen.
- Verschil lab/klant: een echte ping of scan van buiten komt niet in het routerlog, want het publieke adres hoort bij de thuisrouter ervóór. Bij een klant is dat anders.
- Volgende stap: toegangsrechten (PR.AA-05.1, 05.2, 05.3).

## 5. Bijlagen

- `bewijs/2026-11-21_*.png`, `bewijs/2026-11-22_*.png`: schermafbeeldingen (bestandsnaam = datum, onderwerp).
- Small-dossier en bijlagen: `elektro-selders-cyfun-small.md`, `incidentcontactblad-sjabloon.md`, `schema-lab.html`.
