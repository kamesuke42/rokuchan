<?php
$dsn = 'mysql:host=db;dbname=rokuchan';
$user = 'dbuser';
$password = 'userpass';

try {
    $db = new PDO($dsn, $user, $password);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $content = $_POST['content'];
        $sql = 'insert into rokuchan (name, content) values (?, ?)';
        $stmt = $db->prepare($sql);
        $flag = $stmt->execute([$name, $content]);
    }
} catch (PDOException $e) {
    var_dump($e);
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>6chan</title>
        <style>
            .name {
                color: gray;
            }
            .posted {
                margin-top: 15px;
            }
            .posted p {
                margin: 0;
            }
            #post-form {
                margin-top: 30px;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1>6chan</h1>
        </header>
        <main>
            <div>
<?php
    $sql = 'select name, content from rokuchan';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<div class=\"posted\">";
        echo "<p class=\"name\">".htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8')."</p>";
        echo "<p>".htmlspecialchars($result['content'], ENT_QUOTES, 'UTF-8')."</p>";
        echo "</div>";
    }
?>
            </div>
            <hr>
            <div id="post-form">
                <form action="/" method="post">
                    <div>
                        <label for="name">ハンドルネーム</label>
                        <input name="name" type="text" required></input>
                    </div>
                    <div>
                        <label for="content">本文</label>
                        <textarea name="content" required></textarea>
                    </div>
                    <button>送信</button>
                </form>
            </div>
        </main>
    </body>
</html>
