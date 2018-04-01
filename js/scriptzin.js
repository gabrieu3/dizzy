/**
 * Scriptzin
 */
/**
 * Function to load content with AJAX
 */
var qtdeMax = 0;
qtPages();
var pageNumber		= 1;

function loadDoc(pagination) {

	  var url = 'src/view/list.php';
	  var param = '?pagination='+pagination;
		var urlPagination = url + param;

		$.ajax({
			url: urlPagination,
			dataType: 'html',
			success: function(html) {
				$('.display-content').append(html);
				$('#loading').hide();
				if (html.length == 0){
					$('#info').show();
				}
			},
			error: function() {
				$('#loading').hide();
				$('#info').style.visibility = "visible";
		 },
		});

}

/**
 * Function to initialize content
 */
function init(){
	loadDoc(0);
}

function qtPages() {
		$.ajax({
			url: 'src/function/qtMoviesPage.php',
			dataType: 'html',
			success: function(html) {
				qtdeMax =  parseInt(html);
			},
		});
}


$(document).ready(function() {
	var win = $(window);
		$('#info').hide();


	// Each time the user scrolls
	win.scroll(function() {

		// End of the document reached?
		if ($(document).height() - win.height() <= win.scrollTop() + 1) {

			pageNumber =  pageNumber + 1 ;

			if( pageNumber <= qtdeMax ){
				$('#loading').show();
			}else {
					pageNumber = qtdeMax + 1; //Always last page more one.
			}

			loadDoc(pageNumber);
		}
	});
});
