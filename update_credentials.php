<?php
// Script to update database credentials for MediBook Ghana
include("connection.php");

echo "<h2>Updating MediBook Ghana Credentials...</h2>";

try {
    // Update admin credentials
    $update_admin = $database->query("UPDATE admin SET aemail = 'admin@medibookghana.com' WHERE aemail = 'admin@edoc.com'");
    if ($update_admin) {
        echo "✓ Admin email updated successfully<br>";
    } else {
        echo "✗ Failed to update admin email<br>";
    }

    // Update doctor credentials
    $update_doctor = $database->query("UPDATE doctor SET docemail = 'doctor@medibookghana.com', docname = 'Dr. Kwame Asante' WHERE docemail = 'doctor@edoc.com'");
    if ($update_doctor) {
        echo "✓ Doctor credentials updated successfully<br>";
    } else {
        echo "✗ Failed to update doctor credentials<br>";
    }

    // Update patient credentials
    $update_patient = $database->query("UPDATE patient SET pemail = 'patient@medibookghana.com', pname = 'Ama Serwaa', paddress = 'Accra, Greater Accra' WHERE pemail = 'patient@edoc.com'");
    if ($update_patient) {
        echo "✓ Patient credentials updated successfully<br>";
    } else {
        echo "✗ Failed to update patient credentials<br>";
    }

    // Update webuser table
    $update_webuser_admin = $database->query("UPDATE webuser SET email = 'admin@medibookghana.com' WHERE email = 'admin@edoc.com'");
    $update_webuser_doctor = $database->query("UPDATE webuser SET email = 'doctor@medibookghana.com' WHERE email = 'doctor@edoc.com'");
    $update_webuser_patient = $database->query("UPDATE webuser SET email = 'patient@medibookghana.com' WHERE email = 'patient@edoc.com'");
    
    if ($update_webuser_admin && $update_webuser_doctor && $update_webuser_patient) {
        echo "✓ Webuser table updated successfully<br>";
    } else {
        echo "✗ Failed to update webuser table<br>";
    }

    // Verify the updates
    echo "<h3>Verification:</h3>";
    
    $admin_check = $database->query("SELECT * FROM admin WHERE aemail = 'admin@medibookghana.com'");
    if ($admin_check && $admin_check->num_rows > 0) {
        echo "✓ Admin login: admin@medibookghana.com / 123<br>";
    } else {
        echo "✗ Admin login not found<br>";
    }

    $doctor_check = $database->query("SELECT * FROM doctor WHERE docemail = 'doctor@medibookghana.com'");
    if ($doctor_check && $doctor_check->num_rows > 0) {
        echo "✓ Doctor login: doctor@medibookghana.com / 123<br>";
    } else {
        echo "✗ Doctor login not found<br>";
    }

    $patient_check = $database->query("SELECT * FROM patient WHERE pemail = 'patient@medibookghana.com'");
    if ($patient_check && $patient_check->num_rows > 0) {
        echo "✓ Patient login: patient@medibookghana.com / 123<br>";
    } else {
        echo "✗ Patient login not found<br>";
    }

    echo "<h3>Update Complete!</h3>";
    echo "<p>You can now login with the new credentials:</p>";
    echo "<ul>";
    echo "<li><strong>Admin:</strong> admin@medibookghana.com / 123</li>";
    echo "<li><strong>Doctor:</strong> doctor@medibookghana.com / 123</li>";
    echo "<li><strong>Patient:</strong> patient@medibookghana.com / 123</li>";
    echo "</ul>";
    echo "<p><a href='login.php'>Go to Login Page</a></p>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$database->close();
?>
