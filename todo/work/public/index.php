<?php
// ファイルを参照するときにrequier使う。
// 絶対パスの方が連携が強いのでDIRを先頭に付けてそこから/出始める相対パスを表現する
require_once(__DIR__ . '/../app/config.php');
require_once(__DIR__ . '/../app/functions.php');
// これでトークンの作成を実行する
createToken();
$pdo = getPdoInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    {
  validateToken();
  $action = filter_input(INPUT_GET, 'action');

  switch ($action) {
    case 'addd':
      adddTodo($pdo);
      header('Location: ' . SITE_URL);
      exit;
      break;
    case 'pass':
      selecedValue($pdo);
      break;
    default:
  }
}
}
// データベースにアクセスしてtodosにデータを取得する
$todos = getTodos($pdo);
$todos2 = selecedValue($pdo);
$todos3 = preselecedValue($pdo);
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/button.css">
  <link rel="stylesheet" href="css/animation.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
            
  <meta name="viewport" content="width=device-width,initial-scale=1">
<!-- width=device-width：コンテンツの幅はデバイスの幅に合わせるよという記述
initial-scale=1：画面幅が違う時の倍率設定。この場合は倍率を変えない -->

</head>

<body>    
  <section class="section0" id="section1" >
    <h1 >COFFEE DRIP RECIPE</h1>
  </section>
  <section><div class="et-hero-tabs">
    <a class="et-hero-tab" href="#tab-es5">HOW TO USE</a>
    <a class="et-hero-tab" href="#tab-es6">RECORD DATA</a>
    <a class="et-hero-tab" href="#tab-es7">CONFIRM DATA</a>
    <a class="et-hero-tab" href="index3.php">ALL DATA LIST</a>
    <span class="et-hero-tab-slider"></span>
  </div></section>

  <main class="et-main">

  <section class="et-slide1" id="tab-es5" >
    <div class="box" id=chara1>
      <div class="drop-container">
        <h1>COFFEE DRIP RECIPE</h1>
        <div class="drop"></div>
      </div>
    </div>
    <h1 calss=h1_title>このアプリについて</h1>                                               
    <h3>このアプリは毎日淹れるコーヒーをもっとおいしく入れるにはどうしたらいいのか</br>
        毎回メモをとらずともデータベース上で管理できるアプリです。</br>
        味という感覚をあえて数値化することで</br>
        前とどのように異なるのか比較しながら自分好みの味をとことん追い求めることができます。</h3>    
    <h1 calss=h1_title>HOW TO USE</h1>
    <di class="di_howtouse">
      <dd class="dd_howtouse">STEP1</br>"RECORD DATA"</dd><dt class="dt_howtouse">今日飲んだコーヒーの情報を入力</dt>
                                                          <dt class="dt_howtouse">※前回情報と比較できるので数値化しやすくなっています。</dt>
      <dd class="dd_howtouse">STEP2</br>"CONFIRM DATA"</dd><dt class="dt_howtouse">登録順に番号が自動で振られるためプルダウンからナンバーを習得</dt>
      <dd class="dd_howtouse">STEP3</br>"LETS DRIP YOUR ORIGINAL COFFEE!!"</dd></dd><dt class="dt_howtouse">これまでのデータを振り返って今日のおいしいコーヒータイムを楽しみましょう</dt>    
    </di>
    <a class="start" href="#tab-es6">START</a>
  </section>  

  <section class="et-slide2" id="tab-es6">
    <h1 calss=h1_title>RECORD DATA</h1>
    <h3>todays coffes tastes </h3>
    
    <div class="pbox">    
      <div class="bbox"style="width: 400px;">
        <canvas id="prechart" width="600" height="400"></canvas>
        <?php foreach ($todos3 as $todo):
          $pregraphdata=$todo->num;
          $pregraphdata2=$todo->num2;
          $pregraphdata3=$todo->num3;
          $pregraphdata4=$todo->num4;
          $pregraphdata5=$todo->num5;
          endforeach;?>
          
        <script>  
        var pregraphdata0 = document.getElementById("number");
        console.log(pregraphdata0.value);
          // var input = document.getElementById('number2');
          // input.addEventListener('change', (e) => {
          // let pregraphdata0 =input.value; 
          // }); 
          // alert( this.pregraphdata0);
        </script>   
        <script>         
          var ctx = $('#prechart');
          let pregraphdata =<?php echo $pregraphdata;?> 
          let pregraphdata2 =<?php echo $pregraphdata2;?> 
          let pregraphdata3 =<?php echo $pregraphdata3;?> 
          let pregraphdata4 =<?php echo $pregraphdata4;?> 
          let pregraphdata5 =<?php echo $pregraphdata5;?> 
          var mychart = new Chart(ctx, {
              type: 'radar',
              data: {
                    labels: [
                        '苦味','酸味','甘味','豆の持つ風味','なめらかさ'
                    ],
                    datasets: [{
                        label: '前回のデータ',
                        data: [
                          pregraphdata,pregraphdata2,pregraphdata3,pregraphdata4,pregraphdata5
                        ],
                        backgroundColor: 'rgba(255, 234, 0, 0.3)',
                        borderColor: 'rgba(255, 234, 0, 0.9)',
                        borderWidth: 3,
                        pointBackgroundColor: 'rgb(255, 234, 0)',
                    },{
                        label: '前回のデータ',
                        data:[
                          // graphdata,graphdata2,graphdata3,graphdata4,graphdata5
                          1,1,1,1,1
                          ],
                        backgroundColor: 'rgba(2, 234, 0, 0.3)',
                        borderColor: 'rgba(2, 234, 0, 0.9)',
                        borderWidth: 3,
                        pointBackgroundColor: 'rgb(2, 234, 0)',
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
          <dl><dd>"DATE"</dd><dt>日付
          <dt class="dtstyle"><?php foreach ($todos3 as $todo):
                                      echo "$todo->date";
                                      endforeach; ?></dt></dt></dl>
          <dl><dd>"ROAST LEVEL"</dd><dt>焙煎度
          <dt class="dtstyle"><?php foreach ($todos3 as $todo):
                                      echo "$todo->roastlevel";
                                      endforeach; ?></dt></dt></dl>
          <dl><dd>"BEANS  NAME"</dd><dt>商品名
            <dt class="dtstyle"><?php foreach ($todos3 as $todo):
                                        echo "$todo->beans_name";
                                        endforeach; ?></dt></dt></dl>
          <dl><dd>"SHOP  NAME"</dd><dt>購入店名
            <dt class="dtstyle"><?php foreach ($todos3 as $todo):
                                        echo "$todo->shop_name";
                                        endforeach; ?></dt></dt></dl>
      </div>
      <div class="dbox">         
        <form action="?action=addd" class="input-text" method="post"> 
          <h3 class="regiserunit">date</h3>
          <input type="date" name="date" value="<?php echo date('Y-m-d');?>">
          <h3 class="regiserunit">beansName</h3>
          <input type="text" name="title" placeholder="豆の名前を入力" id=title>
          <p class=gettextlength id="helper-text"><span id="gettextlength"></span>/20</p>
          <h3 class="regiserunit">shopName</h3>
          <input type="text" name="title2" placeholder="豆の名前を入力" id=title2>
          <p class=gettextlength id="helper-text2"><span id="gettextlength2"></span>/20</p>
          <h3 class="regiserunit">roastLevel</h3>
          <select id=selectedids name="roastlevel"class="roastlevel"value="未選択"><option selected>---</option><option value=浅煎り>浅煎り</option><option>中煎り</option><option>深煎り</option></select>
          <p>苦味<span id="currentvalue" class=input-range2></span>/100%</p>
          <input type="range" class =input-range1  id="number"  name=num min="1" max="100">
          <p>甘味<span id="currentvalue2"class=input-range2></span>/100%</p>
          <input type="range" class =input-range1  id="number2"  name=num2 min="1" max="100">
          <p>酸味<span id="currentvalue3"class=input-range2></span>/100%</p>
          <input type="range" class =input-range1  id="number3"  name=num3 min="1" max="100">
          <p>香り<span id="currentvalue4"class=input-range2></span>/100%</p>
          <input type="range" class =input-range1  id="number4"  name=num4 min="1" max="100">
          <p>なめらかさ<span id="currentvalue5"class=input-range2></span>/100%</p>
          <input type="range" class =input-range1  id="number5"  name=num5 min="1" max="100">
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">            
          <button id="submit-btn">登録</button>
        </from>
      </div>
    </div>
      
  </section>
  <section class="et-slide1">
    <h3>本アプリをご利用いただきありがとうございます。</br>
        利用いただいた皆様のコーヒーライフが少しでもいいものになりますように。</br></h3>
  </section>

  </main>



   
  <script src="js/third.js"></script>
</body>
</html>