Baza de date: MySQL

---
Software de instalat:
 - Xampp (https://www.apachefriends.org/ro/index.html)
 - Composer (https://getcomposer.org/)
 - Git for Windows (https://gitforwindows.org/)

----
Se intra in phpmyadmin (http://localhost/phpmyadmin/) si se creeaza o baza de date avand numele 'collab'.

----

1. Proiectul trebuie instalat in fisierul 'htdocs' din Xampp. (.\xampp\htdocs)
2. Deschidem git bash
3. >> git clone https://github.com/Ddelia/collab.git
4. >> cd collab
5. >> composer install
6. >> cp .env.example .env
7. >> php artisan key:generate
7. >> php artisan config:cache
8. >> php artisan migration
9.>> php artisan db:seed
10. >>php artisan serve

Exista 3 utilizatori:

Delia - delia@yahoo.com - admin
Saga - saga@example.com- tester
Ana - ana@example.com - co-worker

Parola este: parola12
