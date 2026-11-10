# Elektro Selders – demo-website (Weblotus)

Statische website voor een fictieve elektricien in Achel, gebouwd als demo van de Weblotus-dienst
"website die de klant zelf kan aanpassen". Live op **https://lotusflow.net** (tijdelijk; gaat na de demo offline).

## 1. Hoe het werkt

```
Klant                         Weblotus (David)
  │ tekst/foto's wijzigen        │ code wijzigen
  ▼                              ▼
lotusflow.net/admin/  ──►  GitHub davidgenyn/elektro-selders (main)
(Decap CMS + DecapBridge)        │ elke commit
                                 ▼
                           Netlify bouwt (Eleventy) en zet live
                                 ▼
                           https://lotusflow.net  (DNS bij Vimexx → Netlify)
```

| Onderdeel | Wat | Waar |
|---|---|---|
| Broncode | Eleventy 3 (Nunjucks), inhoud in YAML | GitHub `davidgenyn/elektro-selders` |
| Beheerscherm klant | Decap CMS 3.17.3, login via DecapBridge | `https://lotusflow.net/admin/` |
| Hosting/build | Netlify, team **Weblotus**, project `elektro-selders` | app.netlify.com |
| Domein/DNS | Vimexx: `A @ → 75.2.60.5`, `CNAME www → elektro-selders.netlify.app` | Vimexx |
| SSL | Let's Encrypt via Netlify, vernieuwt automatisch | Netlify → Domain management |
| Contactformulier | POST JSON naar n8n-webhook op lotusserver (Tailscale Funnel), pad `/webhook/elektro-selders-contact` (workflow nog niet gemaakt) | `src/_data/site.yml` → `webhook` |
| Statistieken | Umami Cloud (cookieloos) + Google Analytics 4 (na toestemming via cookiebanner) | zie §5 |

## 2. Accounts en rollen

| Dienst | Account | Rol |
|---|---|---|
| GitHub | davidgenyn | eigenaar repository |
| Netlify | david.genyn@gmail.com, team Weblotus | eigenaar; **Personal-plan $9/mnd** sinds 10 nov 2026 |
| DecapBridge | david.genyn@gmail.com (Google-login) | **Owner**: enige die site-instellingen (login-URL, token) kan wijzigen |
| DecapBridge | lotusflow.contact@gmail.com (wachtwoord) | **Collaborator** = de "klant": kan inhoud bewerken, geen instellingen |
| Umami Cloud | lotusflow.contact@gmail.com (Google-login), regio EU, Hobby-plan | website "Elektro Selders", ID `3128268b-5f0e-4544-890c-76da63d4afc7` |
| Google Analytics | lotusflow.contact@gmail.com | property "Elektro Selders website", stream `lotusflow.net`, Measurement ID `G-ZGG925D6E5`, Google tag `GTM-5TJNBBFF` |
| Vimexx | bestaand account | DNS lotusflow.net |
| WordPress.com | lotusflow.contact@gmail.com | **oude route, niet meer gebruikt; opzeggen vóór 26 nov 2026** |

Let op bij DecapBridge: ingelogd als collaborator zie je enkel "Go to CMS" en geen instellingen. Voor instellingen uitloggen en met het owner-account (Google) inloggen → **Manage site** → tab **Settings**.

## 3. Wijzigingen doorvoeren

| Wat | Wie | Hoe | Deploy? |
|---|---|---|---|
| Teksten, foto's, bedrijfsgegevens, SEO-titels | klant of David | `/admin/` → Pagina's of Bedrijfsgegevens → **Publiceer** | ja, 1 per Publiceer |
| Layout, CSS, templates, nieuwe velden | David (met Claude) | commit op `main` via git (Claude duwt rechtstreeks naar GitHub via de GitHub-koppeling van het Claude-account; geen token nodig) | ja, 1 per commit |
| Nooit meer | – | losse bestanden of zips uploaden via de GitHub-website (Windows haalt de punt uit `.eleventy.js`, mappen gaan verloren) | – |

Netlify bouwt bij **elke** commit, dus ook bij een README-wijziging. Groepeer wijzigingen.

### Bestandsstructuur

```
eleventy.config.js      Eleventy-config: YAML-data, foto-optimalisatie (webp/jpeg 480/800/1200), inline CSS
netlify.toml            build-opdracht, Node 20, cache-headers (/img/ 1 jaar, /images/ 1 week), /admin/ noindex
package.json            @11ty/eleventy, @11ty/eleventy-img, js-yaml
src/_data/site.yml      bedrijfsgegevens, webhook, Umami-ID, Google tag, noindex-schakelaar
src/_data/home.yml, diensten.yml, overons.yml, contact.yml   inhoud per pagina (+ seo: titel/omschrijving)
src/_includes/base.njk  layout: head (SEO, OG, schema.org Electrician, Umami), header, footer, cookiebanner
src/index.njk, diensten.njk, over-ons.njk, contact.njk, privacy.njk, sitemap.njk
src/admin/config.yml    Decap-configuratie (collecties, Nederlandse labels, DecapBridge-backend)
src/css/style.css       huisstijl wit/blauw (#0F2F5C, #1E5AA8, #E8F0FA)
src/images/logo.png     logo; src/images/uploads/  foto's van de klant (via CMS)
src/robots.txt          Allow /, Disallow /admin/, Sitemap
```

## 4. Netlify: plan en credits

| Feit | Waarde |
|---|---|
| Kost per geslaagde productie-deploy | 15 credits |
| Free-plan | 300 credits/mnd = 20 deploys; bij 0 gaat de site **offline** tot de volgende maand; bijkopen kan niet |
| Personal-plan (huidig) | $9/mnd, 1.000 credits = 66 deploys; maandelijks, verlengt automatisch |
| Auto recharge | **uit laten** (anders worden automatisch credits bijgekocht) |
| Stoppen | Usage & billing → **Billing details** → link "first downgrade this team to a **Free Plan →**" |
| Regel voor echte klanten | Free-plan nooit gebruiken; Personal (1 klant) of Pro ($20, 3.000 credits) |

## 5. Statistieken

| | Umami Cloud | Google Analytics 4 |
|---|---|---|
| Cookies / toestemming | geen cookies, geen banner nodig (standpunt Umami; data in EU) | cookies → banner met Aanvaarden/Weigeren verplicht (ePrivacy/AVG) |
| Geblokkeerd door adblockers | zelden | vaak (AdGuard blokkeerde het bij de test) → GA telt die bezoekers niet |
| Prijs | Hobby $0 (1 site, 100.000 events/mnd, 6 mnd bewaring); Pro $20/mnd (20 sites, 1 M events, 2 jaar) | gratis |
| Dashboard | cloud.umami.is | analytics.google.com → Reports → Realtime / Reports snapshot |
| Events | `bel`, `mail` (links), `formulier` (verzonden) | automatisch: page_view, scroll, outbound click, … |
| Uitzetten | veld "Umami website-ID" leegmaken in Bedrijfsgegevens | veld "Google tag" leegmaken → ook de banner verdwijnt |

Een *event* = één meting (paginaweergave of klik). *Bewaartijd* = hoe lang de geschiedenis bewaard blijft.

Cookiebanner: eigen code in `base.njk`; keuze in `localStorage` (`es_consent`). Bij Weigeren of geen keuze wordt niets van Google geladen. Keuze opnieuw: browsergegevens van de site wissen.

## 6. SEO en lokale vindbaarheid

| Punt | Status |
|---|---|
| Paginatitel + meta description per pagina (via CMS, "Google-instellingen") | ✅ |
| Canonical, Open Graph, `lang="nl-BE"` | ✅ |
| schema.org `Electrician` (naam, adres Achel, telefoon, uren, werkgebied) | ✅ |
| robots.txt + sitemap.xml | ✅ |
| PageSpeed mobiel 10 nov 2026: Prestaties 100, Toegankelijkheid 100 (na fixes), Praktische tips 100, SEO 100 | ✅ |
| **noindex** (demo niet in Google) | ✅ aan via Bedrijfsgegevens → "Verbergen voor Google"; **bij een echte klant uitzetten** |
| Search Console | nog niet aangemaakt (domein-property lotusflow.net, TXT bij Vimexx, sitemap indienen) |
| Google Bedrijfsprofiel | niet mogelijk voor een fictief bedrijf; **belangrijkste lokale factor** voor echte klanten |
| Per-gemeente-pagina's (Elektricien Pelt, Lommel, …) | optie voor echte klanten, niet in de demo |

Snelheidsles: foto's van 1–3 MB zonder `width/height` gaven score 75; `@11ty/eleventy-img` (automatisch webp + srcset) en inline CSS brachten het op 100. Foto's van de klant mogen dus groot zijn; de build verkleint ze.

## 7. Lokaal werken (optioneel)

```
npm install
npm start                 # site op http://localhost:8080
# beheerscherm zonder login: local_backend: true in src/admin/config.yml, dan in 2e venster:
npm run cms
```

## 8. Open punten

| Punt | Status |
|---|---|
| n8n-workflow voor het contactformulier (Webhook → e-mail) | later |
| Search Console | te doen |
| WordPress.com Premium opzeggen | vóór 26 nov 2026 |
| Klantenhandleiding (apart document) | te schrijven |
| Portfolio-screenshots voor weblotus.be | te maken vóór de site offline gaat |
| Netlify Personal terugzetten naar Free als de demo stopt | vóór 9 dec of een latere maandgrens |
