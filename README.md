Baza de date: MySQL

---
Software de instalat:
 - Xampp (https://www.apachefriends.org/ro/index.html) (Xampp trebuie inainte de Composer)
 - Composer (https://getcomposer.org/)
 - Git for Windows (https://gitforwindows.org/)

----
1. Se intra in phpmyadmin (http://localhost/phpmyadmin/) si se creeaza o baza de date avand numele 'collab'.

----

2. Proiectul trebuie instalat in fisierul 'htdocs' din Xampp. (.\xampp\htdocs)
3. Deschidem git bash

4. >> git clone https://github.com/Ddelia/collab.git

5. >> cd collab

6. >> composer install

7. >> cp .env.example .env

8. >> php artisan key:generate

9. >> php artisan config:cache

10. >> php artisan migrate

11. >> php artisan db:seed

12. >>php artisan serve

------
Exista 3 utilizatori:

Delia - delia@yahoo.com - admin
Saga - saga@example.com- tester
Ana - ana@example.com - co-worker

Parola este: parola12
