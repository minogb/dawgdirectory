function imgClick()
{

	$('path').each(function(i, e) {
      var currID = $(e).attr('id');
		if(currID && currID.substr(0,2) == "UW")
      {
         $(e).click(function(){
            //alert(currID);
            currID = $(this).attr('id').replace("-", " ");
            $.ajax({
               url:"index.php",
               dataType:"json",
               data:{
                  q: currID,
                  f: "room"
               },
               success: function(data) {
                  //alert(data.room + JSON.stringify(data));
			         //$('#InfoDiv').css({'display' : 'block'});

                  
               }
            });
         });
      }
      
   });
}
function rePop()
{

   $("#fname").autocomplete({
      source: function (request, response) { 
         var query = $('#fname').val();
         $.ajax({
            url:"index.php",
            dataType: "json",
            data: {
               q: query,
               f: "search"
            },
            success:function(data) {
               response($.map(data, function(item) {
                  var len = item.length;
                  var lbl = item[0] + ((item[1])? ", " + item[1] + ((item[2])? ", " + item[2]: "") : "");
                  return {
                     value: (len > 2)? item[4].substr(item[4].length-7, 7) : item[0],
                     label: lbl
                  }
               }));
            },
            open: function() {
               $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
            },
            close: function() {
               $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
         });
      },
      select:function(evt, ui) {
         search(ui.item.value);
      }
   });
}

function getImage(floor)
{
   $.get("index.php?q="+floor+"&f=building", function(data){
      $("#mapdiv").empty();
      $("#mapdiv").append(data);
      imgClick();
   });
}

function swapImage()
{

   $("#mapselect").change(function(){
      var val = $(this).val();
      getImage(val);
   });

}

function search(input)
{
   //input in the form "UW1 110" or "UW1-110"
   input = input.replace(" ", "-");
   getImage(input.substring(0, 5));

}

$(document).ready(function() {
   swapImage();
   rePop();
   imgClick();
   getImage("UW1-0");
});
