<?php

namespace model;

use core\Database;

class TimeTableModel
{
    private $conn;

    /**
     * TimeTableModel constructor.
     *
     * @param Database $database An instance of the Database class for database operations.
     */
    public function __construct(Database $database)
    {
        $this->conn = $database->connect();
    }

    /**
     * Store time table record in the database.
     *
     * @param int    $employee_id Employee ID.
     * @param string $start_date  Start date.
     * @param string $start_time  Start time.
     * @param string $end_time    End time.
     * @param string $end_date    End date.
     *
     * @return bool|string True if stored successfully, otherwise an error message.
     */
    public function store($employee_id, $start_date, $start_time, $end_time, $end_date)
    {
        if ($this->isOverlapping($employee_id, $start_date, $start_time, $end_time, $end_date)) {
            return false;
        }
        if ($this->isSameRecord($employee_id, $start_date, $start_time, $end_time, $end_date)) {
            return false;
        }
        $conn = $this->conn;


        $insertQuery = "INSERT INTO time_table (employee_id, start_date, start_time, end_time, end_date) VALUES (?, DATE(?), ?, ?, DATE(?))";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("issss", $employee_id, $start_date, $start_time, $end_time, $end_date);

        if ($insertStmt->execute()) {
            return true;
        } else {
            return "Error creating employee: " . $insertStmt->error;
        }
    }

    /**
     * Check if the time table entry overlaps with existing records.
     *
     * @param int    $employeeId Employee ID.
     * @param string $start_date Start date.
     * @param string $startTime  Start time.
     * @param string $endTime    End time.
     * @param string $end_date   End date.
     * @param bool   $update     Flag to indicate if it's an update operation.
     * @param int    $recordId   ID of the record being updated.
     *
     * @return bool True if there is an overlap, otherwise false.
     */
    function isOverlapping($employeeId, $start_date, $startTime, $endTime, $end_date, $update = false, $recordId = null): bool
    {
        $conn = $this->conn;

        $overlapCheckQuery = "SELECT COUNT(*) as count FROM time_table WHERE employee_id = ?
                          AND start_date = DATE(?) 
                          AND end_date = DATE(?) 
                          AND ((start_time >= ? AND start_time < ?) OR (end_time > ? AND end_time <= ?)) ";

        if ($update) {
            $overlapCheckQuery .= "AND id != ?";
        }

        $overlapStmt = $conn->prepare($overlapCheckQuery);

        if ($update) {
            $overlapStmt->bind_param("issssssi", $employeeId, $start_date, $end_date, $startTime, $endTime, $startTime, $endTime, $recordId);
        } else {
            $overlapStmt->bind_param("issssss", $employeeId, $start_date, $end_date, $startTime, $endTime, $startTime, $endTime);
        }

        $overlapStmt->execute();
        $overlapResult = $overlapStmt->get_result();
        $count = $overlapResult->fetch_assoc()['count'];

        return $count > 0;
    }

    /**
     * Check if the time table entry is the same as an existing record.
     *
     * @param int    $employeeId Employee ID.
     * @param string $start_date Start date.
     * @param string $startTime  Start time.
     * @param string $endTime    End time.
     * @param string $end_date   End date.
     * @param bool   $update     Flag to indicate if it's an update operation.
     * @param int    $recordId   ID of the record being updated.
     *
     * @return bool True if it's the same record, otherwise false.
     */
    function isSameRecord($employeeId, $start_date, $startTime, $endTime, $end_date,  $update = false, $recordId = null): bool
    {
        $conn = $this->conn;

        $sameTimeCheckQuery = "SELECT COUNT(*) as count FROM time_table WHERE employee_id = ? 
        AND start_date = DATE(?) 
        AND end_date = DATE(?) 
        AND start_time = ? AND end_time = ? ";

        if ($update) {
            $sameTimeCheckQuery .= "AND id != ?";
        }

        $sameTimeStmt = $conn->prepare($sameTimeCheckQuery);

        if ($update) {
            $sameTimeStmt->bind_param("issssi", $employeeId, $start_date, $end_date, $startTime, $endTime, $recordId);
        } else {
            $sameTimeStmt->bind_param("issss", $employeeId, $start_date, $end_date, $startTime, $endTime);
        }

        $sameTimeStmt->execute();
        $sameTimeResult = $sameTimeStmt->get_result();
        $count = $sameTimeResult->fetch_assoc()['count'];

        return $count > 0;
    }



    /**
     * Get all time table records with associated employee details.
     *
     * @return array|string Array of records or an error message if none found.
     */
    public function getAll()
    {
        $con = $this->conn;

        $sql = "SELECT time_table.*, employees.first_name, employees.last_name, employees.role FROM time_table INNER JOIN employees ON time_table.employee_id = employees.employee_id ORDER BY time_table.id DESC";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "No times found";
        }
    }

    /**
     * Get time table record by ID with associated employee details.
     *
     * @param int $id Record ID.
     *
     * @return array|string Array containing the record or an error message if not found.
     */
    public function readById($id)
    {
        $con = $this->conn;

        $sql = "SELECT time_table.*, employees.first_name, employees.last_name, employees.role FROM time_table INNER JOIN employees ON time_table.employee_id = employees.employee_id WHERE time_table.id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            // Check if there is a result
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                // Default role if user not found or role not specified
                return "No time found";
            }
        } else {
            return "Error executing the statement: " . $stmt->error;
        }
    }

    /**
     * Get all time table records for a specific employee with associated details.
     *
     * @param int $emp_id Employee ID.
     *
     * @return array|bool Array of records or false if none found.
     */
    public function readByEmpId($emp_id)
    {
        $con = $this->conn;

        $sql = "SELECT time_table.*, employees.first_name, employees.last_name, employees.role FROM time_table INNER JOIN employees ON time_table.employee_id = employees.employee_id WHERE time_table.employee_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $emp_id);
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            // Check if there is a result
            if ($result && $result->num_rows > 0) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                return $rows;
            } else {
                // Default role if user not found or role not specified
                return false;
            }
        } else {
            return "Error executing the statement: " . $stmt->error;
        }
    }

    /**
     * Update time table record.
     *
     * @param int    $id          Record ID.
     * @param int    $employee_id Employee ID.
     * @param string $start_date  Start date.
     * @param string $start_time  Start time.
     * @param string $end_time    End time.
     * @param string $end_date    End date.
     *
     * @return bool True if the update is successful, otherwise false.
     */
    public function update($id, $employee_id, $start_date, $start_time, $end_time, $end_date)
    {

        if ($this->isOverlapping($employee_id, $start_date, $start_time, $end_time, $end_date, true, $id)) {
            return false;
        }

        if ($this->isSameRecord($employee_id, $start_date, $start_time, $end_time, $end_date, true, $id)) {
            return false;
        }

        $con = $this->conn;

        $sql = "UPDATE time_table SET employee_id=?, start_date=?, start_time=?, end_time=?, end_date=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("issssi", $employee_id, $start_date, $start_time, $end_time, $end_date, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete time table record by ID.
     *
     * @param int $id Record ID.
     *
     * @return bool True if the deletion is successful, otherwise false.
     */
    public function delete($id)
    {
        $con = $this->conn;

        $sql = "DELETE FROM time_table WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
