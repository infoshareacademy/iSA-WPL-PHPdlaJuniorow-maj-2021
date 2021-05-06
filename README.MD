###### Uruchomienie aplikacji
1. Pobierz aplikację z repozytorium : `git clone ...`
2. JEŻELI MASZ WINDOWSA:
   
    2.1 w katalogu projektu : sudo usermod -a -G www-data 'whoami'
   
    2.2 sudo chown root:root apps && sudo chmod 755 apps/
   
    2.3 sudo chown -R www-data apps/ && sudo chmod -R 744 apps/
   
3. W konsoli basha uruchom polecenie docker-compose up
4. Za pomocą jakiegokolwiek IDE które daje możliwość podłączenia się do postgres, utwórz potrzebne bazy danych
    * `HOST:localhost , PORT:5432, USER:root, PASSWORD:root`
    * Nazwy baz danych appOne , appTwo, appThree
5. W konsoli zaloguj się na kontener PHPa (oczywiście z katalogu zawierającego docker-composa)
   `docker-compose run --user=www-data php bash`
6. Wejdź do katalogu aplikacji która Ciebie interesuje a następnie uruchom polecenie
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


