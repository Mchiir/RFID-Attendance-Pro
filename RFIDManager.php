<?php
include_once("DatabaseManager.php");

class RFIDManager extends DatabaseManager {
    private $TBL_TRANSACTIONS;

    public function __construct($tbl = "attendance") {
        parent::__construct();
        $this->TBL_TRANSACTIONS = $tbl;

        // Create the table if it doesn't exist
        $sql = "
            CREATE TABLE IF NOT EXISTS " . $this->TBL_TRANSACTIONS . " (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                clock_in DATETIME,
                clock_out DATETIME,
                hours_worked REAL
            );
        ";

        $q = $this->con->prepare($sql);
        $q->execute();
    }

    // Public getter for TBL_TRANSACTIONS
    public function getTableName() {
        return $this->TBL_TRANSACTIONS;
    }

    // Method to save an attendance
    public function saveTransaction($employee, $clock_in, $clock_out) {
        // Convert clock_in and clock_out to DateTime objects
        try {
            $clock_in_time = new DateTime($clock_in);
            $clock_out_time = new DateTime($clock_out);
        } catch (Exception $e) {
            throw new Exception("Invalid date format.");
        }

        // Calculate the difference and get the number of hours worked
        $interval = $clock_in_time->diff($clock_out_time);
        $hours_worked = $interval->h + ($interval->i / 60); // Hours + minutes converted to decimal

        // Insert the transaction into the database
        $sql = "INSERT INTO " . $this->TBL_TRANSACTIONS . " 
                (name, clock_in, clock_out, hours_worked) 
                VALUES (:employee, :clock_in, :clock_out, :hours_worked)";
        
        $q = $this->con->prepare($sql);
        $q->bindValue(":employee", $employee);
        $q->bindValue(":clock_in", $clock_in);
        $q->bindValue(":clock_out", $clock_out);
        $q->bindValue(":hours_worked", $hours_worked);

        if ($q->execute()) {
            return true; // Success
        } else {
            throw new Exception("Failed to save transaction.");
        }
    }
}
?>