# Task 2
Zadanie 2: Walidacja numeru PESEL
Opis:
Napisz program, który będzie walidować numer PESEL zgodnie z oficjalnym algorytmem walidacyjnym. Program powinien mieć funkcję walidującą oraz zestaw testów jednostkowych.
Wskazówki:
Testy jednostkowe powinny uwzględniać kilka nieprawidłowych danych oraz przynajmniej jeden poprawny numer PESEL.
Możesz skorzystać z dostępnych w sieci źródeł opisujących specyfikację numeru PESEL.
Oczekiwany czas realizacji: 2 godziny.

# Setup
## Run docker
```
docker compose up -d --build
```

## Run tests
```
docker exec -it contelizer_task1_php composer test
```
