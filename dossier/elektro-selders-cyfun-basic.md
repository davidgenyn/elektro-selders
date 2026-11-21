# Dossier CyFun Basic — Elektro Selders

| | |
|---|---|
| Klant | Elektro Selders, elektricien, Achel (testklant, fictief bedrijf) |
| Dienstverlener | Weblotus, David Genyn |
| Kader | CyFun Basic, Centrum voor Cybersecurity België, CyFun 2025, versie 2025-10-01 |
| Vorig niveau | CyFun Small, afgerond 11 november 2026 (`elektro-selders-cyfun-small.md`) |
| Datum opmaak | 21 november 2026 |
| Laatste bijwerking | 21 november 2026 |
| Status | In uitvoering. Firewall (PR.IR-01.1, DE.CM-01.1) aangetoond. |

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
| DE.CM-01.1 | Windows Defender Firewall op de kantoor-pc: aan voor de profielen Domein, Privé en Openbaar; actief profiel Openbaar | 21-11-2026 | `bewijs/2026-11-21_fw_windows-firewall-3-profielen.png` |

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
| PR.PS-04.1 | Logs bijgehouden, gedocumenteerd, gemonitord | Afwezig | |
| PR.IR-01.1 | Firewall op alle netwerken, geconfigureerd en onderhouden | Aangetoond | Dit dossier, 21-11-2026 |
| PR.IR-01.2 | Segmentatie | Gedeeltelijk | Gastnetwerk gescheiden en getest (Small punt 4). Verder niets |
| DE.CM-01.2 | Antimalware geïnstalleerd en bijgewerkt | Gedeeltelijk | Defender op de pc (Small punt 3). Smartphone niet in scope |
| DE.AE-03.1 | Logging van beveiligingstools aan, geback-upt, bewaard, nagekeken | Gedeeltelijk | Routerlogging aan sinds 21-11-2026. Geen bewaartermijn, geen back-up van logs, geen controleroutine |

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
| Gedeeltelijk | 14 | 5 |
| Afwezig | 14 | 3 |

## 4. Afspraken en open punten

- Verschil lab/klant: de ASUS hangt met zijn WAN-poort achter de thuisrouter (WAN IP 192.168.1.5), niet rechtstreeks aan internet. Bewijs: `bewijs/2026-11-21_asus-netwerkkaart-wan.png`. Bij een klant is de router de grens met internet.
- Verschil lab/klant: de kantoor-pc hangt via NAT van VirtualBox aan internet en ziet zijn netwerk als Openbaar. Bij een klant hangt de pc aan het kantoornetwerk en wordt het profiel Privé; de firewall staat dan aan voor dat profiel (alle drie de profielen aangetoond).
- Volgende stap: logs (PR.PS-04.1, DE.AE-03.1) en toegangsrechten (PR.AA-05.1, 05.2, 05.3).

## 5. Bijlagen

- `bewijs/2026-11-21_*.png`: schermafbeeldingen van 21-11-2026.
- Small-dossier en bijlagen: `elektro-selders-cyfun-small.md`, `incidentcontactblad-sjabloon.md`, `schema-lab.html`.
