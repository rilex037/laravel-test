# LoanLink CRM

Tool for financial advisers to manage clients, cash/home loans, and reports.

## Start Without Docker

1. **Install**
   - Need: PHP 8.4, Composer, Node.js 22, MySQL/MariaDB.
   ```bash
   composer install
   npm install
   ```

2. **Setup**
   - Copy `.env.example` to `.env`, edit:
     ```env
     APP_URL=http://localhost:8000
     DB_HOST=127.0.0.1
     DB_DATABASE=loanlink
     DB_USERNAME=your_user
     DB_PASSWORD=your_pass
     ```
   - Generate key:
     ```bash
     php artisan key:generate
     ```

3. **Database**
   - Create `loanlink` database.
   - Run:
     ```bash
     php artisan migrate
     php artisan db:seed
     ```

4. **Run**
   ```bash
   php artisan serve  # Port 8000
   npm run dev        # Port 3000, separate terminal
   ```
   - Go to `http://localhost:8000`.

## Start With Docker

1. **Setup**
   - Need: Docker, Docker Compose.
   - Copy `.env.example` to `.env`, edit:
     ```env
     APP_URL=http://localhost:8080
     DB_HOST=db
     DB_DATABASE=loanlink
     DB_USERNAME=loanlink
     DB_PASSWORD=secret
     ```
   - Generate key:
     ```bash
     php artisan key:generate
     ```

2. **Run**
   ```bash
   make start
   make migrate
   make seed
   ```
   - Go to `http://localhost:8080`.
   - Stop: `make stop`.

## Notes
- Default login: `john@example.com`, `password` (if seeded).
- Ports: 8000/8080 (app), 3000 (Vite), 3306 (DB).
- Loans in cents, displayed as €.
