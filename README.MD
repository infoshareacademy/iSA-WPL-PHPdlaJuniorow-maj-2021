###### Uruchomienie aplikacji
1. Pobierz aplikację z repozytorium : `git clone ...`
2. W konsloi basha uruchom polecenie docker-compose up
3. Za pomocą jakiegokolwiek IDE które daje możliwość podłączenia się do postgres, utwórz potrzebne bazy danych
    * `HOST:postgres , PORT:5454, USER:root, PASSWORD:root`
    * Nazwy baz danych appOne , appTwo, appThree
4. W konsoli zaloguj się na kontener PHPa (oczywiście z katalogu zawierającego docker-composa)
   `docker-compose run --user=www-data php bash`
5. Wejdź do katalogu aplikacji która Ciebie interesuje a następnie uruchom polecenie
   `vendor/bin/phinx migrate -e development` - to polecenie zbuduje strukture bazy danych danej aplikacji
   
###### Przydatne porty 

- localhost:8080 - App1
- localhost:8081 - App2
- localhost:8082 - App3

###### Usługi dostępne pod hostami 
- sss

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


