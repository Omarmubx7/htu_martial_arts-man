# HTU Martial Arts Management System

A custom PHP web application for managing a martial arts gym. This system handles member registration, class scheduling, membership management, and instructor profiles.

## Technologies
- **Backend**: Native PHP 8+
- **Database**: MySQL 5.7+ (mysqli)
- **Frontend**: Bootstrap 5, Custom CSS
- **Server**: Apache / Nginx

## Setup & Installation

1.  **Database Configuration**:
    - Import `database/seed.sql` into your MySQL database to create the schema and initial data.
    - Rename `includes/db.php.example` to `includes/db.php` (if applicable) or edit `includes/db.php` directly.
    - Set the following environment variables (recommended) or update the fallback values in `includes/db.php`:
        - `DB_HOST`
        - `DB_USER`
        - `DB_PASS`
        - `DB_NAME`

2.  **Web Server**:
    - Point your web server document root to the project folder.
    - Ensure `Apache` (or your server) is configured to serve `.php` files.

## Project Structure

### Core Files
- `index.php`: Main landing page with Instructors and Membership plans.
- `login.php` / `signup.php`: User authentication and registration.
- `dashboard.php`: Member area for viewing stats and schedule.
- `book_class.php`: Logic for users to book specific class slots.
- `admin.php`: Administration panel.

### Database Schema
The system uses 5 main tables:
- **users**: Accounts for members and admins.
- **memberships**: Definitions for plans (Basic, Elite, etc.).
- **classes**: Weekly schedule definitions.
- **bookings**: Records of users attending specific classes.
- **instructors**: Profiles for the coaching team.

### Assets
- **Images**: Instructor images are in `images/`, matched by name (e.g., "Ali Mohammed.jpg").
- **Includes**: Header, footer, and database connection logic are in `includes/`.

## Users & Roles
- **Admins**: Can manage the system properties.
- **Members**: Can view schedules and book classes based on their membership tier.
