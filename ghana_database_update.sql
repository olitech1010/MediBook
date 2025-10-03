-- Ghana-specific database updates for MediBook Ghana
-- Run these queries to update existing data with Ghana-specific information

-- Update admin credentials
UPDATE `admin` SET `aemail` = 'admin@medibookghana.com' WHERE `aemail` = 'admin@edoc.com';

-- Update doctor information
UPDATE `doctor` SET 
    `docemail` = 'doctor@medibookghana.com',
    `docname` = 'Dr. Kwame Asante',
    `docnic` = 'GHA123456789',
    `doctel` = '+233241234567'
WHERE `docemail` = 'doctor@edoc.com';

-- Update patient information
UPDATE `patient` SET 
    `pemail` = 'patient@medibookghana.com',
    `pname` = 'Ama Serwaa',
    `paddress` = 'Accra, Greater Accra',
    `pnic` = 'GHA987654321',
    `pdob` = '1990-05-15',
    `ptel` = '+233241234567'
WHERE `pemail` = 'patient@edoc.com';

-- Add more Ghana-specific doctors
INSERT INTO `doctor` (`docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
('dr.akosua.mensah@medibookghana.com', 'Dr. Akosua Mensah', '123', 'GHA234567890', '+233241234568', 5),
('dr.kofi.adjei@medibookghana.com', 'Dr. Kofi Adjei', '123', 'GHA345678901', '+233241234569', 18),
('dr.abena.owusu@medibookghana.com', 'Dr. Abena Owusu', '123', 'GHA456789012', '+233241234570', 32);

-- Add more Ghana-specific patients
INSERT INTO `patient` (`pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
('kwame.boateng@gmail.com', 'Kwame Boateng', '123', 'Kumasi, Ashanti Region', 'GHA456789123', '1985-12-03', '+233241234568'),
('efua.ansah@gmail.com', 'Efua Ansah', '123', 'Tamale, Northern Region', 'GHA567890234', '1992-08-20', '+233241234569'),
('kojo.mensah@gmail.com', 'Kojo Mensah', '123', 'Cape Coast, Central Region', 'GHA678901345', '1988-03-10', '+233241234570');

-- Update webuser table
UPDATE `webuser` SET `email` = 'admin@medibookghana.com' WHERE `email` = 'admin@edoc.com';
UPDATE `webuser` SET `email` = 'doctor@medibookghana.com' WHERE `email` = 'doctor@edoc.com';
UPDATE `webuser` SET `email` = 'patient@medibookghana.com' WHERE `email` = 'patient@edoc.com';

-- Add new webuser entries for new doctors and patients
INSERT INTO `webuser` (`email`, `usertype`) VALUES
('dr.akosua.mensah@medibookghana.com', 'd'),
('dr.kofi.adjei@medibookghana.com', 'd'),
('dr.abena.owusu@medibookghana.com', 'd'),
('kwame.boateng@gmail.com', 'p'),
('efua.ansah@gmail.com', 'p'),
('kojo.mensah@gmail.com', 'p');

-- Update specialties with Ghana-specific medical specialties
UPDATE `specialties` SET `sname` = 'General Practice & Family Medicine' WHERE `id` = 18;
UPDATE `specialties` SET `sname` = 'Tropical Medicine & Infectious Diseases' WHERE `id` = 22;

-- Add Ghana-specific specialties
INSERT INTO `specialties` (`id`, `sname`) VALUES
(57, 'Malaria & Tropical Diseases'),
(58, 'Maternal & Child Health'),
(59, 'Community Health'),
(60, 'Traditional Medicine Integration');

-- Update schedule with Ghana-specific sessions
UPDATE `schedule` SET `title` = 'General Consultation - Accra' WHERE `scheduleid` = 1;
UPDATE `schedule` SET `scheduledate` = '2024-12-20' WHERE `scheduleid` = 1;

-- Add more Ghana-specific schedules
INSERT INTO `schedule` (`docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
('2', 'Cardiology Consultation - Kumasi', '2024-12-21', '09:00:00', 20),
('3', 'Family Medicine - Tamale', '2024-12-22', '14:00:00', 25),
('4', 'Gynecology Clinic - Accra', '2024-12-23', '10:00:00', 15);
