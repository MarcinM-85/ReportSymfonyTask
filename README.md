Aplikacja webowa oparta na Symfony 7 z bazą MySQL.  
Projekt zawiera moduł raportów, filtrowanie AJAX, formularze Symfony oraz klasyczną architekturę MVC.

---

## Wymagania

- PHP ≥ 8.2.12
- Composer ≥ 2.0
- MariaDB ≥ 10.4.32

---

## Instalacja

composer install

Zamień .env.sample na .env.local i zmień DATABASE_URL i DEFAULT_URI.

Wykonaj migrację bazy danych poleceniem: php bin/console doctrine:migrations:migrate
