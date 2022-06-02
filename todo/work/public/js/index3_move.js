'use strict';
{   //検索
	$(function(){
		$('#button').on("click",function(){
			var re = new RegExp($('#search').val());
			$('#result tbody tr').each(function(){
			var tr = $(this);
			tr.hide();
			$('td', this).each(function(){
				var txt = $(this).html();
				if(txt.match(re) != null){
				tr.show();
				}
			});
			});
		});
		$('#button2').on("click",function(){
			$('#result tr').show();
		});
		});

	// スクロール
	$(window).on('load scroll', function(){
		if ($(window).scrollTop() > 200) {
			$('.is_flow').fadeIn(400);
			} else {
			$('.is_flow').fadeOut(400);
			}
		});

	//ヘッダー	
	$(function () {
	$(window).on('load scroll', function () {
		var $header = $('.section0');

	// 200以上スクロールしたら処理
	if ($(window).scrollTop() > 200) {
	$header.addClass('sticky');
	} else {
	$header.removeClass('sticky');
	}
	});
	});

	const deletes = document.querySelectorAll('input[name=alldelete]');
  deletes.forEach(span => {
    span.addEventListener('click', () => {
      if (!confirm('全てのデータが消えてしまいますがよろしいですか？')) {
        return;
      }
      span.parentNode.submit();
    });
  });

  const checkboxes2 = document.querySelectorAll('select[name=delete]');
  checkboxes2.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkbox.parentNode.submit();
    });
  });  
}