# Bulletin Monitor backend

Ez a repo a K-Monitor Bulletin Monitor (BM) projektjéhez fejlesztett backendet tartalmazza. Feladata a feliratkozások, esemény generátorok (scraperek),
események (keresések) kezelése.

## Célok

- uniformizálja a kommunikációt a scraperek és a feliratkozók között. A scraperek kapnak egy felületet, amin keresztül értesíteni tudják a feliratkozóikat
- elég absztrakt legyen, hogy új scraper fejlesztésekor a backend kódjába ne kelljen belenyúlni

## Kapcsolódó repok

- [Frontend](https://github.com/Code-for-Hungary/bmm-frontend)
- [Minta scraper](https://github.com/Code-for-Hungary/bmm-protoscraper)
- [Magyar Közlöny scraper](https://github.com/Code-for-Hungary/bmm-kozlonyscraper)
- [MNV szerződés scraper](https://github.com/Code-for-Hungary/bmm-mnvcontractscraper)
- [Bírósági határozatok](https://github.com/Code-for-Hungary/bmm-birosagscraper)
- [Kormany.hu/dokumentumtar](https://github.com/Code-for-Hungary/bmm-kormanyscraper)
- [Parlamenti irományok scraper](https://github.com/Code-for-Hungary/bmm-parlamentscraper)

## Futtatás fejlesztéshez

Előfeltétel:
- php
- composer
- adatbázis (mysql) + felhasználó
- .env fájl kitöltése

Függőségek telepítése
```
php composer.phar install
```

A `composer.lock` a Docker image PHP verziójához (8.3) van rögzítve a `composer.json` `config.platform` beállításával, így `composer update` után is kompatibilis marad.

Futtatás:
```
php artisan serve
```

## Telepítés (Docker)

Élesben Dockerrel fut: egy `app` konténer (PHP 8.3 + Apache) és egy `db` konténer (MariaDB).

1. `.env` kitöltése a `.env.example` alapján. A `DB_HOST`/`DB_PORT` értékét a compose felülírja, a `DB_ROOT_PASSWORD`-öt viszont meg kell adni.
2. Indítás:
   ```
   docker compose up -d --build
   docker compose exec app php artisan migrate --force
   ```
3. Az alkalmazás a `127.0.0.1:8080` címen érhető el (az `APP_PORT` változóval állítható). Kívülről egy reverse proxy (nginx/Apache, TLS) továbbítja ide a kéréseket.

Frissítés:
```
git pull
docker compose build
docker compose run --rm app php artisan migrate --force
docker compose up -d
```

A `.env` módosítása után `docker compose up -d` kell, a `docker compose restart` nem olvassa be újra.

Logok: `docker compose exec app tail -f storage/logs/laravel.log`

Adatbázis mentés:
```
docker compose exec -T db sh -c 'MYSQL_PWD="$MARIADB_PASSWORD" mariadb-dump -u"$MARIADB_USER" --single-transaction "$MARIADB_DATABASE"' | gzip > backup.sql.gz
```

## Kereső formátumok

A keresés a scraper oldalon van implementálva, de gyakorlatilag mind azonos módon működik. A keresőszavakra case-insensitive szó-szerinti egyezést nézünk, vagyis a szóközzel együtt keressük. Visszafele kompatibilitás miatt a `*` és `"` ignorálva vannak. A frontend egyszerre több kulcsszóra való feliratkozást és több feliratkozást is támogat. Feliratkozásonként bármelyik kulcsszó találata értesítést eredményez.

A kulcsszavakat feliratkozáson belül `,`-vel választjuk el, amit a scraper parsol.
