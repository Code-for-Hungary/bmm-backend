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
php composer.phar update
php composer.phar install
```

Futtatás:
```
php artisan serve
```

## Telepítés

Élesben érdemes egy webszerverrel futtatni
