<?php
include_once 'base.php';
include_once 'department.php';

class Employee extends Base {
    protected static $filename = 'employees';
    protected static $vars = ['fullname', 'birth', 'phone', 'post', 'department'];
    protected static $items = [];

    public static function getAll($filter = []) {
        if (!empty($filter)) {
            $sql = "
                SELECT * FROM `employees`
                WHERE 1
            ";

            if (!empty($filter['num'])) {
                $sql .= " AND `id` = {$filter['num']} ";
            }

            if (!empty($filter['name'])) {
                $sql .= " AND `fullname` LIKE '%{$filter['name']}%' ";
            }

            if (!empty($filter['birth'])) {
                $parts = explode('.', $filter['birth']);
                $date = implode('-', array_reverse($parts));

                $sql .= " AND `birth` = '{$date}' ";
            }

            if (!empty($filter['phone'])) {
                $sql .= " AND `phone` LIKE '{$filter['phone']}' ";
            }

            if (!empty($filter['post'])) {
                $sql .= " AND `post` LIKE '%{$filter['post']}%' ";
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

                $employees[] = $employee;
            }

            return $employees;
        }

        return parent::getAll();

        if (empty(self::$items)) {
            self::loadItems();
        }

        if (!empty($filter)) {
            $filtered = [];
            foreach (self::$items as $employee) {
                if (!empty($filter['num']) && $employee->num != $filter['num']) {
                    continue;
                }

                if (!empty($filter['name']) && strpos($employee->fullname, $filter['name']) === false) {
                    continue;
                }

                if (!empty($filter['birth']) && $employee->birth != $filter['birth']) {
                    continue;
                }

                if (!empty($filter['phone']) && $employee->phone != $filter['phone']) {
                    continue;
                }

                if (!empty($filter['post']) && strpos($employee->post, $filter['post']) === false) {
                    continue;
                }

                $filtered[] = $employee;
            }

            return $filtered;
        }

        return self::$items;
    }

    public function delete() {
        parent::delete();

        $department = Department::getItem($this->department);
        $department->employees_count--;
        Department::saveAll();
    }

    public function __set($name, $value) {
        if ($name == 'department' && (empty($this->values['department']) || $this->values['department'] != $value)) {
            if (!empty($this->values['department']) && $this->values['department']) {
                $department = Department::getItem($this->values['department']);
                $department->employees_count--;
            }

            $department = Department::getItem($value);
            $department->employees_count++;
            Department::saveAll();
        }

        parent::__set($name, $value);
    }
}