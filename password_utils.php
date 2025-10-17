<?php
/**
 * Password utility functions for MediBook Ghana
 * Provides secure password hashing and verification
 */

/**
 * Hash a password using PHP's password_hash function
 * 
 * @param string $password The plain text password to hash
 * @return string The hashed password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verify a password against a hash
 * 
 * @param string $password The plain text password to verify
 * @param string $hash The hashed password to check against
 * @return bool True if password matches, false otherwise
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Check if a password needs rehashing
 * 
 * @param string $hash The current password hash
 * @return bool True if password should be rehashed
 */
function passwordNeedsRehash($hash) {
    return password_needs_rehash($hash, PASSWORD_DEFAULT);
}
?>