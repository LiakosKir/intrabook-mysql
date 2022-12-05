// ΠΑΡΑΓΓΕΛΙΕΣ ANIMATE START
		$(document).ready(function(){
			$('#arrowLeftBtn').click(function(){
				var str=$("#parTableAnim").css('left');				
				if(str.substr(0,str.length-2)<=-1 && $("#parTableAnim").css('left')!='auto')					
					$("#parTableAnim").animate({left:'+=1220px'},1000);
			});
			
		});
		$(document).ready(function(){
			$('#arrowRightBtn').click(function(){
				var str=$("#parTableAnim").css('left');						
				if(str.substr(0,str.length-2)>=-1200 || $("#parTableAnim").css('left')=='auto')
					$("#parTableAnim").animate({left:'-=1220px'},1000);
			});
		});
		$(document).ready(function(){
			$('#arrowLeftBtn').mouseover(function(){
				var str=$("#parTableAnim").css('left');		
				if(str.substr(0,str.length-2)<=-1 && $("#parTableAnim").css('left')!='auto'){
					document.getElementById('arrowLeftBtn').src='images/arrow_left.png';
					document.getElementById('arrowLeftBtn').style.cursor='pointer';
				}
				else
					document.getElementById('arrowLeftBtn').style.cursor='';
			});
			$('#arrowLeftBtn').mouseout(function(){
				document.getElementById('arrowLeftBtn').src='images/arrow_left_disabled.png';
			});
		});
		$(document).ready(function(){
			$('#arrowRightBtn').mouseover(function(){
				var str=$("#parTableAnim").css('left');				
				if(str.substr(0,str.length-2)>=-1200 || $("#parTableAnim").css('left')=='auto'){
					document.getElementById('arrowRightBtn').src='images/arrow_right.png';
					document.getElementById('arrowRightBtn').style.cursor='auto';
				}
			});
			$('#arrowRightBtn').mouseout(function(){
				document.getElementById('arrowRightBtn').src='images/arrow_right_disabled.png';
			});
		});
		// SECOND BTN START
		$(document).ready(function(){
			$('#arrowLeftBtnStart').click(function(){
				var str=$("#parTableAnim").css('left');				
				if(str.substr(0,str.length-2)<=-1 && $("#parTableAnim").css('left')!='auto')					
					$("#parTableAnim").animate({left:'0px'},'slow');
			});
			
		});
		$(document).ready(function(){
			$('#arrowRightBtnEnd').click(function(){
				var str=$("#parTableAnim").css('left');				
				if(str.substr(0,str.length-2)>=-1500 || $("#parTableAnim").css('left')=='auto')
					$("#parTableAnim").animate({left:'-100px'},'slow');
			});
		});
		$(document).ready(function(){
			$('#arrowLeftBtnStart').mouseover(function(){
				var str=$("#parTableAnim").css('left');				
				if(str.substr(0,str.length-2)<=-1 && $("#parTableAnim").css('left')!='auto'){
					document.getElementById('arrowLeftBtnStart').src='images/arrow_start_left.png';
					document.getElementById('arrowLeftBtnStart').style.cursor='pointer';
				}
				else
					document.getElementById('arrowLeftBtnStart').style.cursor='';
			});
			$('#arrowLeftBtnStart').mouseout(function(){
				document.getElementById('arrowLeftBtnStart').src='images/arrow_start_left_disabled.png';
			});
		});
		$(document).ready(function(){
			$('#arrowRightBtnEnd').mouseover(function(){
				var str=$("#parTableAnim").css('left');				
				if(str.substr(0,str.length-2)>=-1500 || $("#parTableAnim").css('left')=='auto'){
					document.getElementById('arrowRightBtnEnd').src='images/arrow_end_right.png';
					document.getElementById('arrowRightBtnEnd').style.cursor='pointer';
				}
			});
			$('#arrowRightBtnEnd').mouseout(function(){
				document.getElementById('arrowRightBtnEnd').src='images/arrow_end_right_disabled.png';
			});
		});
		// ΠΑΡΑΓΓΕΛΙΕΣ ANIMATE END
		// TEXTS&CHECKS START
		function setValText(col,id){
			var l=document.getElementById('parText'+id+col).value;
			var k=document.getElementById('parText'+id+col).value=='';
			$('#parText'+id+col).load('paraggeliesAjax.php?id='+id+'&col='+col+'&value='+l, function(){
				alert('Το πεδίο άλλαξε');
			});
		}
		function setColor(id,col){
			$("#parText"+id+col).css('color', '#000');
		}
		function unsetColor(id,col){
			$("#parText"+id+col).css('color', '#999');
		}
		function setValButton(id,col){
			$('#content'+id+col).load('paraggeliesAjax.php?id='+id+'&col='+col);
			$('#hidFileWord'+id+col).click();
		}
		function setValButtonLog(id,col,log,post){			
			$('#content'+id+col).load('paraggeliesAjax.php?id='+id+'&col='+col+'&log='+log,{'post':post} ,
			function() {
			$('#wordEkdDial'+id).css('display','none');
			$('#opacityBlack').css('display','none');
		});
			
		}
		function setValButtonLogDial(id){
			$('#opacityBlack').css('display','block');
			$('#wordEkdDial'+id).css('display','block');
		}
		
		// TEXTS&CHECKS END
		// TITLOS CHECK
		$(document).ready(function(){
			$('#titlosSygAll').click(function(){
				if($('#titlosSygAll').attr('checked'))
					$('.titlosSyg').attr('checked', 'checked');
				else
				$('.titlosSyg').removeAttr('checked');
			});
		});
		// TITLOS CHECK END
		// HIDDEN INPUT
		
		// HIDDEN INPUT END
		