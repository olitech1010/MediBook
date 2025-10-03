# MediBook Ghana - Healthcare Appointment System

**MediBook Ghana** is a comprehensive healthcare appointment booking system designed specifically for Ghana's healthcare landscape. Built with PHP, HTML, and CSS, this platform connects patients with qualified doctors across Ghana's major cities including Accra, Kumasi, Tamale, and Cape Coast.

This system facilitates seamless online appointment booking for patients seeking healthcare services from verified medical professionals. The platform helps doctors manage their practice efficiently while providing patients with easy access to quality healthcare services.

## Features

### Admin Dashboard
- Manage doctors across Ghana's healthcare network
- Add, edit, and delete doctor profiles
- Schedule and manage doctor sessions
- View patient details and appointment statistics
- Monitor system-wide appointment bookings

### Doctor Portal
- View and manage patient appointments
- Schedule availability and sessions
- Access patient medical information
- Manage account settings and profile
- Track appointment history

### Patient Portal
- Browse qualified doctors by specialty and location
- Book appointments online with ease
- View appointment history and upcoming bookings
- Manage personal health records
- Access healthcare services across Ghana

## Technology Stack

- **Backend**: PHP 7.3+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Server**: Apache (via PHP built-in server)
- **Styling**: Custom CSS with Ghana-inspired color scheme

## Installation & Setup

### Prerequisites
- PHP 7.3 or higher
- MySQL/MariaDB database
- Web server (Apache/Nginx) or PHP built-in server

### Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-repo/medibook-ghana.git
   cd medibook-ghana
   ```

2. **Database Setup**
   - Create a MySQL database named `edoc`
   - Import the database schema
   - Run the Ghana-specific updates:
   ```sql
   mysql -u root -p edoc < ghana_database_update.sql
   ```

3. **Configure Database Connection**
   - Update `connection.php` with your database credentials
   - Default configuration uses port 3307 for MAMP

4. **Start the Application**
   ```bash
   php -S localhost:8000
   ```

5. **Access the Application**
   - Open your browser and navigate to `http://localhost:8000`

## Default Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@medibookghana.com | 123 |
| Doctor | doctor@medibookghana.com | 123 |
| Patient | patient@medibookghana.com | 123 |

## Ghana-Specific Features

### Healthcare Network
- Coverage across major Ghanaian cities
- Support for local medical specialties
- Integration with Ghana's healthcare system
- Localized medical terminology

### Medical Specialties
- General Practice & Family Medicine
- Tropical Medicine & Infectious Diseases
- Malaria & Tropical Diseases
- Maternal & Child Health
- Community Health
- Traditional Medicine Integration

### Localized Content
- Ghanaian doctor and patient names
- Local addresses and contact information
- Ghana-specific medical specialties
- Cultural considerations in healthcare delivery

## Database Schema

The system uses the following main tables:
- `admin` - System administrators
- `doctor` - Doctor profiles and credentials
- `patient` - Patient information and records
- `appointment` - Booking records
- `schedule` - Doctor availability and sessions
- `specialties` - Medical specialties (including Ghana-specific ones)
- `webuser` - User type mapping and authentication

## Security Features

- Session-based authentication
- Role-based access control
- Input validation and sanitization
- Secure database connections
- Password protection for all user accounts

## Contributing

We welcome contributions to improve MediBook Ghana. Please:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source and available under the MIT License.

## Support

For support and questions:
- Email: support@medibookghana.com
- Documentation: [Link to documentation]
- Issues: [GitHub Issues Page]

## Acknowledgments

- Built for Ghana's healthcare system
- Inspired by the need for accessible healthcare technology
- Designed with local healthcare providers and patients in mind

---

**MediBook Ghana** - Empowering healthcare across Ghana 🇬🇭
