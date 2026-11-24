# WordPress-thema "Elektro Selders" v2 (Weblotus)

Klassiek WordPress-thema voor klantsites die de klant zelf bewerkt. Getest lokaal op WordPress 7.2 (24 nov 2026);
nog niet op de WordPress.com-testsite geplaatst (daar staat v1.1).

## Wat het doet
- **Rol "Klant"** (`es_klant`): ziet enkel Dashboard, Pagina's, Media, Bedrijfsgegevens. Thema's, plugins,
  instellingen, gebruikers en thema-editor zijn afgeschermd (403).
- **Bedrijfsgegevens**: één formulier (naam, slogan, telefoon, e-mail, adres, btw, uren, werkgebied), gebruikt in
  header, footer, contactpagina en schema.org.
- **Vergrendelde sjablonen**: blokpatronen Home, Diensten, Over ons, Contact. Voor de rol Klant staat de editor op
  "alleen inhoud": tekst en foto's wijzigen, geen blokken toevoegen/verplaatsen/wissen, geen code-weergave.
- **SEO**: meta description, canonical, Open Graph (als Yoast niet actief is) en schema.org `Electrician` uit de
  Bedrijfsgegevens (altijd).

## Bestanden
```
style.css       huisstijl (v2.0)
functions.php   alles in één bestand: setup, Bedrijfsgegevens, rol Klant, sjablonen, SEO
header.php, footer.php, page.php, index.php, single.php, 404.php, logo.png
```
Alles in één `functions.php` zodat het via Weergave → Thema bestand editor in het dashboard geplaatst kan worden
(die editor kan geen nieuwe bestanden maken).

## Plaatsen op een site (via het dashboard, ingelogd op het account van de klant)
1. Weergave → Thema bestand editor → `style.css` vervangen → Update bestand.
2. Idem `functions.php`. WordPress test op PHP-fouten vóór het opslaat.
3. Bedrijfsgegevens invullen.
4. Pagina's → per pagina het sjabloon "Elektro Selders" invoegen (Home, Diensten, Over ons, Contact), foto's kiezen → Bijwerken.
5. Gebruikers → nieuwe gebruiker met rol **Klant** voor de persoon die inhoud bewerkt.

Eigendom: het WordPress.com-account, de site en het domein staan op naam van de klant. Weblotus werkt op vraag
van de klant met de login die de klant geeft.

## Lokaal testen
`/home/claude/wptest` (WordPress + SQLite, `php -S 127.0.0.1:8085`), script `setup_v2.php` maakt rol, gebruiker `jan` en
de vier pagina's aan. Screenshots van de test: `docs/v2_*.png` in de hoofdmap van deze repository.
