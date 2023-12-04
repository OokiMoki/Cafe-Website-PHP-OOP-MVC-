<?php
namespace controller;

use model\DrinksModel;

class DrinksController {
    private $model;

    /**
     * Constructor for DrinksController.
     *
     * @param DrinksModel $model The DrinksModel instance to be used by the controller.
     */
    public function __construct(DrinksModel $model) {
        $this->model = $model;
    }

    /**
     * Retrieves the drinks menu.
     *
     * @return array The drinks menu data.
     */
    public function getDrinksMenu(): array { // Adjust the return type here
        $data = $this->model->getDrinksMenu();
        // Further processing if needed
        return $data;
    }

    /**
     * Creates a new menu item.
     *
     * @param string $name  The name of the menu item.
     * @param float  $price The price of the menu item.
     * @param string $image The image URL of the menu item.
     *
     * @return mixed The result of the createMenu operation.
     */
    public function createMenu($name, $price, $image)
    { // Adjust the return type here
        return $this->model->createMenu($name, $price, $image);
    }

    /**
     * Retrieves a menu item by its ID.
     *
     * @param int $id The ID of the menu item to retrieve.
     *
     * @return mixed The result of the readMenuById operation.
     */
    public function getMenuById($id)
    { // Adjust the return type here
        return $this->model->readMenuById($id);
    }

    /**
     * Updates a menu item.
     *
     * @param int    $id    The ID of the menu item to update.
     * @param string $name  The new name for the menu item.
     * @param float  $price The new price for the menu item.
     * @param string $image The new image URL for the menu item.
     *
     * @return mixed The result of the update operation.
     */
    public function updateMenu($id, $name, $price, $image)
    { // Adjust the return type here
        return $this->model->update($id, $name, $price, $image);
    }

    /**
     * Deletes a menu item by its ID.
     *
     * @param int $id The ID of the menu item to delete.
     *
     * @return mixed The result of the delete operation.
     */
    public function deleteMenu($id)
    { // Adjust the return type here
        return $this->model->delete($id);
    }

}
