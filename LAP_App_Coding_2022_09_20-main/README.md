# :trophy: Lehrabschlussprüfung aus dem Lehrberuf Applikationsentwicklung - Coding am 20.09.2022

## :closed_book: Rahmenbedingungen

- Start 08:00
- Mittagspause: 12:00
- Abnahmen des Praxisteils: 15:00
Gegebenenfalls kann es sein, dass die Zeiten etwas abweichen

### :pencil2: Programmierteil

Es wird jedem ein Platz zugeteilt. Am lokalen Rechner ist Linux Mint installiert. Es ist VirtualBox installiert und es gibt 2 VMs.
1. VM: Windows 11 mit vorinstalliertem VS Code, VS Studio, Notepad++
2. VM: eine Debian-VM, deren Appliance von Bitnami (https://bitnami.com/stack/lamp/virtual-machine) ist. 
    - In der Appliance ist bereits ein LAMP-Stack eingerichtet, d.h. es PHP, der Apache Webserver, MariaDB und der PHPMyAdmin sind bereits vorinstalliert und eingerichtet.
    - Das Verzeichnis, auf das der Webserver schaut ist ```/home/{username}/htdocs```, das aber ein Symlink auf das Verzeichnis ```/opt/var/bitnami/apache2/htdocs``` ist. 
    - Der Webserver kann nicht mit dem ```systemctl```-Befehl neu gestartet werden. Informationen zum Starten/Stoppen: https://docs.bitnami.com/virtual-machine/infrastructure/lamp/administration/control-services/. 
Die VM war allerdings so konfiguriert, dass man mit ```systemctl restart bitnami``` alle Services, die den LAMP-Stack betreffen, neu starten kann.

Man bekommt ein A4-Blatt mit allen notwendigen Zugangsdaten.
Es wird nur gewertet, was am Ende der Prüfung vom Webserver bereitgestellt wird!
Für die Datenbank-Verbindung wurde uns freigestellt, ob wir PDO oder MySQLi verwenden.


### :speech_balloon: Fachgespräche

Man wird während des Programmierteils zum Fachgespräch geholt, dieses finden in einem anderen Raum statt. Je nach Anzahl der Kandidaten, kann es sein, dass die Fachgespräche schon vor der Mittagspause starten. In der Regel ist die Reihenfolge in der man drankommt nach Alphabet.

