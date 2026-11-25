# WordPress-thema "Elektro Selders" v2.4 (Weblotus)

Klassiek WordPress-thema voor klantsites die de klant zelf bewerkt. Staat sinds 25 nov 2026 op de
WordPress.com-site van Elektro Selders (`famous-pirate-blizzard.wpcomstaging.com`, plan Premium), waaraan
het domein **lotusflow.net** gekoppeld wordt (zie `docs/domein-en-lancering.md`). De eerdere Decap/Netlify-demo
wordt niet meer gebruikt; die code blijft als archief in de hoofdmap van deze repository.

## Wat het doet
- **Rol "Klant"** (`es_klant`): ziet enkel Dashboard, Pagina's, Media, Bedrijfsgegevens. Thema's, plugins,
  instellingen, gebruikers en thema-editor zijn afgeschermd (403). Getest 25 nov als gebruiker `bea`.
- **Bedrijfsgegevens**: één formulier (naam, slogan, telefoon, e-mail, adres, btw, uren, werkgebied), gebruikt in
  header, footer, contactpagina en schema.org.
- **Vergrendelde sjablonen** (blokpatronen, categorie "Elektro Selders"): Home, Diensten, Over ons, Contact en
  drie dienstpagina's (Dienst – Installatie / Storingen / Energie). Voor de rol Klant staat de editor op
  "alleen inhoud": tekst en foto's wijzigen, geen blokken toevoegen/verplaatsen/wissen, geen code-weergave.
  (Het optiesmenu van een blok biedt nog wel "Verberg" — WordPress 7 — waarmee de klant een blok onzichtbaar
  kan maken zonder het te wissen.)
- **FAQ**: op Diensten en de dienstpagina's als uitklapblokken (Details-blok: vraag = titel, antwoord = tekst).
  Het thema maakt daaruit automatisch `FAQPage`-structured data; de klant hoeft niets te doen.
- **Mijn Elektro** (v2.4): klantenzone — registreren/inloggen, eigen pagina met afspraak, installatie, documenten,
  berichten; beheer via dashboard → Klanten; afspraken via Cal.com op `/afspraak/`. Zie `docs/mijn-elektro-plan.md`.
- **SEO**: paginatitel, meta description (uit de samenvatting, anders de eerste 28 woorden), canonical,
  Open Graph (als Yoast niet actief is) en schema.org `Electrician` uit de Bedrijfsgegevens (altijd).
  Sitemap maakt WordPress zelf (`/wp-sitemap.xml`). Yoast SEO is voor deze site niet nodig.

## Bestanden
```
style.css       huisstijl (v2.4)
functions.php   alles in één bestand: setup, Bedrijfsgegevens, rol Klant, sjablonen + FAQ, SEO + FAQPage
header.php, footer.php, page.php, index.php, single.php, 404.php, logo.png
docs/domein-en-lancering.md   domein koppelen, DNS bij Vimexx, lanceren, Netlify stopzetten (met screenshots)
docs/klant-handleiding.md     voor de klant: inloggen, tekst/foto/FAQ aanpassen, Bedrijfsgegevens (met screenshots)
docs/mijn-elektro-plan.md     fase 3: klantenzone "Mijn Elektro" + afspraken via Cal.com (gebouwd 25 nov; Cal.com-account nog te maken)
```
Alles in één `functions.php` zodat het via Weergave → Thema bestand editor in het dashboard geplaatst kan worden
(die editor kan geen nieuwe bestanden maken).

## Plaatsen of bijwerken op een site (via het dashboard, ingelogd op het account van de klant)
1. Weergave → Thema bestand editor → `style.css` vervangen → Update bestand.
2. Idem `functions.php`. WordPress test op PHP-fouten vóór het opslaat ("Bestand succesvol bewerkt").
   Tip: in de thema-editor kan de inhoud rechtstreeks van GitHub gehaald worden
   (`raw.githubusercontent.com/davidgenyn/elektro-selders/main/wordpress-thema/elektro-selders/functions.php`),
   zodat site en GitHub gelijk blijven. Commit altijd dezelfde versie die op de site staat.
3. Bedrijfsgegevens invullen → opslaan.
4. Pagina's: Home (voorpagina), Diensten, Over ons, Contact, en onder Diensten de subpagina's
   `installatie`, `storingen`, `energie`; per pagina het sjabloon invoegen, foto's kiezen → Bijwerken.
   Op 25 nov is dit via de WordPress REST-API gedaan (zelfde resultaat als in de editor).
5. Gebruikers → Gebruiker toevoegen: rol **Klant**, vinkje "Gebruiker uitnodigen voor WordPress.com" **uit**
   (anders ontstaat geen gewone gebruiker met wachtwoord maar een uitnodiging). De klant logt in via
   `/wp-login.php` → "Login met gebruikersnaam en wachtwoord" (Jetpack toont eerst WordPress.com-login en een
   rekensommetje).
6. Domein koppelen en lanceren: `docs/domein-en-lancering.md`.

Eigendom: het WordPress.com-account, de site en het domein staan op naam van de klant. Weblotus werkt op vraag
van de klant met de login die de klant geeft. Geen apart Weblotus-beheerdersaccount.

## Snelheid (PageSpeed, 25 nov 2026, wpcomstaging-adres)
Mobiel 97 / 96 / 100 / 69, desktop 100 / 93 / 100 / 69 (prestaties / toegankelijkheid / best practices / SEO).
SEO 69 = "blocked from indexing" zolang het wpcomstaging-adres primair is; verdwijnt na de domeinkoppeling.
Les: foto's **vóór upload** verkleinen (≤ 900 px breed, JPG/WebP). De drie dienstenfoto's waren PNG's van ~1 MB
(score 78); als WebP van 36–83 KB (in de browser omgezet met canvas → toBlob('image/webp') en geüpload via
de REST-API) gaf dat 97. Thema v2.3 verhelpt de toegankelijkheidsmeldingen (footer-`h4`, onderstreepte
tekstlinks, logo met width/height). Resterende meldingen komen van WordPress.com/Jetpack-scripts.

## Open punten (25 nov 2026)
- Yoast SEO is gedeactiveerd (niet verwijderd) en Jetpack AI staat uit voor de rol Klant (v2.2). Het
  Jetpack-paneel "Optimaliseer SEO" blijft zichtbaar; uit te zetten via Jetpack → Instellingen → Verkeer →
  SEO-tools als dat gewenst is.
- Analytics (GA4 ingebouwd op Premium; cookiebanner en Umami nog uit te zoeken), PageSpeed-meting en
  robots.txt/AI-crawlers: pas na domeinkoppeling op `https://lotusflow.net`.

## Lokaal testen
WordPress + SQLite in een map, `php -S 127.0.0.1:8085`; een scriptje maakt rol, testgebruiker en de pagina's
uit de patronen aan. Screenshots van de v2-test: `docs/v2_*.png` in de hoofdmap van deze repository.
