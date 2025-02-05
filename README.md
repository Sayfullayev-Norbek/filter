# 📦 Test uchun

Bu loyiha Laravelda qilingan
---

## ⚙️ O'rnatish Bo'yicha Qo'llanma

### 1. Repositoriyani Yuklab Olish

```bash
git clone https://github.com/Sayfullayev-Norbek/filter.git
cd filter
```

### 2. Muhitni Sozlash

`.env` faylini yarating:

```bash
cp .env.example .env
```

### 3. Paketlarni O'rnatish

```bash
composer install
```

### 4. Kesh va Konfiguratsiyani Yangilash

```bash
php artisan config:clear
php artisan cache:clear
```

### 5. Ma'lumotlar Bazasi Migratsiya va Seed

```bash
php artisan migrate --seed
```

### 6. Laravel Kalitini Yaratish

```bash
php artisan key:generate
```

### 7. Serverni Ishga Tushurish

```bash
php artisan serve
```

**URL:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 👥 Rollar 

### 🛡️ Admin
- Tizimdagi barcha funksiyalarga to'liq kirish huquqiga ega.


## ✨ Dastlabki Foydalanuvchilar

Seeder orqali yaratiladigan foydalanuvchilar ro'yxati:

| Rol        | Email               | Parol       |
|------------|---------------------|-------------|
| **Admin**  | admin1@example.com  | password123 |
| **Seller** | seller1@example.com | password123 |
| **User**   | user1@example.com   | password123 |
| **User2**  | user2@example.com   | password123 |

---

## 🗺️ Yo'nalishlar (Routes)

### Umumiy Yo'nalishlar
- **Foydalanuvchini ro'yxatdan o'tkazish:**
  ```http
  POST /api/register
  ```
  Foydalanuvchini ro'yxatdan o'tkazish uchun ishlatiladi.

- **Foydalanuvchini tizimga kirish:**
  ```http
  POST /api/login
  ```

### Himoyalangan Yo'nalishlar
Quyidagi yo'nalishlar `auth:api` middleware bilan himoyalangan:

- **Profilni ko'rish:**
  ```http
  GET /api/profile
  ```
  Foydalanuvchining profil ma'lumotlarini olish.

- **Tizimdan chiqish:**
  ```http
  POST /api/logout
  ```
  Foydalanuvchini tizimdan chiqarish.


- **Role ga qarab fayllarni korish:**
