<?php
namespace controller;

use model\TimeTableModel;

class TimeTableController {
    private $model;

    /**
     * Constructor for TimeTableController.
     *
     * @param TimeTableModel $model The TimeTableModel instance to be used by the controller.
     */
    public function __construct(TimeTableModel $model) {
        $this->model = $model;
    }

    /**
     * Creates a new entry in the time table.
     *
     * @param int    $employee_id The ID of the employee.
     * @param string $start_date  The start date of the time entry.
     * @param string $start_time  The start time of the time entry.
     * @param string $end_time    The end time of the time entry.
     * @param string $end_date    The end date of the time entry.
     *
     * @return mixed The result of the store operation.
     */
    public function create($employee_id, $start_date, $start_time, $end_time, $end_date) {
        return $this->model->store($employee_id, $start_date, $start_time, $end_time, $end_date);
    }

    /**
     * Retrieves all entries from the time table.
     *
     * @return mixed The result of the getAll operation.
     */
    public function getAll() {
        return $this->model->getAll();
    }

    /**
     * Retrieves a time table entry by its ID.
     *
     * @param int $id The ID of the time table entry to retrieve.
     *
     * @return mixed The result of the readById operation.
     */
    public function getById($id) {
        return $this->model->readById($id);
    }

    /**
     * Updates a time table entry.
     *
     * @param int    $id           The ID of the time table entry to update.
     * @param int    $employee_id  The ID of the employee.
     * @param string $start_date   The start date of the time entry.
     * @param string $start_time   The start time of the time entry.
     * @param string $end_time     The end time of the time entry.
     * @param string $end_date     The end date of the time entry.
     *
     * @return mixed The result of the update operation.
     */
    public function update($id, $employee_id, $start_date, $start_time, $end_time, $end_date) {
        return $this->model->update($id, $employee_id, $start_date, $start_time, $end_time, $end_date);
    }

    /**
     * Deletes a time table entry by its ID.
     *
     * @param int $id The ID of the time table entry to delete.
     *
     * @return mixed The result of the delete operation.
     */
    public function delete($id) {
        return $this->model->delete($id);
    }

    /**
     * Retrieves time table entries for a specific employee.
     *
     * @param int $id The ID of the employee.
     *
     * @return mixed The result of the readByEmpId operation.
     */
    public function getMyTimeTable($id) {
        return $this->model->readByEmpId($id);
    }
}
?>
