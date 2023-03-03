Projekt bei VSC laufen

Schritt 1 => composer install

Schritt 2 => npm install

Schritt 3 => php artisan key:generate

Schritt 4 => php artisan jwt:secret

Schritt 5 => php artisan migrate

Schritt 6 => php artisan serve

Schritt 7 => npm run watch

Schritt 8 => npm run production (run nur für produktion)


< == Vue ==>

Vue routes => resources > js > routes.js
Vue plugins => reources > js > plugins
all vue package like axios, vue router, other components are imported in app.js
Vue main component (App.vue) => resources > js > App.vue
all vue pages => resources > js > pages > frontend

< == Laravel == >

REST api => routes > api.php
Migrations file => database > migrations

<-- === Icon Quelle === -->
icons => https://fontawesome.com/
