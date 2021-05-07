Dla posiadaczy systemu windows proszę o zainstalowanie ubuntu 20.04 tak by docker mógł z niego korzystać
- https://docs.docker.com/docker-for-windows/wsl/
- https://stackoverflow.com/questions/63497928/ubuntu-wsl-with-docker-could-not-be-found

### Problemy na windowsiwe
https://docs.docker.com/docker-for-windows/wsl/

(Podczas builda mogą wystąpić problemy z permissionami, rozwiązaniem tych problemów są komendy poniżej)

- sudo groupadd docker
- sudo usermod -aG docker $USER
- su -s ${USER}

###### Uruchomienie aplikacji (wymagana konsola bash)
1. Pobierz aplikację z repozytorium : `git clone git@github.com:infoshareacademy/iSA-WPL-PHPdlaJuniorow-maj-2021.git`
2. `cd iSA-WPL-PHPdlaJuniorow-maj-2021`
3. `chmod -R 755 composer_cache`
4. `docker-compose build`
5. `sudo usermod -a -G www-data 'whoami'` (polecenie whoami pokazuje aktualnego uzytkownika bash)
6. `sudo chmod 755 apps/` 
7. `sudo chown -R www-data apps/`
8. W konsoli basha uruchom polecenie docker-compose up
9. Za pomocą jakiegokolwiek IDE które daje możliwość podłączenia się do postgres, utwórz potrzebne bazy danych
   * `HOST:localhost , PORT:5432, USER:root, PASSWORD:root`
   * Nazwy baz danych appOne , appTwo, appThree
10. W konsoli zaloguj się na kontener PHPa (oczywiście z katalogu zawierającego docker-composa)
   `docker-compose run --user=www-data php bash`
11. Wejdź do katalogu aplikacji która Ciebie interesuje a następnie uruchom polecenie
   `vendor/bin/phinx migrate -e development` - to polecenie zbuduje strukture bazy danych danej aplikacji
   
###### Przydatne porty 

- localhost:8080 - App1
- localhost:8081 - App2
- localhost:8082 - App3

###### Usługi dostępne pod hostami 
- Kibana - localhost:5601
- Elastic - localhost:9200
  **Z aplikacji łączymy się przy powyższym porcie ale po nazwie kontenera**
  
###### Zalogowanie się na maszyne PHP-a
- docker-compose run --user=www-data php bash

##### Użwyanie migracji bazodanowych
- `php vendor/bin/phinx migrate` uruchomienie migracji
- `php vendor/bin/phinx seed:create UserSeeder` - Utworzenie seeda
- `php vendor/bin/phinx seed:run` - Uruchomienie migracji


### Pingi
- http://localhost:8080/app-two/ping
- http://localhost:8080/app-three/ping
- http://localhost:8081/app-one/ping
- http://localhost:8081/app-three/ping
- http://localhost:8082/app-one/ping
- http://localhost:8082/app-two/ping

### Pobranie/dodanie userow z aplikacji 2
- POST http://localhost:8081/api/v1/users
`  {
   "firstname" : "Kamil",
   "lastname" : "Ziomkowski",
   "username" : "ziomeczek"
  }`
- GET http://localhost:8081/api/v1/users
- GET http://localhost:8081/api/v1/users/1

### Przydatne komendy 
- cp -r /home/<user>/<directory> /mnt/c - zamontowanie 
- docker exec -it 133da1450f8d php app/console.php sitemap  - Uruchomienie elementu bez wchodzenia na dockera 
- docker inspect eb6dfdda5ec4 | grep "IPAddress" - Znalezienie ip dockera
- docker exec -it cashbox_app_1 /bin/bash - Logowanie do dockera
- docker stop $(docker ps -a -q) - Wylaczenie wszystkich dzialajacych dockerow
- docker rm $(docker ps -a -q) - usuniecie wszystkid dockero
- docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' 8aa4cb7c6a02


 
