/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$(function(){
	$('#sidebar nav li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('#sidebar ul')){
			event.preventDefault();
			$('#sidevar nav ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});
