<?php
// Script to check current database credentials
include("connection.php");

echo "<h2>Current Database Credentials</h2>";

try {
    // Check admin credentials
    $admin_result = $database->query("SELECT * FROM admin");
    if ($admin_result && $admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();
        echo "<h3>Admin:</h3>";
        echo "Email: " . $admin['aemail'] . "<br>";
        echo "Password: " . $admin['apassword'] . "<br><br>";
    }

    // Check doctor credentials
    $doctor_result = $database->query("SELECT * FROM doctor");
    if ($doctor_result && $doctor_result->num_rows > 0) {
        $doctor = $doctor_result->fetch_assoc();
        echo "<h3>Doctor:</h3>";
        echo "Email: " . $doctor['docemail'] . "<br>";
        echo "Name: " . $doctor['docname'] . "<br>";
        echo "Password: " . $doctor['docpassword'] . "<br><br>";
    }

    // Check patient credentials
    $patient_result = $database->query("SELECT * FROM patient");
    if ($patient_result && $patient_result->num_rows > 0) {
        echo "<h3>Patients:</h3>";
        while ($patient = $patient_result->fetch_assoc()) {
            echo "Email: " . $patient['pemail'] . "<br>";
            echo "Name: " . $patient['pname'] . "<br>";
            echo "Password: " . $patient['ppassword'] . "<br><br>";
        }
    }

    // Check webuser table
    $webuser_result = $database->query("SELECT * FROM webuser");
    if ($webuser_result && $webuser_result->num_rows > 0) {
        echo "<h3>Web Users:</h3>";
        while ($webuser = $webuser_result->fetch_assoc()) {
            echo "Email: " . $webuser['email'] . " | Type: " . $webuser['usertype'] . "<br>";
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$database->close();
?>
