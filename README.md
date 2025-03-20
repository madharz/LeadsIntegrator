LeadsIntegrator це простий веб-додаток для створення та відстеження статусів лідів через API.

Проєкт розгорнутий на DigitalOcean:
http://209.38.233.101/

Функціонал:
* Форма для створення ліда з обов’язковими полями:  
- Ім'я (firstName)  
- Прізвище (lastName)  
- Телефон (phone)  
- Email

* Встановлення та запуск локально  
Клонуйте репозиторій:
git clone https://github.com/madharz/LeadsIntegrator.git
cd LeadsIntegrator

* Встановіть залежності
composer install

Зпустіть локальний сервер:
php -S localhost:8000 -t public


