var page;
var numPages;

$(document).ready(function(){
	
	$('a.toggle').click(function(){
		
		if($(this).text() == "Hide"){
			$(this).html("Show");
            $(this).parent('div').animate({
                height: 20,
            });
		} else {
			$(this).html("Hide");
            $(this).parent('div').animate({   
                height: 120,
            }); 
		}
	});
	
    getNumberOfArticles(1);
    page = 0;

    $.get("api.php?mode=list", function(data){
        printTable(data);
    }, "json");

    $('select.pagelist').change(function(){
        var pval = $(this).val();
        $('select.pagelist').val(pval);

        page = pval;
        getPage();
    });

    $('a.prev').click(function(){
        if (page > 0){
            page = page-1;
        }

        getPage();
    });

    $('a.next').click(function(){   
        if (page < numPages){ 
            page = page+1;
        }

        getPage();
    });  

    $('body').delegate('a.verify', 'click', function(){
        var id = $(this).attr('id');
        $.get('api.php?mode=remove&p=' + id, function(data){
            $('#' + id).closest('tr').remove();
        }, "json");
    });
});

function printTable(data){
    var tbl = $('#datatable tbody');
    var cl = "odd";

    for(var i=0; i<data.length; i++){
        var s = '<tr class="' + cl + '"><td><a href="http://en.wikipedia.org/wiki/' + data[i][1] + '" target="_blank">' + data[i][1] + '</td>'
                + '<td>' + data[i][2] + '</td><td>' + data[i][3] + '</td><td><a href="#" id="' + data[i][0] + '" class="verify">Remove from list</a></td></tr>';

        tbl.append(s);
        
        if (cl=="odd") {
            cl="even";
        }else {
            cl="odd";
        }
    }

}

function resetTable(){
    $('#datatable tbody').empty();
}

function getPage(){
    $.get("api.php?mode=list&p=" + page, function(data){
        resetTable();
        printTable(data);
    }, "json"); 
}

function getNumberOfArticles(curPage){
    $.get("api.php?mode=count", function(data){
        var num = data.NUM;

        var np = Math.ceil(num/1000);
        var pl = $('select.pagelist');
        
        for(var i=0; i<np; i++){
            var display = i+1;
            pl.append('<option value="' + i + '">Page ' + display + '</option>');
        }

        numPages = np;
    }, "json");
}
