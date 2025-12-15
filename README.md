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

## 🔒 Auth Approach

This project uses **Laravel Sanctum** for API authentication and **middleware** to protect secured routes.

* Users authenticate using Sanctum and receive a **Bearer token** after successful login.
* Protected routes are guarded using the `auth:sanctum` middleware.

### Role-Based Access Control

* Each user is assigned a **role**.
* Access to the **admin dashboard and admin features** is restricted to users with:

```
role_id = 1 (Admin)
```

* Role checks are enforced on the backend to prevent unauthorized access.

### Frontend Security

* User details and other detailsare **encrypted** and stored in **localStorage**.
* The authentication token is sent with every protected API request.



## 🖼️ Image Handling Approach

* Images are uploaded from the frontend in **Base64 format**.
* On the backend, images are **decoded and stored in the Laravel `public` directory**.

### Secure Image Access

* When accessing images, the backend generates a **temporary (signed) URL** to control access.
* This prevents direct public exposure of image files and improves security.

### Cloud Storage Support

* **AWS S3 upload support** is also implemented and available in the codebase.
* The S3 implementation is currently **commented out**, but includes:

  * File upload to S3
  * Generation of **temporary signed URLs** for secure access



## 🏗️ Key Architectural Decisions

* **Scalable State Management (Frontend)**
  Implemented centralized React state management to support application scalability and predictable data flow.

* **Reusable UI Architecture**
  Used shared components and common layouts to improve UI reusability, maintainability, and consistency across the application.

* **Repository-Based Backend Architecture**
  Implemented a repository pattern in the backend to separate business logic from controllers, improving testability and code organization.

* **Role-Based Authentication & Authorization**
  Implemented role-based access control.
  This design allows future extension to **permission-based access control** for finer-grained authorization.

* **Cloud-Ready File Management**
  Implemented AWS S3 file upload support for scalable and secure file storage, with the ability to switch between local and cloud storage.


## 👤 Author

**Nishan Sanjeewa**

