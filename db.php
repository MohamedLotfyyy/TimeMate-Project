<?php

// TODO handle errors properly
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database
{
    public $conn;

    function __construct()
    {
        $DATABASE_HOST = 'dbhost.cs.man.ac.uk';
        $DATABASE_USER = 'v74779hb';
        $DATABASE_PASS = 'GloriousCh33se';
        $DATABASE_NAME = '2022_comp10120_y4';

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    }

    // Inserts an account into the database. Does not valdiate.
    function create_account($username, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare('INSERT INTO accounts (username, email, password, settings) VALUES (?, ?, ?, "")');

        $stmt->bind_param('sss', $username, $email, $hash);
        $stmt->execute();
    }

    // Checks that a password matches the password hash stored in the database for a user.
    // Returns false if the user does not exist or the password is wrong.
    function is_correct_password($username, $password)
    {
        $stmt = $this->conn->prepare('SELECT password FROM accounts WHERE username=?');

        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $hash = $result ? $result->fetch_row()[0] ?? "" : "";

        if ($password == "" || $hash == "") {
            return false;
        }

        return password_verify($password, $hash);
    }

    function user_exists($username, $email)
    {
        $stmt = $this->conn->prepare('SELECT 1 FROM accounts WHERE username=? OR email=?');

        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();

        return (bool) $stmt->get_result()->fetch_row();
    }

    // Returns the username of the logged in user, or null if not logged in.
    function logged_in_user()
    {
        return $_SESSION["username"] ?? null;
    }

    // Save the settings JSON in the database for a user
    function save_settings($username, $settings)
    {
        $stmt = $this->conn->prepare('UPDATE accounts SET settings = ? WHERE username = ?');
        $stmt->bind_param('ss', $settings, $username);
        $stmt->execute();
    }

    // Returns the settings JSON from the database for a users
    // May be an empty string if the user has no settings saved
    function get_settings($username)
    {
        $stmt = $this->conn->prepare('SELECT settings FROM accounts WHERE username=?');

        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $settings = $result ? $result->fetch_row()[0] ?? "" : "";
        return $settings;
    }

    // Deletes the specified account from the database
    function delete_account($username)
    {
        $stmt = $this->conn->prepare('DELETE FROM accounts WHERE username=?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
    }
}

?>