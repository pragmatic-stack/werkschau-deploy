# Werkschau Development Repository

Entwicklung der Werkschau Website mit Node.js, Webpack und Kirby.

# Workflow für neue Features / Seiten

Das System ist mit Webpack aufgebaut um diverse Tools für die Frontend Entwicklung einzubinden, Code zu verkleinern und moderne Technologien wie SCSS und ES6 nutzen zu können.

### **Entwickeln des Skeletts mit Webpack**

1. Seite im **src/pages** Verzeichnis anlegen (per Skript oder manuell)
2. Html Struktur aufbauen
3. JavaScript und SCSS implementieren
4. Webpack ausführen (**html-build** oder **kirby-build**)

### **Anlegen der Templates in Kirby**

1. Blueprint (optional - wenn eine Konfiguration über das Panel möglich sein soll)
2. Template (Übernahme aus dem `dist` Verzeichnis) und Php implementieren
3. Content Seite anlegen oder über das Panel erstellen

# Abhängigkeiten installieren

Es wird vorausgesetzt dass Node.js installiert und verwendungsfähig ist. [Node.js](https://nodejs.org/en/)

`npm i` oder `npm install` installiert die Abhängigkeiten, welche in der package.json definiert wurden.

# Seitentyp entwickeln

Durch das Hilfsskript kann ein zusätzlicher Seitentyp (für ein späteres Kirby Template) angelegt werden. Hierbei wird im Verzeichnis `src/pages`eine neue Seitenkonfiguration für die weitere Vorgehensweise angelegt.

`npm run add-frontend-page <page-name>`

**In diesem Beispiel:**

`npm run add-frontend-page building`

Das Skript erzeugt die folgende Struktur:

    -- src/pages
    	-- ...
    	-- building
    			-- building.html    // enthält das seitenrelevante markup
    			-- building.js      // enthält seitenrelevantes javascript
    			-- building.scss	  // enthält seitenrelevante styles

In der **building.html** kann nun das HTML-Markup angelegt werden. Die **building.js** dient der Entwicklung von seitenspezifischem JavaScript. Die **building.scss** enthält das seitenspezifische SCSS das zu CSS umgewandelt wird.

Globale Styles und JavaScript werden im Ordner `src/assets/css/shared` oder `src/assets/js/shared` angelegt und in der `index.js` und / oder `src/assets/css/globals.scss` eingebunden.

# Webpack Befehle

### **Html-Build - Seitenstruktur**

    npm run html-build

Erstellt die Seite in einer Dummy Version ohne PHP im Ordner **dist**. Dieser Befehl dient der initialen Visualisierung von Seiten und neu entwickelten Features.

### **Html-Start - Entwicklung des Skeletts mit Webpack-Dev-Server**

    npm run html-build

Erstellt die Seite in einer Dummy Version ohne PHP im Ordner **dist**. Dieser Befehl dient der initialen Visualisierung von Seiten und neu entwickelten Features.

### **Kirby-Build - Assets für Kirby**

    npm run kirby-build

Erstellt das Asset Verzeichnis im `www/assets` Verzeichnis zur Auslieferung der Seite.

### **Kirby-Watch - Assets für Kirby im Watch Mode (experimental)**

    npm run kirby-watch

Erstellt die Bundles im Watch-Modus um parallel die PHP-Templates zu entwickeln.

# Hilfsskripte

### Add-Frontend-Page **- Hilfsskript für die Skelett Entwicklung**

    npm run add-frontend-page <pagename>

Erstellt eine Seite für die Entwicklung mit Webpack im `src/pages` Verzeichnis.