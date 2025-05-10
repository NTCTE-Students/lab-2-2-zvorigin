<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем параметры из формы
$search = isset($_GET['search']) ? $_GET['search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';

// Начинаем формировать запрос
$sql = "SELECT * FROM tasks WHERE 1=1";

// Фильтрация по статусу
if ($status) {
    $sql .= " AND status = '" . $conn->real_escape_string($status) . "'";
}

// Поиск по названию или описанию
if ($search) {
    $sql .= " AND (title LIKE '%" . $conn->real_escape_string($search) . "%' OR description LIKE '%" . $conn->real_escape_string($search) . "%')";
}

// Сортировка
$sql .= " ORDER BY " . $conn->real_escape_string($sort) . " ASC";

// Выполняем запрос
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Title: " . $row["title"] . " - Status: " . $row["status"] . " - Created at: " . $row['created_at'] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>