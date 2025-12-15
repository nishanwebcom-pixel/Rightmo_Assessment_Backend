# Rightmo Assessment – Backend

This repository contains the backend implementation for the **Rightmo Assessment**, built using **Laravel**. It provides API endpoints and database seed data required to run the application locally.

## 🚀 Setup Instructions

Follow the steps below to set up the project locally.

### 1. Clone the Repository

```bash
git clone https://github.com/nishanwebcom-pixel/Rightmo_Assessment_Backend.git
cd Rightmo_Assessment_Backend
```

---

### 2. Configure Environment File

Rename the example environment file:

```bash
cp .env.example .env
```

---

### 3. Install Dependencies

```bash
composer install
```

---

### 4. Update Environment Variables

Open the `.env` file and update your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rightmo_assessment
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

---

### 5. Create Database

Create a database in your MySQL server:

### 7. Run Migrations

```bash
php artisan migrate
```

---

### 8. Seed the Database

```bash
php artisan db:seed
```

---

### 9. Start the Development Server

```bash
php artisan serve
```

The application will be available at:

```
http://127.0.0.1:8000
```

---

## 📮 API Testing (Postman)

You can test all available API endpoints using the provided Postman collection.

**Postman Collection Link:**

```
https://github.com/nishanwebcom-pixel/Rightmo_Assessment_Backend/blob/main/Assessment.postman_collection.json
```
## 👤 Author

**Nishan Sanjeewa**
