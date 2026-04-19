<?php

require_once "models/Employee.php";

class EmployeeController {

    private $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new Employee();
    }

    public function index() {
        $search = trim($_GET['search'] ?? '');
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $limit = 10;

        $result = $this->employeeModel->paginate($search, $page, $limit);

        require __DIR__ . '/../views/employees/list.php';
    }

    public function create()
    {
        $employee = null;
        $errors = [];
        $formAction = 'index.php?action=store';
        $title = 'İşçi Əlave Et';

        require __DIR__ . '/../views/employees/form.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect();
        }

        $data = $this->sanitizeInput($_POST);
        $errors = $this->validate($data);

        if ($this->employeeModel->emailExists($data['email'])) {
            $errors['email'] = 'Bu email artiq movcuddur.';
        }

        if ($errors !== []) {
            set_old($data);
            $employee = null;
            $formAction = 'index.php?action=store';
            $title = 'Əlavə Et';

            require __DIR__ . '/../views/employees/form.php';
            return;
        }

        clear_old();
        $result = $this->employeeModel->create($data);

        if (!$result) {
            redirect_with_message('error', 'Xəta baş verdi.', 'index.php?action=create');
        }
        
        redirect_with_message('success', 'Employee ugurla elave edildi.');
    }

    public function edit(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if ($employee === null) {
            redirect_with_message('error', 'Employee tapilmadi.');
        }

        $errors = [];
        $formAction = 'index.php?action=update&id=' . $id;
        $title = 'Redakte Et';

        require __DIR__ . '/../views/employees/form.php';
    }

    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect();
        }

        $employee = $this->employeeModel->find($id);

        if ($employee === null) {
            redirect_with_message('error', 'Məlumat tapılmadı.');
        }

        $data = $this->sanitizeInput($_POST);
        $errors = $this->validate($data);

        if ($this->employeeModel->emailExists($data['email'], $id)) {
            $errors['email'] = 'Bu email artiq movcuddur.';
        }

        if ($errors !== []) {
            set_old($data);
            $employee = array_merge($employee, $data);
            $formAction = 'index.php?action=update&id=' . $id;
            $title = 'İşçi Redakte Et';

            require __DIR__ . '/../views/employees/form.php';
            return;
        }

        clear_old();
        $result = $this->employeeModel->update($id, $data);

        if (!$result) {
            redirect_with_message('error', 'Yeniləmə zamanı xəta baş verdi.');
        }
        
        redirect_with_message('success', 'Employee ugurla yenilendi.');
    }

    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect();
        }

        $employee = $this->employeeModel->find($id);

        if ($employee === null) {
            redirect_with_message('error', 'Employee tapilmadi.');
        }

        $this->employeeModel->delete($id);
        redirect_with_message('success', 'Uğurlu silindi.');
    }

    private function sanitizeInput(array $input)
    {
        return array_map(function($value) {
            return trim($value ?? '');
        }, $input);
    }

    private function validate(array $data)
    {
        $errors = [];

        foreach (['first_name', 'last_name', 'email', 'phone', 'position', 'salary'] as $field) {
            if ($data[$field] === '') {
                $errors[$field] = 'Bu xana bos ola bilmez.';
            }
        }

        if ($data['email'] !== '' && filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Email formati duzgun deyil.';
        }

        if ($data['salary'] !== '' && !is_numeric($data['salary'])) {
            $errors['salary'] = 'Maas yalniz reqem olmalidir.';
        }

        return $errors;
    }
}
