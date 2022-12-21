<?php

// EDIT THESE
$host = 'localhost';
$user = 'root';
$pass = '';

// DONT EDIT
$db_name = 'testing_app';
$finishedOperations = false;

global $conn;

$conn = new MySQLi($host, $user, $pass );

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}


if (!$finishedOperations) {
    // Create DATABASE 
    
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";

if ($conn->query($sql) === TRUE) {
    $conn = new MySQLi($host, $user, $pass , $db_name);
    

    // USERS RATING TABLE
    $sqlUsersRating = "CREATE TABLE IF NOT EXISTS users_ratings (
    id TINYINT(4) AUTO_INCREMENT PRIMARY KEY,
    stars TINYINT(4) NOT NULL,
    body VARCHAR(500) NOT NULL,
    user_Id INT(11) NOT NULL
    )";
    $conn->query($sqlUsersRating);


    $sqlUsersNotes = "CREATE TABLE IF NOT EXISTS users_notes (
    id TINYINT(4) AUTO_INCREMENT PRIMARY KEY,
    user_id TINYINT(4) NOT NULL,
    body VARCHAR(250) NOT NULL,
    reason VARCHAR(250) NOT NULL
    )";
    $conn->query($sqlUsersNotes);

    $sqlUsersComplimants = "CREATE TABLE IF NOT EXISTS users_complimants (
    id TINYINT(4) AUTO_INCREMENT PRIMARY KEY,
    user_id TINYINT(4) NOT NULL,
    reason VARCHAR(250) NOT NULL,
    body VARCHAR(250) NOT NULL
    )";
    $conn->query($sqlUsersComplimants);

    $sqlUsers = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(250) NOT NULL,
    password VARCHAR(150) NOT NULL,
    refere VARCHAR(50) NOT NULL,
    refere_id INT(11) NOT NULL,
    image TEXT NOT NULL,
    user_group_id INT(11) NOT NULL
    )";
    $conn->query($sqlUsers);

    $sqlFacilityOwners = "CREATE TABLE IF NOT EXISTS facility_owners (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    image TEXT NOT NULL,
    email VARCHAR(250) NOT NULL,
    agency_refere SMALLINT(6) NOT NULL,
    about VARCHAR(500) NOT NULL,
    civil_registry INT(11) NOT NULL,
    phone_number INT(11) NOT NULL,
    postion VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    status TINYINT(2) DEFAULT 0 NOT NULL,
    job_id INT(2) NOT NULL
    )";
    $conn->query($sqlFacilityOwners);

    $sqlFacilities = "CREATE TABLE IF NOT EXISTS facilities (
    id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    facility_name VARCHAR(250) NOT NULL,
    image TEXT NOT NULL,
    description VARCHAR(500) NOT NULL,
    number INT(11) NOT NULL,
    commercial_register INT(11) NOT NULL,
    activity TINYINT(2) DEFAULT 1 NOT NULL,
    status TINYINT(2) DEFAULT 0 NOT NULL,
    location TEXT NOT NULL,
    location_link VARCHAR(500) NOT NULL, 
    city VARCHAR(100) NOT NULL, 
    district VARCHAR(100) NOT NULL, 
    street VARCHAR(100) NOT NULL, 
    owner_name VARCHAR(50) NOT NULL, 
    owner_id INT(11) NOT NULL,
    camera_one_link TEXT NOT NULL,
    camera_one_title VARCHAR(50) NOT NULL,
    camera_two_link TEXT NOT NULL,
    camera_two_title VARCHAR(50) NOT NULL,
    camera_three_link TEXT NOT NULL,
    camera_three_title VARCHAR(50) NOT NULL,
    camera_four_link TEXT NOT NULL,
    camera_four_title VARCHAR(50) NOT NULL,
    gov_assessment TINYINT(4) DEFAULT 1 NOT NULL,
    cosumer_assessment FLOAT DEFAULT 1 NOT NULL

    )";
    $conn->query($sqlFacilities);

    $sqlEmployies = "CREATE TABLE IF NOT EXISTS employees (
    id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    image TEXT NOT NULL,
    email VARCHAR(150) NOT NULL,
    about VARCHAR(250) NOT NULL,
    civil_registry INT(11) NOT NULL,
    date DATE NOT NULL,
    postion VARCHAR(50) NOT NULL,
    job_id INT(11) NOT NULL,
    phone_number INT(11) NOT NULL,
    status TINYINT(4) DEFAULT 0 NOT NULL
    )";
    $conn->query($sqlEmployies);

    $sqlControllers = "CREATE TABLE IF NOT EXISTS controllers (
    id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    image TEXT NOT NULL,
    email VARCHAR(150) NOT NULL,
    about VARCHAR(250) NOT NULL,
    civil_registry INT(11) NOT NULL,
    date DATE NOT NULL,
    postion VARCHAR(50) NOT NULL,
    job_id INT(11) NOT NULL,
    phone_number INT(11) NOT NULL,
    status TINYINT(4) DEFAULT 0 NOT NULL
    )";
    $conn->query($sqlControllers);

    $sqlConsumers = "CREATE TABLE IF NOT EXISTS consumers (
    id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    image TEXT NOT NULL,
    email VARCHAR(150) NOT NULL,
    about VARCHAR(250) NOT NULL,
    civil_registry INT(11) NOT NULL,
    date DATE NOT NULL,
    phone_number INT(11) NOT NULL,
    status TINYINT(4) DEFAULT 0 NOT NULL
    )";
    $conn->query($sqlConsumers);

    $sqlAgencyServices = "CREATE TABLE IF NOT EXISTS agency_services (
    id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    agency_id TINYINT(4) NOT NULL,
    owner_id TINYINT(4) NOT NULL,
    description TEXT NOT NULL,
    image TEXT NOT NULL
    )";
    $conn->query($sqlAgencyServices);

    $sqlAgencyProducts = "CREATE TABLE IF NOT EXISTS agency_products (
    id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(150) NOT NULL,
    agency_id TINYINT(4) NOT NULL,
    owner_id TINYINT(4) NOT NULL,
    price TINYINT(4) NOT NULL,
    description TEXT NOT NULL,
    image TEXT NOT NULL
    )";
    $conn->query($sqlAgencyProducts);

    $sqlAgencyOffers = "CREATE TABLE IF NOT EXISTS agency_offers (
    id  INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    agency_id TINYINT(4) NOT NULL,
    owner_id TINYINT(4) NOT NULL,
    description TEXT NOT NULL,
    image TEXT NOT NULL
    )";
    $conn->query($sqlAgencyOffers);

    $finishedOperations = true;

}
 }

