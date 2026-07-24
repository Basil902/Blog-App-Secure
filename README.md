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

## Datenbank einrichten und Testdaten vorbereiten
Vor dem Testen müssen die Tabellen in der Datenbank erstellt und mit Testdaten befüllt werden. Dafür muss zuerst der DSN String in der .env Datei angepasst werden.

1. Eine neue Datei .env erstellen und den Inhalt aus .env.example da rein kopieren. Danach in der .env Datei die Datenbankverbindung entsprechend anpassen:

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
