Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lokal:

1. Clone Repository
   bash
   Salin
   Edit
   git clone https://github.com/your-username/project-name.git
   cd project-name
2. Salin File .env
   bash
   Salin
   Edit
   cp .env.example .env
   📌 Sesuaikan konfigurasi di file .env dengan environment lokal kamu, seperti database, mail, dll.

3. Install Dependency Backend (PHP)
   bash
   Salin
   Edit
   composer install
4. Install Dependency Frontend (Node.js)
   bash
   Salin
   Edit
   npm install
   Gunakan yarn install jika menggunakan Yarn.

5. Generate Key & Jalankan Migrasi Database
   bash
   Salin
   Edit
   php artisan key:generate
   php artisan migrate
6. Seed Database (Data Awal)
   bash
   Salin
   Edit
   php artisan db:seed
7. Jalankan Server Laravel
   bash
   Salin
   Edit
   php artisan serve
   Akses proyek di: http://localhost:8000
