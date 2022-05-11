<?php if ( is_active_sidebar( 'bip-footer-area' ) ) { ?>  				
	<div id="content-footer-section" class="row clearfix">
		<div class="container">
			<?php dynamic_sidebar( 'bip-footer-area' ) ?>
		</div>	
	</div>		
<?php } ?> 
</div>
<footer id="colophon" class="footer-credits container-fluid row">
	<div class="container">
		<img class="alignleft size-full wp-image-35" src="/bip/wp-content/themes/bip/img/logo_globo.svg" alt="" width="52" height="52" /> <span style="color: #fff;line-height: 26px;display: inline-block;margin-left: 10px;font-size: 12px;"> copyright © 2017</span>
		<ul class="float-right navfooter">
			<li><a href="https://profissionaisdoano.redeglobo.com.br/" title="Profissionais do Ano" target="_blank">Profissionais do Ano</a></li>
			<li><a href="https://emidia.tvglobo.com.br/acessar.do?metodo=verificarUsuarioLogado" title="TV Globo e Midia" target="_blank">TV Globo e Midia</a></li>
			<li><a href="http://negocios8.redeglobo.com.br/Paginas/Midia-Kit.aspx" title="Mídia Kit" target="_blank">Mídia Kit</a></li>
		</ul>
	</div>	
</footer>
<!-- end main container -->
</div>
<?php wp_footer(); ?>


<script src="/bip/wp-content/themes/bip/js/lightslider.js"></script> 
<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="/bip/wp-content/themes/bip/style.css">
<link rel="stylesheet" href="/bip/wp-content/themes/bip/css/jquery.mCustomScrollbar.min.css">
<script src="/bip/wp-content/themes/bip/js/jQuery.verticalCarousel.js"></script>
<script src="/bip/wp-content/themes/bip/js/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script>
<script src="/bip/wp-content/themes/bip/js/jquery.magnific-popup.js"></script>
<script src="/bip/wp-content/themes/bip/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
	$(function () {
	$('.popup-modal').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#username',
		modal: true
	});
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
});
		
$(document).ready(function() {
	/**/

	/*Esconder botão verja mais quando tem menos de 8 post*/
	var divs = $('.row-postlist > div.post-list');
	var length = divs.length;

	if($(divs).length < 9){
		$('.btn-ajax-load').remove();
	};
	
	/*função do carousel Edições*/
	var slider = $("#content-edicoes").lightSlider({
		controls: false,
		item:5,
		loop: false,
		slideMove:1,
		easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
		speed:600,
		pager: false,
		responsive : [
			{
				breakpoint:800,
				settings: {
					item:4,
					slideMove:1,
					slideMargin:6,
				  }
			},
			{
				breakpoint:480,
				settings: {
					item:1,
					slideMove:1
				  }
			}
		]
	});

	$('#goToPrevSlide').on('click', function () {
		slider.goToPrevSlide();
	});
	$('#goToNextSlide').on('click', function () {
		slider.goToNextSlide();
	});	


$('#slides-vitrine').lightSlider({
	gallery:false,
	item:1,
	slideMargin: 0,
	easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
	speed:500,
	pause: 4000,
	pauseOnHover: true,
	pager: false,
	auto:false,
	loop:true,
	onSliderLoad: function() {
		$('#slides-vitrine').removeClass('cS-hidden');
	}  
});
$('#slides-vitrine-interna').lightSlider({
	gallery:false,
	item:1,
	slideMargin: 0,
	easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
	speed:500,
	pause: 4000,
	pauseOnHover: true,
	pager: false,
	auto:false,
	loop:true,
	onSliderLoad: function() {
		$('#slides-vitrine-interna').removeClass('cS-hidden');
	}  
});

/*Função para Comunicado*/
	$("#listacomunicado").bootstrapNews({
		newsPerPage: 3,
		autoplay: false,
		
		onToDo: function () {
			//console.log(this);
		}
	});
	

});
		
</script>	
<script type="text/javascript">

/*Função Video Home*/
	function VideoHome(){ 
	  var video = jQuery('.Video a img').attr('video'),
		  body = '<video width="461" height="260" controls  autoplay=“true”><source src="'+video+'" type="video/mp4"></video>';

	  jQuery('.Video').html(body)
	};

/*Função Load More*/	





  /* initialize scrollbar */ 
  $("#box-twitter-home").mCustomScrollbar({
	theme:"dark-3",
	 scrollButtons:{enable:true}

  });

  /* insert twitter widget js in window load fn */
  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

  
  /*add titulo*/
  
  	// Seleciona o elemento no DOM
	var $wrapper = document.querySelector('#box-twitter-home'),

	// String de texto
	HTMLNovo = '<h2>TWEETS</h2><div class="colored-line-left laranja"></div><div class="clear"></div>';

	// Insere o texto antes do conteúdo atual do elemento
	$wrapper.insertAdjacentHTML('afterbegin', HTMLNovo);

</script>

</body>
</html>
