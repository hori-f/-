<?php

  $dsn = 'mysql:host=db;dbname=myapp;charset=utf8mb4';
  $user = 'myappuser';
  $password ='myapppass';

  try{
      $pdo = new PDO( $dsn, $user, $password );
  }catch( PDOException $error ){
      echo "接続失敗:".$error->getMessage();
      die();
  }
  $sql = 'select*from todos';
  $stmt = $pdo->query( $sql );
  require_once(__DIR__ . '/../app/functions.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = filter_input(INPUT_GET, 'action');
    switch ($action) {
      case 'delete': 
        deleteValue($pdo);
      break;
      case 'alldelete': 
        alldeleteValue($pdo);
      break;
      default:
    }
  }
  $todos = getTodos($pdo);
  $todos2 = selecedValue($pdo);

 ?> 



<!DOCTYPE html>
<html lang="ja">

<head>
  <a href="index.php"class="back">BACK TO MAIN PAGE</a>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/index3_style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</head>
<body>
  <section class="section0" id="section1">
    <h1 calss=title>ALL DATA LIST</h1>
  </section>

  <!-- 常に横にいるボタン -->
  <div class="flow-nav__wrapper is_flow">
  <div class="flow-navi">
  <div class="section2">
      <h3>データ削除</h3>
      <form action='?action=delete' method='post'>
        <select id=delete name=delete >
          <?php                
            $stmt = $pdo->query("SELECT id FROM todos");
            $unistmt = $stmt->fetchall(PDO::FETCH_NUM);
            $namee = array_column($unistmt,'0');
            foreach ($namee as $key => $val) {
              $namee .="<option value='$val'>".$val."</option>";
            };
            echo $namee;
          ?>
        </select>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>"> 
        <input type="button" value="削除する" class=filter> 
      </form>
      <form action='?action=alldelete' method='post'>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>"> 
        <input type="button" id=alldelete name=alldelete value="ResetData" class=filter> 
      </form>

    </div>
  </div>
  </div>

  <section class="section1" id="section1">
    <h3>これまで記録してきたデータを一覧にして確認することも重要です。</br>
        過去のデータをしっかり比較して自分好みの味を研究しましょう。<h3>

    <div class="section2">
      <h3>検索したいワードを入力して確認したいデータのみを一覧表示させます</h3>
      <h3 class="sub">（例：コロンビア...深炒り...etc）</h3>
      <input type="text" id="search"placeholder="検索ワード入力"> 
      <input type="button" value="絞り込む" id="button" class=filter> 
      <input type="button" value="すべて表示" id="button2"class=unfilter>
    </div>

    

    


  <div class=table>
    <table  id='result' class='tabalestyle'>
    <tr class='trstyle'>
    <th></th><th>No</th><th>日付</th><th>焙煎度</th><th>商品名</th><th>購入店名</th>
    <th>甘味</th><th>酸味</th><th>甘味</th><th>香り</th><th>なめらかさ</th> </tr>
    
  <?php
    $stmt = $pdo->query( $sql );
    while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ){
        echo "\t<tr>\n";
        echo "\t\t<td class='tdstyle'>
          <form action='?action=delete' method='post'>
          <button>x</button>
          <input type=hidden name=id value={$result['id']}>
          </from>
        </td>\n";
        echo "\t\t<td class='tdstyle'>{$result['id']}</td>\n";
        echo "\t\t<td class='tdstyle'>{$result['date']}</td>\n";
        echo "\t\t<td class='tdstyle'>{$result['roastlevel']}</td>\n";
        echo "\t\t<td class='tdstyle'>{$result['beans_name']}</td>\n";
        echo "\t\t<td class='tdstyle'>{$result['shop_name']}</td>\n";
        echo "\t\t<td class='tdstyle'>{$result['num']}<a class='tdstyle2'>/100</a></td>\n";
        echo "\t\t<td class='tdstyle'>{$result['num2']}<a class='tdstyle2'>/100</a></td>\n";
        echo "\t\t<td class='tdstyle'>{$result['num3']}<a class='tdstyle2'>/100</a></td>\n";
        echo "\t\t<td class='tdstyle'>{$result['num4']}<a class='tdstyle2'>/100</a></td>\n";
        echo "\t\t<td class='tdstyle'>{$result['num5']}<a class='tdstyle2'>/100</a></td>\n";
        echo "\t</tr>\n";
      }
        ?>
      </table>

  </div>
    
  </section>
  <section class="section1" id="section1">
    <h1 calss=h1_title>CONFIRM DATA</h1>   
    <form></form>
    <p style="font-size:10px">登録したデータを選択してください</p>
    <form action="?action=pass" method="post">
      <select id=selectedids name=state onchange="changeTerm()">
        <?php                
          $stmt = $pdo->query("SELECT id FROM todos");
          $unistmt = $stmt->fetchall(PDO::FETCH_NUM);
          $namee = array_column($unistmt, '0');
          foreach ($namee as $key => $val) {
            if($val == $dinosaur){
              // ① POST データが存在する場合はこちらの分岐に入る
              $namee .= "<option selected>".$val."-</option>";        
            }else{
              // ② POST データが存在しない場合はこちらの分岐に入る
              $namee .= "<option value='$val'>".$val."</option>";
            }
          };          
          echo $namee;
        ?>
      </select>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>"> 
    </form>
         
  
    <div class="pbox">    
      <div class="bbox"style="width: 400px;">
        <canvas id="chart" width="600" height="400"></canvas>
      </div>
      <div class="abox">
        <dl><dd>"DATE"</dd><dt>日付
          <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                      echo "$todo->date";
                                      endforeach; ?></dt></dt></dl>
          <dl><dd>"ROAST LEVEL"</dd><dt>焙煎度
          <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                      echo "$todo->roastlevel";
                                      endforeach; ?></dt></dt></dl>
          <dl><dd>"BEANS  NAME"</dd><dt>商品名
            <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                        echo "$todo->beans_name";
                                        endforeach; ?></dt></dt></dl>
          <dl><dd>"SHOP  NAME"</dd><dt>購入店名
            <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                        echo "$todo->shop_name";
                                        endforeach; ?></dt></dt></dl>
      </div>
      <div class="cbox">
        
        <dl><dd>"taste1"</dd><dt>苦味
          <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                      echo "$todo->num";
                                      $graphdata= $todo->num;
                                      endforeach; ?></dt><dt class="dtstyle2">%</dt></dt></dl>
        <dl><dd>"taste2"</dd><dt>甘味
          <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                      echo "$todo->num2";
                                      $graphdata2= $todo->num2;
                                    endforeach; ?></dt><dt class="dtstyle2">%</dt></dt></dl>
        <dl><dd>"taste3"</dd><dt>酸味
          <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                      echo "$todo->num3";
                                      $graphdata3= $todo->num3;
                                    endforeach; ?></dt><dt class="dtstyle2">%</dt></dt></dl>
        <dl><dd>"taste4"</dd><dt>香り
          <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                      echo "$todo->num4";
                                      $graphdata4= $todo->num4;
                                    endforeach; ?></dt><dt class="dtstyle2">%</dt></dt></dl>
        <dl><dd>"taste5"</dd><dt>なめらかさ
          <dt class="dtstyle"><?php foreach ($todos2 as $todo):
                                      echo "$todo->num5";
                                      $graphdata5= $todo->num5;
                                    endforeach; ?></dt><dt class="dtstyle2">%</dt></dt></dl>


       <script>  
        var ctx = $('#chart');
        let graphdata =<?php echo $graphdata;?> 
        let graphdata2 =<?php echo $graphdata2;?> 
        let graphdata3 =<?php echo $graphdata3;?> 
        let graphdata4 =<?php echo $graphdata4;?> 
        let graphdata5 =<?php echo $graphdata5;?> 
        var mychart = new Chart(ctx, {
            type: 'radar',
            data: {
                  labels: [
                      '苦味','酸味','甘味','豆の持つ風味','なめらかさ'
                  ],
                  datasets: [{
                      label: '選択したデータ',
                      data: [
                        graphdata,graphdata2,graphdata3,graphdata4,graphdata5
                      ],
                      backgroundColor: 'rgba(255, 234, 0, 0.3)',
                      borderColor: 'rgba(255, 234, 0, 0.9)',
                      borderWidth: 3,
                      pointBackgroundColor: 'rgb(255, 234, 0)',
                  }]
              },
              options: {
                  scale: {
                      ticks: {
                          suggestedMin: 0,
                          suggestedMax: 100,
                          stepSize: 20,                          
                      },
                  }
              }
          });
      </script>
      
      </div> 
      </div>
    </section>

   
<script src="js/index3_move.js"></script>
</body></html>
