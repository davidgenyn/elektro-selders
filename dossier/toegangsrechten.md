# Toegangsrechten — Elektro Selders

CyFun Basic 2025, PR.AA-05.1, PR.AA-05.2, PR.AA-05.3. Opgesteld 22 november 2026 door de dienstverlener. Herziening: halfjaarlijks, samen met het incidentcontactblad en de restore-test.

## 1. Accounts en rechten

| Systeem | Account | Wie gebruikt het | Rechten | Waarvoor | Aanmelding |
|---|---|---|---|---|---|
| Kantoor-pc | `David` | zaakvoerder | Standard user | dagelijks werk: e-mail, documenten, facturatie | wachtwoord, lokaal account |
| Kantoor-pc | `labadmin` | zaakvoerder; dienstverlener onder toezicht | Administrator | installaties, updates, instellingen, logcontrole | wachtwoord, lokaal account |
| Router ASUS RT-AX55 | beheerder (eigen naam, niet "admin") | zaakvoerder; dienstverlener onder toezicht | volledig beheer | routerinstellingen, firmware, logcontrole | wachtwoord; alleen vanaf het kantoornetwerk, beheer vanaf internet uit |
| Mailbox lotusflow.contact@gmail.com | eigenaar | zaakvoerder | volledig | zakelijke e-mail | wachtwoord + tweestapsverificatie (authenticator-app) |
| Back-upschijf WD Elements | geen account | zaakvoerder | fysiek | back-up | in afgesloten kast |
| Wifi kantoor (ElektroSelders) | gedeelde sleutel | zaakvoerder, kantoor-pc | toegang tot het kantoornetwerk | — | WPA2/WPA3 |
| Wifi gast (ElektroSelders-Gast) | gedeelde sleutel | bezoekers | alleen internet, geen toegang tot het kantoornetwerk | — | WPA2/WPA3 |

Regels:
- Dagelijks werk gebeurt altijd als `David`. `labadmin` alleen voor beheer, en afmelden zodra het beheer klaar is.
- De dienstverlener heeft geen eigen account; hij werkt met `labadmin` en de routerbeheerder, in aanwezigheid van de zaakvoerder. Komt er ooit een eigen account voor een dienstverlener, dan staat die in deze tabel, met einddatum.
- Geen gedeelde accounts voor personen. De wifi-sleutels zijn de enige gedeelde geheimen; de gastsleutel mag aan bezoekers worden gegeven, de kantoorsleutel niet.
- Wachtwoorden en back-upcodes staan niet in dit document; waar ze liggen staat in het incidentcontactblad.

## 2. Bedrijfskritieke informatie en wie erbij kan (PR.AA-05.2)

| Informatie | Waar | Wie heeft toegang | Hoe |
|---|---|---|---|
| Boekhouding, facturen, klantgegevens | map Documenten op de kantoor-pc | zaakvoerder (`David`, `labadmin`) | aanmelden op de kantoor-pc |
| Kopie daarvan | back-upschijf (File History) | wie de schijf fysiek heeft | schijf aansluiten op de kantoor-pc |
| Zakelijke e-mail | mailbox Gmail | zaakvoerder | wachtwoord + tweestapsverificatie |
| Routerconfiguratie en -logs | router | zaakvoerder, dienstverlener onder toezicht | routerbeheerder, vanaf het kantoornetwerk |
| Windows-logs (Security, System, Application) | kantoor-pc, `C:\Windows\System32\winevt\Logs` | alleen `labadmin` | aanmelden als beheerder; Standard user heeft geen leesrecht (aangetoond 21-11-2026) |

## 3. Least privilege (PR.AA-05.3)

Elk account heeft alleen wat zijn taak vraagt:
- `David` kan werken, maar geen software installeren, geen instellingen wijzigen, geen beveiligingslogs lezen.
- `labadmin` kan alles op de pc, maar wordt niet gebruikt voor e-mail of documenten.
- De routerbeheerder kan alleen de router.
- Bezoekers op het gastnetwerk komen niet op het kantoornetwerk (getest 10-11-2026).

## 4. Beheer van deze lijst (PR.AA-05.1)

- Bij elke wijziging (nieuw toestel, nieuwe medewerker, vertrek, nieuwe dienst) wordt deze lijst aangepast, op de dag zelf. Bij vertrek: account uitschakelen, wifi-sleutel van het kantoor wijzigen als de persoon die kende.
- Halfjaarlijkse herziening: elk account nalopen (nog nodig? juiste rechten?), ongebruikte accounts uitschakelen.

| Datum | Door | Wat |
|---|---|---|
| 22-11-2026 | dienstverlener | eerste versie |
