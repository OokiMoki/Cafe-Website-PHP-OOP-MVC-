<?php
namespace model;

use core\Database;

class LunchModel {
    private $conn;

    /**
     * LunchModel constructor.
     *
     * @param Database $database An instance of the Database class for database operations.
     */
    public function __construct(Database $database) {
        $this->conn = $database->connect();
    }

    /**
     * Get the lunch menu.
     *
     * @return array An array containing the lunch menu items.
     */
    public function getLunchMenu(): array {
        $conn = $this->conn;
        $result = [];  // Initialize an empty array

        // Perform the query and populate $result with data
        $query = "SELECT * FROM lunch_menu";
        $stmt = $conn->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch_assoc()) {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * Create a new lunch menu item.
     *
     * @param string $name  The name of the menu item.
     * @param float  $price The price of the menu item.
     * @param string $image The image URL of the menu item.
     *
     * @return true|string True if the creation is successful, otherwise an error message.
     */
    public function createMenu($name, $price, $image) {
        $con = $this->conn;

        $sql = "INSERT INTO lunch_menu (name, price, image) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sis", $name, $price, $image);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error creating lunch menu item: " . $stmt->error;
        }
    }

    /**
     * Read lunch menu item by ID.
     *
     * @param int $id The ID of the lunch menu item.
     *
     * @return array|string An array containing the menu item details if found, otherwise an error message.
     */
    public function readMenuById($id) {
        $con = $this->conn;

        $sql = "SELECT * FROM lunch_menu WHERE item_id = ?";
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
                return "No lunch menu item found";
            }
        } else {
            return "Error executing the statement: " . $stmt->error;
        }
    }

    /**
     * Update lunch menu item information.
     *
     * @param int    $item_id The ID of the lunch menu item.
     * @param string $name    The new name of the menu item.
     * @param float  $price   The new price of the menu item.
     * @param string $image   The new image URL of the menu item.
     *
     * @return bool True if the update is successful, otherwise false.
     */
    public function update($item_id, $name, $price, $image) {
        $con = $this->conn;

        $sql = "UPDATE lunch_menu SET name=?, price=?, image=? WHERE item_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sisi", $name, $price, $image, $item_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete a lunch menu item by ID.
     *
     * @param int $id The ID of the lunch menu item to be deleted.
     *
     * @return bool True if the deletion is successful, otherwise false.
     */
    public function delete($id) {
        $con = $this->conn;

        $sql = "DELETE FROM lunch_menu WHERE item_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
