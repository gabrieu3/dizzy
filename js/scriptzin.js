/**
 * Scriptzin
 */

// var last_known_scroll_position = 0;
// var cont = 0;
// var page = 1;
//
//
// function callEventScroll(){
// 	window.addEventListener('scroll',eventScroll);
// }
//
// function eventScroll(e){
// 	  var hidden = sizeHiddenHeight();
// 	  var paginationHeight = hidden - 50;
// 	  var last_known_scroll_position = window.scrollY;
//
// 	  if (last_known_scroll_position >= paginationHeight) {
// 		  doSomething(last_known_scroll_position);
// 	  }
// }

// function doSomething(scroll_pos) {
// 	//
// 	console.log('Pagina de verdade: ' +page);
// 	page = page + 1;
// 	loadDoc(page);
// 	//conteudo.innerHTML = conteudo.innerHTML + cont + '<br>';
// }


/**
 * Function to find display Height
 *
 **/
// function sizeDisplayHeight(){
// 	console.log('sizeDisplayHeight: ' + window.innerHeight);
// 	return window.innerHeight;
// }

/**
 * Function to find page content size
 **/
// function sizePageContent(){
//
// 	var elmnt = document.getElementById("display-content");
// 	console.log('sizePageContent: ' + elmnt.clientHeight);
// 	return elmnt.clientHeight;
// }

/**
 * Function to find the hidden heigth
 **/
// function sizeHiddenHeight(){
// 	var size = sizePageContent() - sizeDisplayHeight();
// 	console.log('sizeHiddenHeight: ' + size);
// 	return size;
// }

/**
 * Function to load content with AJAX
 */
var qtdeMax = 0;
qtPages();
var pageNumber		= 1;

function loadDoc(pagination) {
	  var xhttp = new XMLHttpRequest();
	  var url = 'src/view/list.php';
	  var param = '?pagination='+pagination;
	  console.log('Pagina de verdade dentro da função: ' +pagination);
	  var display = document.getElementsByClassName('display-content')[0];

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				display.innerHTML = display.innerHTML + this.responseText;
			}
		};
		xhttp.open("GET", url + param, true);
	  xhttp.send();

}

/**
 * Function to initialize content
 */
function init(){
	loadDoc(0);
}

function qtPages() {
	  var xhttp = new XMLHttpRequest();
	  var url = 'src/function/qtMoviesPage.php';
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				qtdeMax =  parseInt(this.responseText);
			}
		};
		xhttp.open("GET", url, true);
	  xhttp.send();
}

//-------------------------------------//
// init Infinte Scroll

// $('.display-content').infiniteScroll({
//   path: function() {
//
// 				  var pageNumber = ( this.loadCount + 1 );
// 					console.log(qtdeMax);
// 					if( pageNumber < qtdeMax ){
// 						return 'src/view/list.php?pagination=' + (pageNumber + 1);
// 				  }
// 					return '';
//
// 				},
//   append: '.post',
//   status: '.page-load-status',
// });


$(document).ready(function() {
	var win = $(window);
	$('#info').hide();

	// Each time the user scrolls
	win.scroll(function() {


		// End of the document reached?
		if ($(document).height() - win.height() <= win.scrollTop() + 1) {


			var urlPagination = 'src/view/list.php?pagination=';

			pageNumber =  pageNumber + 1 ;

			if( pageNumber <= qtdeMax ){
				urlPagination = urlPagination + pageNumber;
				$('#loading').show();
			}else {
					pageNumber = ( pageNumber - 1 );
				urlPagination = 'end';
			}

			$.ajax({
				url: urlPagination,
				dataType: 'html',
				success: function(html) {
					$('.display-content').append(html);
					$('#loading').hide();
				},
				error: function() {
					$('#loading').hide();
		      $('#info').show();
		   },
			});
		}
	});
});
