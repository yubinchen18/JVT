JVT
===

A Symfony project created on April 14, 2017, 1:17 pm.

Eerlijk gezegd heb ik niet zoveel ervaring met deployment van een applicatie, dus ik neem aan dat deze stappen wel kloppen
om de app in je lokale omgeving te kunnen draaien.

- git clone https://github.com/yubinchen18/JVT.git
- composer install
- edit database login parameters in app/config/parameters.yml
- run in terminal:
    -php bin/console doctrine:database:create
    -php bin/console doctrine:schema:create
    -php bin/console doctrine:migrations:migrate

Assuming you've got your local webserver up and running for to this app's folder
- open browser and go to to /clients from your path root?
    