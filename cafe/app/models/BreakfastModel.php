<?php
namespace model;

use core\Database;

class BreakfastModel {
    private $conn;

    /**
     * BreakfastModel constructor.
     *
     * @param Database $database An instance of the Database class for database operations.
     */
    public function __construct(Database $database) {
        $this->conn = $database->connect();
    }

    /**
     * Get all items from the breakfast menu.
     *
     * @return array An array containing the breakfast menu items.
     */
    public function getBreakfastMenu(): array {
        $conn = $this->conn;
        $result = [];  // Initialize an empty array

        // Perform the query and populate $result with data
        $query = "SELECT * FROM breakfast_menu";
        $stmt = $conn->query($query);

        if ($stmt) {
            while ($row = $stmt->fetch_assoc()) {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * Create a new menu item in the breakfast menu.
     *
     * @param string $name  The name of the menu item.
     * @param int    $price The price of the menu item.
     * @param string $image The image of the menu item.
     *
     * @return bool|string True if the menu item is created successfully, otherwise an error message.
     */
    public function createMenu($name, $price, $image)
    {
        $con = $this->conn;

        $sql = "INSERT INTO breakfast_menu (name, price, image) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sis", $name, $price, $image);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error creating menu item: " . $stmt->error;
        }
    }

    /**
     * Read a menu item from the breakfast menu by its ID.
     *
     * @param int $id The ID of the menu item.
     *
     * @return array|string An array containing the menu item details if found, otherwise an error message.
     */
    public function readMenuById($id)
    {
        $con = $this->conn;

        $sql = "SELECT * FROM breakfast_menu WHERE item_id = ?";
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
                return "No menu item found";
            }
        } else {
            return "Error executing the statement: " . $stmt->error;
        }
    }

    /**
     * Update a menu item in the breakfast menu.
     *
     * @param int    $item_id The ID of the menu item.
     * @param string $name    The updated name of the menu item.
     * @param int    $price   The updated price of the menu item.
     * @param string $image   The updated image of the menu item.
     *
     * @return bool True if the menu item is updated successfully, otherwise false.
     */
     public function update($item_id, $name, $price, $image)
     {
         $con = $this->conn;
 
         $sql = "UPDATE breakfast_menu SET name=?, price=?, image=? WHERE item_id=?";
         $stmt = $con->prepare($sql);
         $stmt->bind_param("sisi", $name, $price, $image, $item_id);
 
         if ($stmt->execute()) {
             return true;
         } else {
             return false;
         }
     }

     /**
      * Delete a menu item from the breakfast menu by its ID.
      *
      * @param int $id The ID of the menu item to be deleted.
      *
      * @return bool True if the menu item is deleted successfully, otherwise false.
      */
     public function delete($id)
    {
        $con = $this->conn;

        $sql = "DELETE FROM breakfast_menu WHERE item_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
