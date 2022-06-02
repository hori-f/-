<?php

// Htmlで条件式（PHP）の結果に関する文字列を出力する際のルール
function h($str){return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');}
// CSRF対策　
function createToken()
{
  // sessionのtakenが設定されていなかった場合、
  // ランダムな文字列を32バイト分生成し、バイナリ文字列から16進数にする
  if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
}
// takenのチェックが一致しているか確認する
function validateToken()
{
  if (
    empty($_SESSION['token']) ||
    $_SESSION['token'] !== filter_input(INPUT_POST, 'token')
  ) {
    exit('Invalid post request');
  }
}


// todosに渡す（全てのレコードを取得して、降順に並べる）
function getTodos($pdo)
{
  $stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC");
  $todos = $stmt->fetchAll();
  return $todos;
}


  

function getPdoInstance()
{
  try {
    $pdo = new PDO(
      DSN,
      DB_USER,
      DB_PASS,
      [
        // 例外発生時にcatchさせる
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // DBから受け取った結果をオブジェクト形式で取得する
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        // DBから取得した結果の型をSQLの形式に合わせる
        PDO::ATTR_EMULATE_PREPARES => false,
      ]
    );

    return $pdo;
    // 例外発生時に文字化して終了させる
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  
}

function adddTodo($pdo)
{
  $date  = trim(filter_input(INPUT_POST, 'date'));
  $beans_name  = trim(filter_input(INPUT_POST, 'title'));
  $shop_name  = trim(filter_input(INPUT_POST, 'title2'));
  $roastlevel  = trim(filter_input(INPUT_POST, 'roastlevel'));
  $num  = trim(filter_input(INPUT_POST, 'num'));
  $num2  = trim(filter_input(INPUT_POST, 'num2'));
  $num3  = trim(filter_input(INPUT_POST, 'num3'));
  $num4  = trim(filter_input(INPUT_POST, 'num4'));
  $num5  = trim(filter_input(INPUT_POST, 'num5'));
  
  $stmt = $pdo->prepare("INSERT INTO todos (beans_name,shop_name,num,num2,num3,num4,num5,date,roastlevel) VALUES (?,?,?,?,?,?,?,?,?)");
  $stmt->bindValue(1, $beans_name, PDO::PARAM_STR);
  $stmt->bindValue(2, $shop_name, PDO::PARAM_STR);
  $stmt->bindValue(3, $num, PDO::PARAM_STR);
  $stmt->bindValue(4, $num2, PDO::PARAM_STR);
  $stmt->bindValue(5, $num3, PDO::PARAM_STR);
  $stmt->bindValue(6, $num4, PDO::PARAM_STR);
  $stmt->bindValue(7, $num5, PDO::PARAM_STR);
  $stmt->bindValue(8, $date, PDO::PARAM_STR);
  $stmt->bindValue(9, $roastlevel, PDO::PARAM_STR);
  $stmt->execute();  
  
// ページを再読み込みすると必ずPOSTが実行されてしまう仕様なので以下で避ける
header('Location: ' . SITE_URL);
exit;
}


if(isset($_POST['state'])){
$dinosaur = $_POST['state'];
};
function selecedValue($pdo)
{                  
  $dinosaur2 = '';   
  if(isset($_POST['state'])){
  $dinosaur2 = $_POST['state'];
  };
  $ccc=$dinosaur2;
  $selectedid=(int)$ccc;
  $stmt = $pdo->query("SELECT * FROM todos WHERE id
  ={$selectedid}");
  $todos2 = $stmt->fetchAll();
  return $todos2;
  header('Location: ' . SITE_URL);
  exit;

}
function preselecedValue($pdo)
{                  
  $stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC LIMIT 1");
  $todos3 = $stmt->fetchAll();
  return $todos3;
  header('Location: ' . SITE_URL);
  exit;

}
function deleteValue($pdo)
{                  
  $deletevalue="";
  if(isset($_POST['delete'])){
  $deletevalue = $_POST['delete'];
  };
  $ddd=(int)$deletevalue;
  $stmt = $pdo->prepare("DELETE FROM todos WHERE id={$ddd}");
  $stmt->execute();  
  header('Location:http://localhost:8562/index3.php');
  exit;
}
function alldeleteValue($pdo)
{                  
  $stmt = $pdo->prepare("DELETE FROM todos");
  $stmt->execute();  
  header('Location:http://localhost:8562/index3.php');
  exit;
}



?>

