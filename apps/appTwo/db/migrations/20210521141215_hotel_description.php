<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class HotelDescription extends AbstractMigration
{
    public function change(): void
    {
        $this->execute(<<<SQL
            CREATE TABLE hotel_description
            (
                identifier VARCHAR(32) NOT NULL CONSTRAINT hotel_description_pk PRIMARY KEY,
                name VARCHAR(64) not null,
                description VARCHAR(512) not null
            );

            INSERT INTO
                public.hotel_description (identifier, name, description)
            VALUES
                ('HOT29839', 'Oz Side Premium', 'Nowoczesny, komfortowy hotel doskonale zlokalizowany w pobliżu pięknej piaszczystej plaży w niedużej odległości od starożytnego Side. Na terenie hotelu Goście znajdą wszystko, co potrzeba do wygodnego wypoczynku, a w zasięgu ręki znajdują się liczne bazary oraz przepiękna nadmorska promenada. Hotel spodoba się zarówno parom, jak i rodzinom z dziećmi. Jest idealny dla osób, którym zależy na luksusowych wakacjach.'),
                ('HOT18932', 'Mitsis Blue Domes Resort', 'Zachwyca widokami i różnorodnością restauracji a la carte, serwujących specjały z całego świata. Hotel położony w spokojnej okolicy, na obrzeżach Kardameny, urzeka luksusowymi pokojami i obsługą na najwyższym poziomie.'),
                ('HOT10715', 'Mitsis Rodos Village', 'Elegancki hotel na wzniesieniu i tarasy słoneczne z widokiem na morze. Wyśmienita kuchnia, wysoko oceniana obsługa i serwis. Szereg atrakcji dla dzieci, dobrze zagospodarowana plaża. Cóż więcej potrzeba do idealnych wakacji? '),
                ('HOT16435', 'Jaz Lamaya Resort', 'Rozległy, komfortowy, w stylu mauretańsko-egipskim, oferuje znakomity standard i świetną obsługę. Najładniejsze w okolicy, fantazyjne origami z ręczników! Pięknie położony w prywatnej zatoce, z bezpośrednim dostępem do rafy koralowej, gdzie żyją piękne i wspaniale pozujące do zdjęć okazy morskiej fauny.'),
                ('HOT21599', 'Maxx Royal', 'Elegancki hotel usytuowany bezpośrednio przy piaszczystej plaży. Zapewnia najwyższy poziom usług dla całej rodziny: minilunapark i Dino Land dla dzieci oraz bogaty pakiet zabiegów relaksacyjnych w SPA dla dorosłych.'),
                ('HOT5435', 'Fort Arabesque', 'Hotel położony jest na rozległym terenie z pięknym zielonym ogrodem w spokojnej okolicy popularnego kurortu turystycznego Hurghada, w zatoce Makadi. Bliskość szerokiej, piaszczystej plaży z dostępem do rafy koralowej będzie szczególną atrakcją dla miłośników sportów wodnych w tym nurkowania, nurkowania z rurką i windsurfingu.'),
                ('HOT34189', 'Turunc Dream', 'Dobry wybór dla podróżnych odwiedzających Turcję. Zapewnia przyjazny dla rodzin nastrój oraz wiele przydatnych udogodnień, które sprawią, że pobyt w tym hotelu będzie jeszcze lepszy.'),
                ('HOT14059', 'Calista Luxury Resort', 'Hotel Calista Luxury Resort to nowoczesny i komfortowy obiekt położony tuż przy szerokiej, piaszczysto-żwirowej plaży. Na gości czeka tu 7 restauracji serwujących dania kuchni włoskiej, lokalnej i azjatyckiej oraz 9 barów. Dla najmłodszych przygotowano bogaty program animacyjny oraz plac zabaw.'),
                ('HOT16078', 'Cefalu Sea Palace', 'Luksus w połączeniu z topowym włoskim dizajnem! Komfort i funkcjonalność, nowoczesna estetyka wnętrz, wspaniale dobrana kolorystyka i wyszukane akcesoria. Tylko 10 minut spacerem nadmorską promenadą od centrum romantycznego Cefalu z jego urokliwymi zabytkami, świetnymi i klimatycznymi restauracjami, niezliczonymi barami i sklepami, w tym oczywiście słynnych włoskich kreatorów mody.'),
                ('HOT6494', 'White City Beach', '4-gwiazdkowy Hotel White City Beach położony jest tuż przy piaszczysto-żwirowej plaży. Na terenie obiektu znajdziecie ponadto amfiteatr oraz dwa baseny - kryty, znajdujący się w strefie wellness oraz zewnętrzny ze zjeżdżalniami. Miłym urozmaiceniem pobytu będzie ciekawa oferta rozrywkowa lub zabiegi dostępne w hotelowej strefie spa & wellness.');
        SQL);
    }
}
