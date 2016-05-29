<?php
include_once 'base.php';
include_once 'department.php';

class Employee extends Base {
    protected static $filename = 'employees';
    protected static $vars = ['fullname', 'birth', 'phone', 'post', 'department', 'department_name'];
    protected static $items = [];

    public static function getAll($filter = []) {
        $sql = "
            SELECT `e`.*, `d`.`name` AS `department_name` 
            FROM `employees` AS `e`
            LEFT JOIN `departments` AS `d` ON `e`.`department` = `d`.`id`
            WHERE 1
        ";

        if (!empty($filter['num'])) {
            $sql .= " AND `e`.`id` = {$filter['num']} ";
        }

        if (!empty($filter['name'])) {
            $sql .= " AND `e`.`fullname` LIKE '%{$filter['name']}%' ";
        }

        if (!empty($filter['birth'])) {
            $parts = explode('.', $filter['birth']);
            $date = implode('-', array_reverse($parts));

            $sql .= " AND `e`.`birth` = '{$date}' ";
        }

        if (!empty($filter['phone'])) {
            $sql .= " AND `e`.`phone` LIKE '{$filter['phone']}' ";
        }

        if (!empty($filter['post'])) {
            $sql .= " AND `e`.`post` LIKE '%{$filter['post']}%' ";
        }

        $employees = [];
        foreach (Database::select($sql) as $row) {
            $employee = new Employee();
            $employee->num = $row['id'];
            $employee->fullname = $row['fullname'];
            $employee->birth = $row['birth'];
            $employee->phone = $row['phone'];
            $employee->post = $row['post'];
            $employee->department = $row['department'];
            $employee->department_name = $row['department_name'];

            $employees[] = $employee;
        }

        return $employees;
    }

    public function delete() {
        parent::delete();

        $department = Department::getItem($this->department);
        $department->employees_count--;
        $department->update();
    }

    public function __set($name, $value) {
        if ($name == 'department' && (empty($this->values['department']) || $this->values['department'] != $value)) {
            if (!empty($this->values['department']) && $this->values['department']) {
                $department = Department::getItem($this->values['department']);
                $department->employees_count--;
                $department->update();
            }

            $department = Department::getItem($value);
            $department->employees_count++;
            $department->update();
        }

        parent::__set($name, $value);
    }
}