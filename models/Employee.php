<?php

require_once __DIR__ . '/../config/Database.php';

class Employee
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function paginate($search = null, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $params = [];
        $whereClause = " WHERE 1";

        if ($search) {
            $whereClause .= " AND (first_name LIKE :s1 OR last_name LIKE :s2 OR email LIKE :s3)";
            $searchValue = "%$search%";
            $params[':s1'] = $searchValue;
            $params[':s2'] = $searchValue;
            $params[':s3'] = $searchValue;
        }

        $countSql = "SELECT COUNT(*) FROM employees" . $whereClause;
        $countStmt = $this->pdo->prepare($countSql);
        foreach ($params as $key => $val) {
            $countStmt->bindValue($key, $val);
        }
        $countStmt->execute();
        $total = (int) $countStmt->fetchColumn();

        $sql = "SELECT * FROM employees" . $whereClause . " ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $total,
            'pages' => max(1, (int) ceil($total / $limit)),
            'current_page' => $page,
        ];
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM employees WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $employee = $stmt->fetch();

        return $employee ?: null;
    }

    public function create(array $data)
    {
        try {
            $sql = 'INSERT INTO employees (first_name, last_name, email, phone, position, salary, created_at)
                VALUES (:first_name, :last_name, :email, :phone, :position, :salary, NOW())';

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'position' => $data['position'],
                'salary' => $data['salary'],
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $sql = 'UPDATE employees
                SET first_name = :first_name,
                    last_name = :last_name,
                    email = :email,
                    phone = :phone,
                    position = :position,
                    salary = :salary
                WHERE id = :id';

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                'id' => $id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'position' => $data['position'],
                'salary' => $data['salary'],
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM employees WHERE id = :id');

        return $stmt->execute(['id' => $id]);
    }

    public function emailExists(string $email, ?int $ignoreId = null)
    {
        $sql = 'SELECT COUNT(*) FROM employees WHERE email = :email';
        $params = ['email' => $email];

        if ($ignoreId !== null) {
            $sql .= ' AND id != :id';
            $params['id'] = $ignoreId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }
}