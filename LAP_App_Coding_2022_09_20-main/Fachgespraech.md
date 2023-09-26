# :speech_balloon: Fachgespräch

Bei meiner LAP wurden mir folgende Fragen gestellt:

## :chart_with_upwards_trend: Datenbanken

- Welche Arten von Datenbanken kennen Sie?
- Worin unterscheiden sich relationale Datenbanken von NoSQL-Datenbanken
- Welche SQL-Operationen kennen Sie?
- Welche Möglichkeit haben sie Daten aus mehreren Tabellen abzufragen?
- Welche Arten von JOINS kennen Sie?
- Wie können Sie die Schnelligkeit von Datenbankabfragen beeinflussen?

## :pencil2: Programmieren

Auf der Tafel steht Pseudo-Code:

### Beispiel 1

```
a = 4
b = 3
c = 5

if(a < 2){
    print("z")
}else if (b > 3 and a < 5){
    print("y")
}else if (c < 3 or a > 2){
    print("x")
}else{
    print("v")
}
```

- Welche Datentypen haben die Variablen im Programmcode
- Erklären Sie was im Programmcode passiert. 
- Was wird ausgegeben und warum?
- Welchen Datentyp hätte ```"x"``` wenn man es in eine Variable speichern möchte?


### Beispiel 2

```
array[] = []
m = 1
for(i = 0, i < 3, i++){
  array[m] = i
  print(array[m])
  m++
}
```

- Was passiert hier?
- Was wird ausgegeben?
- Was muss verändert werden, damit das Array an erster Stelle einen Wert bekommt?

### Beispiel 3

```
i = 3
m = 1
for(i = 0, i < 100, i++){
  print(m)
  m++
}
```

- Wie oft wird die Schleife durchlaufen?
- Was wird ausgegeben?


## :page_with_curl: Datenschutz/DSGVO

### Szenario des Prüfers
Sie arbeiten ja mit medizinischen Daten. 
Ich rufe Sie an und gebe Ihnen meine Sozialversicherungsnummer und möchte Auskünfte zu meinen Laborauswertungen haben. 
Bekomme ich diese Informationen von Ihnen? Wie reagieren Sie?

### Szenario 2 des Prüfers
Es wird in Ihrem Betrieb einen Betriebsausflug geben. Ich bin das Busunternehmen. Ich rufe Sie an und bitte Sie mir die Reisepassdaten der Mitarbeiter zu geben.
Bekomme ich diese? Welches Gesetz liegt hier zugrunde?

## :lock: IT-Sicherheit
- Wie erkennen Sie beim Aufruf einer Website, ob diese sicher ist?
- Sie rufen eine Website auf und sehen https und ein Schloss als Sicherheitsmerkmal, trotzdem wird Ihnen im Browser angezeigt, dass diese Seite nicht sicher ist. Wie kann das sein?
- Was ist der Unterschied, wenn ein Zertifikat von einer Zertifizierungsstelle ausgestellt wird im Gegensatz zu eine self-signed Zertifikat?
- Was ist eine Man-in-the-Middle-Attack? Wie können sie Ihre Datenbank vor einer solchen Man-in-the-Middle-Attack schützen?


# :speech_balloon: Fragen aus diversen anderen Fachgesprächen

## :pencil2: Programmieren/Programmiersprachen
- Was wird vom Lehrling erwartet (oder generell vom Softwareentwickler), wenn er Code schreiben muss?
- Welche Punkte müssen beim Entwickeln beachtet werden?
  - Tipp von Prüfer (wenn Frage nicht verstanden wird): Sie kriegen jetzt einen Task, Sie programmieren jetzt eine Klasse mit Variablen und Methoden. Was muss beachtet werden, wenn Sie programmieren?
  - Tipp 2. "Wiederverwertbarkeit": ist es wahrscheinlich, dass Code wiederverwenden? (OOP)
- Was ist zu beachten/noch zu tun, nachdem Code geschrieben und getestet wurde, bevor er zum Kunden kommt?
- Wie könnte man Programmiersprachen unterteilet werden und wodurch unterscheiden sich Programmier-/Scriptsprachen?
- Wozu dient ein Debugger und wie verwendet man diesen?
- Wann benötigen Sie einen Compiler und wann einen Interpreter?
- Wie funktioniert eine Schnittstelle? Welche Rollen spielen CSV, XML, JSON dabei?
- Welche Möglichkeiten der Source-Code-Versionierung gibt es?
- Welche Sortieralgorithmen kennen Sie? Welcher Algorithmus ist schneller?
- Nennen Sie die Grundsätze ordentlicher Programmierung (Prinzip DRY, Prinzip KISS, Stabilität, Wiederverwertbarkeit, Modularität, etc.)
- Erklären Sie den Pseudo-Code an der Tafel (if-else Verschachtelung, for-Schleife mit eigenem Index, die durch die Indices eines Arrays durchgehen und diese setzen soll)
- Was ist sicherer ein GET- oder POST-Request und warum?

## :chart_with_upwards_trend: Datenbanken
- Welche Punkte müssen beim Datenbankdesign berücksichtigt werden, oder wie würden Sie ein Datenbankdesign beginnen?
- Szenario vom Prüfer: Sie entwickeln jetzt eine Person-Tabelle und eine Gruppen-Tabelle, Personen können mehrere Gruppen zugeordnet haben. Wie würden Sie das designen?
- Wodurch könnte bei SQL SELECT-Statements ein Geschwindigkeitsvorteil erzielt werden (LIMIT) und besteht dieser auch noch in Kombination mit ORDER BY?
- Datenbankdesign (Diagramm) zeichnen auf Whiteboard (ER-Diagramm zeichnen) -> Personen, Benutzergruppen
- Wie kann man eine Person mehreren Benutzergruppen zuordnen? -> z.B. eine Person kann Admin-Gruppe und Entwickler-Gruppe haben. Wie wird das funktionieren vom DB-Design her?
- Normalformen des Designs beachten - Gibt es eine Verletzung der Normalisierung beim DB-Design? (Hier aufpassen)
- Was ist eine Kardinalität im bezug auf Datenbanken?
- Erklären Sie die Königsweg-Normalisierung?
- Was ist eine Code Injektion? Wie kann eine solche Code Injection im Bezug auf Datenbanken aussehen?
- Szenario: Eine Firma hat mehrere Standorte, Mitarbeiter haben Dienstautos. 
    - Beispiel-DB ausdenken und aufskizzieren - auf korrekte Relationen achten (1 to 1, 1 to many, many to one, many to many)
    - SQL Statement angeben, welches darstellt an welchem Standort das Auto von Mitarbeiter X gerade steht.
- Szenario: Sie verwenden bei ihrer Datenbank als Primärschlüssel Integer-Werte. Jemand bittet Sie einen Datensatz zwischen ID 5 und 6 einzufügen, wie gehen Sie vor?

## :page_with_curl: Datenschutz und DSGVO
- Szenario vom Prüfer: "Ich bin ihr Lehrling, damit wir bei den Kunden unseren Vor-Ort-Einsatz Einschulungen machen können, müssen wir alle personenbezogenen Daten (Reisepass Daten) an diese Firma schicken."
  - Die Daten wurden vom Lehrling schon gesendet, was passiert jetzt? Ist das schlecht, dass wir diese Daten senden? Was muss berücksichtigt werden? Was sagen Sie Ihrem Chef, dass der Lehrling die Daten schon gesendet hat? Lösungen?
  - Was muss grundsätzlich aufgepasst werden, wenn wir diese Daten schicken?
  - Prüfer: "Wir dürfen diese Daten senden, weil es eigentlich überall 3 Zetteln im Büro aufhängen" - ist das ein gutes Argument?
- Was ist das Datenschutzgesetz? Was regelt das Datenschutzgesetz? Gilt das Datenschutzgesetz in ganz Europa? muss man für die Firma die DSGVO berücksichtigen?
- Urheberrecht, Datenschutzgrundgesetz und Copyright => welche dieser 3 Gesetze müssen Sie befolgen (als Programmierer?), welche sind wichtig? Warum ist Copyright wichtig?
- Wenn eine Software Opensource ist, darf ich sie verwenden? Softwarelizenzierung achten!  z.B. MIT-License, Apache etc. mit einer Lizenzierung darf Opensource-Code weiter kopiert und erweitert werden?
- Probleme mit Google Fonts - Aktueller Fall: Firmen wurde wegen der Verwendung von Google Fonts angezeigt. 
    - Wie finden Sie heraus, ob Sie in Ihrer Applikation Google-Fonts verwenden? (Dev-Tools - Sources)
    -  Wo genau liegt hier das Problem? (Fonts werden vom Google Server geladen. Unter Umständen tauchen also Daten wie IP-Adressen auf US-Server von Google auf weil der User von dort die Font ziehen muss)

## IT-Sicherheit
- Wie würden Sie einen Man-in-the-Middle Angriff durchführen? Beschreiben Sie ihr Vorgehen. Was ist dafür nötig? (eigener Server, Webseite faken, Daten unauffällig weiterleiten)
- Wie erkennen Sie, dass eine Website sicher ist? Wie kann man ein Zertifikat einsehen? Wie kann man ein solches beziehen?

## Projektmanagement
- Was ist der Unterschied vom klassischen zum agilen Projektmanagement?
- Erklären Sie das Pokerkarten-Prinzip.
- Was ist ein Projektstrukturplan?
- Wozu benötigt man einen Projektzeitplan? Welche Darstellungsmöglichkeiten kennen Sie?

## Sonstige
- Welcher Farbraum wird für die Anzeige auf Bildschirmen verwendet und wie lautet der Farbcode für gelb?

Weitere Fragen einer LAP aus 2020: https://github.com/Azgeb/Komplette-LAP/blob/master/Informationen/Fachgespr%C3%A4ch.md


