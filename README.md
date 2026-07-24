# Blog-App Secure

## Voraussetzungen
- PHP >= 8.x
- MySQL 8.0.x
- Composer
- Symfony CLI
  
Installationsanweisungen

1. Die Dependencies installieren:
````
composer install
````

2. Lokaler Server starten:
```
symfony server:start
```
Die App ist danach unter http://localhost:8000 erreichbar.

## Datenbankeinrichten und Daten vorbereiten
Vor dem Testen müssen die Tabellen in der Datenbank erstellt und mit Testdaten befüllt werden. Dafür muss zuerst der DSN String in der .env Datei angepasst werden.

1. Den Inhalt aus .env.example in .env kopieren und die Datenbankverbindung entsprechend herstellen:

```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/dbname?serverVersion=8.0"
```

2. Die Datenbank erstellen
```
symfony console doctrine:database:create
```

3. Migrationen ausführen:

```
symfony console doctrine:migrations:migrate
```

4. Data-Fixtures laden:
```
symfony console doctrine:fixtures:load
```

Fertig!
