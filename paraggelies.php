<?php
	require_once("bibliopoleioCon.php");
	require_once("lib.php");
	echo bib_login_validation();
	if(!empty($_POST['titlos'])){
	$q1="SELECT * FROM biblia WHERE biblia_id LIKE '".$_POST['titlos']."'";
		$r1=mysqli_query($con,$q1);
		$d1=mysqli_fetch_assoc($r1);
		$q="INSERT INTO paraggelies(paraggelies_id,biblia_id,paraggelies_kataxwrisiDate,ekdotikoi_id,suggrafeis_id)
			VALUES('".md5($_POST['titlos'])."','".$_POST['titlos']."','".$_POST['date']."','".$_POST["ekdotikos"]."','".$d1['suggrafeis_id']."')";
		$r=mysqli_query($con,$q);
	}
	if(isset($_GET['file'])){
		if(!empty($_FILES)){
			if($_FILES["files"]["error"]==0) {			
				$tmp_name = $_FILES["files"]["tmp_name"];
				$str=($_FILES["files"]["name"]);
				$explode=explode(".",$str);
				$arr=end($explode);
				$name=$_GET['file'].'.'.$arr;
				move_uploaded_file($tmp_name, "bibliaDocs/".$_POST['filesHid']."/".$name);			
			}
		}
		header('Location:paraggelies.php');
	}
	if(isset($_GET['del'])){
		foreach(glob('bibliaDocs/'.$_GET['bibId'].'/'.$_GET['del'].'.*') as $file)
			unlink($file);
		$q2="UPDATE paraggelies
			SET paraggelies_".$_GET['del']."=''
			WHERE biblia_id LIKE '".$_GET['bibId']."'";
		$r2=mysqli_query($con,$q2);
		header('Location:paraggelies.php');
	}
	echo head();
?>
	<script>
		// ΠΡΟΣΘΗΚΗ ΠΑΡΑΓΓΕΛΙΑΣ START
		$(document).ready(function(){
			$('#addParBtn').click(function(){
				$("#addParBox").css('display', 'block');
				$("#opacityBlack").css('display', 'block');
			});
		});
		$(document).ready(function(){
			$('#opacityBlack').click(function(){
				$("#addParBox").css('display', 'none');
				$("#opacityBlack").css('display', 'none');
				$(".wordEkdDial").css('display','none');
			});
		});
		// ΠΡΟΣΘΗΚΗ ΠΑΡΑΓΓΕΛΙΑΣ END
		// ΟΜΑΔΙΚΕΣ ΕΡΓΑΣΙΕΣ START
		$(document).ready(function(){
			$('#omadErgBtn').click(function(){
				$("#omadErgList").slideToggle("slow");
			});
		});
		// ΟΜΑΔΙΚΕΣ ΕΡΓΑΣΙΕΣ END
		
	</script>
	<body>
			<?=load_bibliopoleioHeader()?>
			<?php
					echo load_paraggeliesPro();
			?>
			<?=load_footer()?>
	</body>
</html>