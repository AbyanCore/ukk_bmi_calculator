# 🏥 SehatIdeal BMI Calculator

![SehatIdeal BMI Calculator](app-banner.png)

A web-based BMI (Body Mass Index) calculator with real-time height measurement integration. This application helps users track their health metrics and maintain a healthy weight through automated measurements and visual progress tracking.

### 📝 Overview
SehatIdeal is designed for educational institutions and health facilities to monitor and track BMI measurements efficiently. The system incorporates:
- 📏 Automated height measurements using ultrasonic sensors
- 📱 Real-time data synchronization via MQTT
- 📈 Visual progress tracking and reporting
- 👥 Multi-user support with role-based access
- 🔄 Automated BMI and ideal weight calculations

### 🎯 Purpose
- Streamline health monitoring in schools and institutions
- Provide accurate and automated measurements
- Enable data-driven health tracking
- Promote health awareness through visual feedback

## ✨ Features
- 📊 BMI calculation with real-time height sensor
- 👥 User data management
- 🖼️ Progress visualization gallery
- 📡 MQTT integration for automated measurements

## 📁 Project Structure
```
/public/         # Static & uploaded files
/src/
  /fragments/    # Reusable components 
  /repository/   # Data access layer
  /utils/        # Helper functions
  /views/        # Pages & actions
index.php        # Entry point
```

## 🔧 Setup Requirements
- 🐳 Docker & Docker Compose
- 🔄 Git

## 🚀 Installation Steps
1. Clone repository:
   ```bash
   git clone <repository-url>
   cd bmi
   ```

2. Create Docker Compose configuration (skip if using this repository):
   ```yaml
   version: '3.8'
   services:
     app:
       build: .
       ports:
         - "80:80"
       volumes:
         - .:/var/www/html
       depends_on:
         - db
         - emqx

     db:
       image: mysql:8.0
       environment:
         MYSQL_ROOT_PASSWORD: letmein
         MYSQL_DATABASE: ukk_bmi_db
       ports:
         - "3306:3306"
       volumes:
         - mysql_data:/var/lib/mysql

     emqx:
       image: emqx/emqx:5.0
       ports:
         - "1883:1883"
         - "8083:8083"
         - "8084:8084"
         - "8883:8883"
         - "18083:18083"

   volumes:
     mysql_data:
   ```

3. Start services:
   ```bash
   docker-compose up -d
   ```

4. Database will initialize automatically through `src/utils/db.php`

5. Access application:
   - Web app: http://localhost (default: admin/admin)
   - MQTT WebSocket: ws://localhost:8083/mqtt
   - EMQX Dashboard: http://localhost:18083 (default: admin/public)

## 🛠️ Core Components

### 📊 Dashboard
- User data management interface
- Real-time height measurement
- BMI calculation features
- CRUD operations for records

### 🖼️ Gallery
- Visual BMI progress tracking
- User photos display
- Progress indicators
- Status visualization

### 🔐 Authentication
- Login/logout functionality
- Session management
- Role-based access (admin, guru, siswa, lainnya)

### 💾 Data Management
- File upload handling
- Photo management
- BMI calculations
- Progress tracking

## 🔒 Security Measures
- Input validation and sanitization
- Session-based authentication
- Secure file upload restrictions
- SQL injection prevention (prepared statements)

## 🔌 API Endpoints

### 👤 User Management
- `signin.php`: User authentication
- `signout.php`: Session termination
- `get_user.php`: Fetch user details

### ⚖️ BMI Operations
- `add_userbmi.php`: Create new records
  - Handles file uploads
  - Calculates BMI and ideal weight
- `update_userbmi.php`: Update existing records
  - Modifies user data
  - Updates BMI calculations
- `load_userbmi.php`: Retrieve records
  - Fetches user and BMI data
  - Returns JSON response
- `delete_user.php`: Remove records

## ⚠️ Error Handling
- Form validation errors
- File upload restrictions
- Database operation failures
- MQTT connection issues

## 🌐 Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## 📜 License
MIT License - See LICENSE file for details
