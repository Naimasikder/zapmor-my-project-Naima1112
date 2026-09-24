# Zapmor - Healthcare Appointment Management System

## Project Overview

Zapmor is a web-based healthcare appointment management system developed using Laravel, PHP, and MySQL. The system is designed to help users register, log in, and manage doctor appointments through an easy-to-use web interface.

## My Contributions

I worked on the following features and functionalities of the project:

### 1. Authentication System
* Implemented user registration.
* Implemented user login and logout.
* Added authentication using Laravel Auth.
* Added session regeneration after login.
* Added secure session invalidation during logout.
* Added validation for registration and login forms.
* Prevented duplicate email registration.
* Automatically logged in users after successful registration.

### 2. User Role Management
* Added a `role` field to the users table.
* Added `patient` as the default user role.
* Added `admin` role support.
* Implemented role-based access control for admin users.

### 3. Doctor Appointment Booking
* Implemented doctor appointment booking functionality.
* Connected appointments with users, doctors, and services.
* Added appointment date and time selection.
* Added appointment notes.
* Set newly booked appointments to `pending` status.
* Added validation for appointment information.

### 4. Appointment Validation
Implemented validation to ensure:

* Appointment date cannot be in the past.
* Selected doctor must exist and be active.
* Selected service must exist and be active.
* Patient email must match the logged-in account.
* Required appointment information must be provided.
* The same doctor cannot have multiple active appointments at the same date and time.
* Cancelled appointment time slots can be booked again.

### 5. Patient Appointment Management
* Created the "My Appointments" functionality.
* Patients can view their own appointments.
* Displayed doctor, service, date, time, and appointment status.
* Added appointment search functionality.
* Added appointment cancellation.
* Restricted patients so they can only manage their own appointments.

### 6. Appointment Status Management
Implemented appointment status management with the following statuses:

* Pending
* Confirmed
* Cancelled
* Completed
Patients can cancel their appointments, while administrators can update appointment statuses.

### 7. Admin Appointment Management
* Created an admin appointment dashboard.
* Displayed all patient appointments.
* Displayed patient information.
* Displayed doctor and service information.
* Displayed appointment date and time.
* Displayed appointment status.
* Added functionality to update appointment status.
* Added support for confirming, cancelling, and completing appointments.

### 8. Admin Middleware
* Created custom `AdminMiddleware`.
* Protected admin routes from unauthorized users.
* Allowed only users with the `admin` role to access the admin appointment section.
* Added authentication checks for protected admin routes.

### 9. Database Development
Worked on the database structure required for the appointment management system.

* Added user role migration.
* Worked with the `appointments` table.
* Connected appointments with users.
* Connected appointments with doctors/providers.
* Connected appointments with services.
* Implemented Eloquent model relationships.
* Added appointment status management in the database.

### 10. Doctor and Service Integration
* Integrated doctors/providers with the appointment booking system.
* Integrated services with appointments.
* Added active doctor and service verification.
* Added doctor information retrieval for the booking system.

### 11. Frontend Development
Worked on the frontend interfaces related to my features.

* Created and styled the registration page.
* Worked on the login interface.
* Added Login/Register navigation.
* Added Logout functionality to the navigation.
* Created and styled the Admin Appointment page.
* Added appointment status badges.
* Added responsive styling for the admin appointment table.
* Added navigation between relevant pages.

### 12. Laravel Routes and Controllers
* Added and updated routes for authentication.
* Added appointment booking routes.
* Added appointment listing routes.
* Added appointment cancellation routes.
* Added doctor data routes.
* Added admin appointment routes.
* Developed and updated controllers for authentication and appointment management.

### Technologies Used
* Laravel 12
* PHP
* MySQL
* Blade
* HTML
* CSS
* JavaScript
* Git
* GitHub
