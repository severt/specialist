<?php

$user = "root";
$pass = "";
// Имя для нашей базы данных
$dbName = 'mydb.sq3';

// Строка подключения к базе данных SQLite3
$dsn = "sqlite:$dbName";

try {
    // Создаем объект PDO
    $pdo = new PDO($dsn, $user, $pass);

    // Проверяем, существует ли база данных (попытка выполнить запрос)
    $pdo->query('SELECT 1');
    echo "База данных '$dbName' уже существует.<br/>";

} catch (PDOException $e) {
    // Если возникло исключение, значит база данных не существует, создаем ее
    if ($e->getCode() === 1064) { // Код ошибки может отличаться в зависимости от драйвера
        echo "База данных '$dbName' создана.<br/>";
    } else {
        echo "Ошибка при создании базы данных: " . $e->getMessage()."<br/>";
    }
}

// Запрос на создание таблицы
$sql = "CREATE TABLE user (
    host TEXT,
    user TEXT
)";

try {
    // Выполнение запроса
    $pdo->exec($sql);
    echo "Таблица 'user' создана успешно!.<br/>";
} catch (PDOException $e) {
    echo "Ошибка при создании таблицы: " . $e->getMessage()."<br/>";
}

// Подготовленный запрос для вставки данных
$stmt = $pdo->prepare("INSERT INTO user (host, user) VALUES (?, ?)");

// Массив данных для вставки
$data = [
    ['localhost', 'Ivan'],
    ['localhost', 'Vasiliy']
];

// Выполнение вставки каждой записи
foreach ($data as $row) {
    $stmt->execute($row);
}

echo "Данные успешно добавлены в таблицу 'user'!"."<br/>";

// SQL-запрос для выборки всех данных из таблицы 'user'
$sql = "SELECT * FROM user";

// Выполнение запроса
$result = $pdo->query($sql);

// Обработка результатов
if ($result !== false) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "Host: " . $row['host'] . ", User: " . $row['user'] . "<br>";
    }
} else {
    echo "Ошибка при выполнении запроса"."<br/>";
}

// Извлекаем данные в ассоциативный массив
$data = $pdo->query('SELECT user,host from user');
while($row = $data->fetch(PDO::FETCH_ASSOC)) {
    echo "<pre>";
    print_r($row);
    echo "</pre><hr>";
}

//Получите данные из базы MySQL в виде объектов класса User
class User {
    public $user, $host;
    function getParams(){
        return ($this->user."|".$this->host);
    }
}

$stmt = $pdo->query('SELECT user,host from user');
$arrObj= $stmt->fetchAll(PDO::FETCH_CLASS,'User');
foreach ($arrObj as $obj){
    echo $obj-> getParams(),"<hr>";
}

//Выполните подготовленный запрос, который найдёт в базе MySQL всех
//пользователей с названием хоста '%'
$host = '%';
$sth = $pdo->prepare('SELECT user,host
    FROM user
    WHERE host = :host');
$sth->bindParam(':host', $host,PDO::PARAM_STR,1);
$sth->execute();
$result = $sth->fetchAll();
echo "<pre>",print_r($result),"</pre>";

// Создайте транзакцию на одновременное добавление двух записей в таблицу
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
    $pdo->exec("insert into user (user,host) values ('Joe', 'somehost')");
    $pdo->exec("insert into user (user,host) values ('John', 'foohost')");
    $pdo->commit();
}catch (Exception $e) {
    $pdo->rollBack();
    echo "Ошибка: " . $e->getMessage();
}