'use strict';{

  


    // input要素
    const inputElem = document.getElementById('number');
    // 埋め込む先の要素
    const currentValueElem = document.getElementById('currentvalue');
    // 現在の値を埋め込む関数
    const setCurrentValue = (val) => {
      currentValueElem.innerText = val;
    }
    // inputイベント時に値をセットする関数
    const rangeOnChange = (e) =>{
      setCurrentValue(e.target.value);
    }
    inputElem.addEventListener('input', rangeOnChange);
    setCurrentValue(inputElem.value);

    
  
  const inputElem2 = document.getElementById('number2');
  const currentValueElem2 = document.getElementById('currentvalue2');
  const setCurrentValue2 = (val) => {
    currentValueElem2.innerText = val;};
  const rangeOnChange2 = (e) =>{
    setCurrentValue2(e.target.value);};
    inputElem2.addEventListener('input', rangeOnChange2);
    setCurrentValue2(inputElem.value);

    
  const inputElem3 = document.getElementById('number3');
  const currentValueElem3 = document.getElementById('currentvalue3');
  const setCurrentValue3 = (val) => {
    currentValueElem3.innerText = val;  };
  const rangeOnChange3 = (e) =>{
    setCurrentValue3(e.target.value);  };
    inputElem3.addEventListener('input', rangeOnChange3);
    setCurrentValue3(inputElem.value);

  const inputElem4 = document.getElementById('number4');
  const currentValueElem4 = document.getElementById('currentvalue4');
  const setCurrentValue4 = (val) => {
    currentValueElem4.innerText = val;  };
  const rangeOnChange4 = (e) =>{
    setCurrentValue4(e.target.value);  };
    inputElem4.addEventListener('input', rangeOnChange4);
    setCurrentValue4(inputElem.value);

  const inputElem5 = document.getElementById('number5');
  const currentValueElem5 = document.getElementById('currentvalue5');
  const setCurrentValue5 = (val) => {
    currentValueElem5.innerText = val;  };
  const rangeOnChange5 = (e) =>{
    setCurrentValue5(e.target.value);  };
    inputElem5.addEventListener('input', rangeOnChange5);
    setCurrentValue5(inputElem.value);

    
  const inputElem0 = document.getElementById('selectedids');
  const currentValueElem0 = document.getElementById('selectedid');
  const setCurrentValue0 = (val) => {
    currentValueElem0.innerText = val;  };
  const rangeOnChange0 = (e) =>{
    setCurrentValue0(e.target.value);  };
    window.onload = () => {
      inputElem0.addEventListener('change', rangeOnChange0);
      setCurrentValue0(inputElem.value);
    }

 
    

const regist = document.querySelectorAll('.regist');
  regist.forEach(span => {
    span.addEventListener('click', () => {
      span.parentNode.submit();
    });
  });


  const checkboxes2 = document.querySelectorAll('select[name=state]');
  checkboxes2.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkbox.parentNode.submit();
    });
  });  


const input = document.getElementById('title');
const input2 = document.getElementById('title2');
const result = document.getElementById('gettextlength');
const result2 = document.getElementById('gettextlength2');
const button = document.querySelector("#submit-btn");
const p = document.querySelector("#helper-text");
const p2 = document.querySelector("#helper-text2");
input.addEventListener('keyup', function() {
  result.textContent = input.value.length;
  if (input.value.length>20) {
    p.textContent = "Over!!!!!";
    button.disabled = true;
  } else{
    p.textContent =result.textContent+'/20';
    button.disabled = false;
  }
 });
input2.addEventListener('keyup', function() {
  result2.textContent = input2.value.length;
  if (input2.value.length>20) {
    p2.textContent = "Over!!!!!";
    button.disabled = true;
  } else{
    p2.textContent =result2.textContent+'/20';
    button.disabled = false;
  }
 });


	// スクロール
	$(window).on('load scroll', function(){
		if ($(window).scrollTop() > 200) {
			$('.is_flow').fadeIn(200);
			} else {
			$('.is_flow').fadeOut(200);
			}
		});

	//ヘッダー	
	$(function () {
	$(window).on('load scroll', function () {
		var $header = $('.section0');

	// 100以上スクロールしたら処理
	if ($(window).scrollTop() > 100) {
	$header.addClass('sticky');
	} else {
	$header.removeClass('sticky');
	}
	});
	});

  //自動スライド
  $(window).on('load', function(){

    const chara1 = document.querySelector('#chara1')
    var delayTime = 7000;
    var position = $('#tab-es6').offset().top-500;
    
    $("html, body").delay(delayTime).animate({ scrollTop: position }, 1000);
    // フェードアウト
      chara1.animate(
        // キーフレーム
        [
          {opacity: 1},
          {opacity: 0}
        ],
        // オプション
        {
          duration: 3000,      // アニメが終了するまでの時間(ミリ秒)
          fill: 'forwards'    // アニメ完了後に最初の状態に戻さない
        }
      );
    })

 

    }