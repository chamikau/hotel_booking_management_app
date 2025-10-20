# Hotel Booking Management App

This repository contains a **Hotel Booking Management System** with a **Frontend (Vue.js)** and **Backend (Laravel)**. All development and local setup instructions are based on the `develop` branch.

---

## Branch to Use

Use the `develop` branch for **local development**:
git checkout develop
git pull origin develop

**Backend Setup (Laravel)**
	
**step 01**	

cd hotel-booking-app-backend
**step 02**
	
composer install
	
**step 03**	
	
cp .env.example .env
	
**step 04**
	
php artisan migrate --seed
	
**step 05**
	
php artisan serve

**Frontend Setup (Vue.js)**

**step 01**	
	
cd hotel-booking-app-frontend
	
**step 02**
	
npm install
	
**step 03**
	
npm run serve


