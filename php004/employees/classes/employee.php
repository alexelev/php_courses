<?php

/**
 * Created by PhpStorm.
 * User: student
 * Date: 24.04.2016
 * Time: 16:21
 */
class Employee
{
    public $num;
    public $fullname;
    public $birth;
    public $phone;
    public $post;
    
    private static $employees = null;

    private static function loadEmployees(){
        $file = fopen("data/employees", 'r');
        Employee::$employees = [];
        $num = 0;
        while (!feof($file)) {
            list($name, $birth, $phone, $post) = explode(' | ', str_replace("\r\n", '', fgets($file)));
            if (!feof($file)) {
                $employee = new self();
                $employee->$num++;
                $employee->fullname = $name;
                $employee->birth = $birth;
                $employee->phone = $phone;
                $employee->post = $post;
                Employee::$employees[] = $employee;
            }
        }

        fclose($file);
    }

    public static function getAll()
    {
        if (empty(Employee::$employees)){
            Employee::loadEmployees();
        }
        return Employee::$employees;
    }

    public function getEmployee($num)
    {
        if (isset(Employee::$employees[$num])){
            return Employee::$employees[$num];
        }
        return null;
    }

    public function saveAll()
    {
//        Employee::$employees[$this->num] = $this;
        $file = fopen("data/employees", 'w');

        foreach (Employee::$employees as $employee) {
            fwrite($file, "{$employee->name} | {$employee->birth} | {$employee->phone} | {$employee->post}\r\n");
        }

        fclose($file);
    }

    public function delete()
    {
        unset(self::$employees[$this->num]);
        Employee::saveAll();
    }
}