Viral86
=======

A Laravel 12 application using Inertia + Vue 3, Vite and Tailwind CSS.

**Tech Stack**
- **Backend:** PHP 8.2, Laravel 12
- **Frontend:** Vue 3, Inertia.js
- **Build Tools:** Vite, laravel-vite-plugin
- **Styling:** Tailwind CSS
- **Icons & UI:** lucide-vue-next
- **HTTP:** axios
- **Background / Dev tools:** laravel/pail, laravel/sail, Laravel Pint
- **Testing:** PHPUnit

**Requirements**
- PHP ^8.2
- Composer
- Node.js (recommended 18+) and npm
- A database (SQLite used by default in many setups)

**Quick Setup**
1. Install PHP dependencies

```bash
composer install
```

2. Copy environment and generate app key

```bash
cp .env.example .env
php artisan key:generate
```

3. Run migrations

```bash
php artisan migrate
```

4. Install JS dependencies and build assets

```bash
npm install
npm run build
```

Or to run the full development stack (serves app, queue worker, logs, and Vite):

```bash
composer run dev
```

For a simple frontend-only dev server:

```bash
npm run dev
```

**Testing**

Run the test suite with:

```bash
composer run test
```

**Key files & folders**
- **Routes:** [routes/web.php](routes/web.php)
- **Controllers:** [app/Http/Controllers](app/Http/Controllers)
- **Models:** [app/Models](app/Models)
- **Views:** [resources/views/app.blade.php](resources/views/app.blade.php)
- **Frontend assets:** [resources/js](resources/js)

**Notes**
- This project uses Inertia to deliver a single-page application experience while keeping server-side routing and controllers.
- Use `laravel/pail` for background log streaming during development if available in your environment.

**License**

MIT
