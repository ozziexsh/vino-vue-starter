# Getting Started

3 repos are needed to run this locally since nothing is published to npm/composer yet.

- `vino-laravel` handles the routes / config
- `vino-js` handles the vue code and the vite plugin
- `vino-vue-starter` contains a starter application to test out everything

The `main` branch runs in `adjacent` mode (see `config/vino.php`), check out the branch `inline` to see how the vue files look with `inline` mode.

Adjacent mode was built to get pass the editor highlighting/autocomplete barrier. Instead of placing your php code inside `<php>` tags within vue, you just place a `.php` file directly next to the vue file with the same name to achieve the same result.

Here's a quick step-by-step to run this repo

```
mkdir vino
cd vino
git clone https://github.com/ozziexsh/vino-laravel.git
git clone https://github.com/ozziexsh/vino-js.git
git clone https://github.com/ozziexsh/vino-vue-starter.git
cd vino-laravel
composer install
cd ..
cd vino-js
npm i
npm link
cd ..
cd vino-vue-starter
composer install
npm i
npm link vino-vue
npm link vite-plugin-vino
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```
