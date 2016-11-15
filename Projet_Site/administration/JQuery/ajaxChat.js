$(document).ready(function(){

recupmessages();
online();
	function recupmessages()
	{
			//var e=1;
		$.post(
			"JQuery/afficheChat.php",//{e:e},
			function(data){
				//var result =jQuery.parseJSON(data);
				//var i=0;
				//while (i<10){
				$('#console').html(data);//'<h4>'+result[i].pseudo+'</h4>-['+result[i].tim+'] :<br><p>'+result[i].msg+'</p>');
				//i++;}

				//alert(data);
			//}
		
			});
	}
	function online()
	{
		$.post("JQuery/online.php",{pseudo:pseudo},
		function(data){
			$('#enligne').html(data);

		});
	};

	
setInterval(recupmessages,2000);
setInterval(online(),1000);

});
			//x
				
			/*
				
			}*/
			

		
	
