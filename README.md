# Employee Management Mini System

Bu layihə Core PHP və PDO istifadə edilərək hazırlanmış sadə bir işçi idarəetmə sistemidir. Layihənin məqsədi CRUD əməliyyatlarını (əlavə etmə, oxuma, yeniləmə və silmə) öyrənmək və təhlükəsiz database işləmə məntiqini praktikada tətbiq etməkdir.

## Layihə haqqında

Sistem vasitəsilə işçilərin məlumatlarını idarə etmək mümkündür. İşçi əlavə etmək, siyahıya baxmaq, məlumatları dəyişmək, silmək və axtarış etmək funksiyaları mövcuddur. Layihə framework istifadə olunmadan yazılıb və strukturlaşdırılmış formada hazırlanıb.

## Funksiyalar

- Yeni işçi əlavə etmək
- İşçilərin siyahısını göstərmək
- Mövcud işçini redaktə etmək
- İşçini silmək
- Ad və email üzrə axtarış
- Səhifələmə (pagination)

## İstifadə olunan texnologiyalar

- Core PHP
- PDO (database bağlantısı üçün)
- MySQL
- HTML və CSS

## Layihə strukturu

```text
Employee_Management_Mini_System/
│
├── config/
│   ├── config.php
│   └── db.php
│
├── models/
│   └── Employee.php
│
├── public/
│   ├── css/
│   │   └── styles.css
│
├── views/
│   ├── employees/
│   │   ├── form.php
│   │   └── list.php
│   │
│   ├── layouts/
│   │   ├── header.php
│   │   └── footer.php
│   │
│   ├── index.php
│   ├── create.php
│   ├── edit.php
│
└── index.php
```

## Database yaradılması

Aşağıdakı SQL kodunu istifadə edərək database cədvəlini yarada bilərsiniz:

```sql
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    position VARCHAR(50),
    salary DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Təhlükəsizlik

- SQL injection qarşısını almaq üçün PDO prepared statements istifadə olunub
- XSS hücumlarının qarşısını almaq üçün htmlspecialchars tətbiq olunub
- Form input-ları validate edilir
