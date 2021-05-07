###### Uruchomienie aplikacji WINDOWS (wymagana konsola bash poprzez instalacje np ubuntu w windowsie)
1. Pobierz aplikację z repozytorium : `git clone ...`
2. cd ifa
3. chmod -R 755 composer_cache
4. docker-compose build
5. sudo usermod -a -G www-data 'whoami' (polecenie whoami pokazuje aktualnego uzytkownika bash)
6. sudo chmod 755 apps/ 
7. sudo chown -R www-data apps/
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

### Problemy na windowsiwe
Desktop dokcer / wsl2 / kernela linuxa
https://docs.docker.com/docker-for-windows/wsl/

sudo groupadd docker
sudo usermod -aG docker $USER
su -s ${USER}

 