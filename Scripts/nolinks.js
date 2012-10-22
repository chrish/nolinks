$(document).ready(function(){
	
	$('a.toggle').click(function(){
		$(this).parent('div').find('p').toggle();
		
		if($(this).text() == "Hide"){
			$(this).html("Show");
		} else {
			$(this).html("Hide");
		}
	});
	
	$('#datatable').dataTables();
});