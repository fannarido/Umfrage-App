Projekt bei VSC laufen

Schrit 1 => composer install

Schrit 2 => npm install

Schrit 3 => php artisan key:generate

Schrit 4 => php artisan jwt:secret

Schrit 5 => php artisan migrate

Schrit 6 => php artisan serve

Schrit 7 -> npm run watch

Schrit 8 => npm run production (run nur für produktion)


< == Vue ==>

Vue routes => resources > js > routes.js
Vue plugins => reources > js > plugins
all vue package like axios, vue router, other components are imported in app.js
Vue main component (App.vue) => resources > js > App.vue
all vue pages => resources > js > pages > frontend

< == Laravel == >

REST api => routes > api.php
Migrations file => database > migrations

<-- === websites i used === -->
icons => https://fontawesome.com/
