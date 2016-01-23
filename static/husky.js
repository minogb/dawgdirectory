$(document).ready(function() {

	var items = [];
	var currID;
		$('path').each(function(i, e) {
			currID = $(e).attr('id');
			if(currID.substr(0,5) == "room-" && !isNaN(currID.charAt(5)))
				items.push($(e));
		});
		
		
		

	$.each(items, function(i, e) {
		e.on('click', function() {
			$('#InfoDiv').css({'visibility' : 'visible'});
			e.attr({
			//	fill : '#123456'
			});
		}); 

		});

});


function search()
{
   var query = document.getElementById("search").value;
   var search_type = document.getElementById("search_type").value;
   if(query == "") {
      document.getElementById("search_results").innerHTML = "";
      return;
   }
   else {
      document.getElementById("search_results").innerHTML = "";
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {

         if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
            document.getElementById("search_results").innerHTML=xmlhttp.responseText;
         }
      }
      xmlhttp.open("GET","index.php?q="+query+"&f="+search_type,true);
      xmlhttp.send();
   }
}
