<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	GLOBAL $kin_index;
	GLOBAL $metakinisi;
	if(!empty($_POST['kinisi']) && !empty($_POST['target'])){
		$metakinisi=$_POST['kinisi'].'|'.time().'|'.$_POST['apo'].'|'.$_POST['target'].'|'.$_POST['sxolia'].'\n';
		$kinisi=$_POST['target'];
		$kinisi_arr=explode("@",$kinisi);
		mysqli_query($con,"SET NAMES utf8");
		$q="UPDATE eidos SET eidos_log=concat(eidos_log,'".$metakinisi."'),tomeas_id=".$kinisi_arr[0].",ktirio_id=".$kinisi_arr[1].",xwros_id=".$kinisi_arr[2]."
		WHERE eidos_id=".$_GET['id'];
		$r=mysqli_query($con,$q);
	}
	$kin_index.='<div style="margin-left:40px;">
					<h1 class="headlines">Μετακίνηση Είδους</h1>
					<form id="kinisi_index" action="metakinisi.php" method="post">
						Δώσε BARCODE: <input type="text" id="kwdikos" name="kwdikos" AUTOCOMPLETE="off"/>
						<input type="submit" value="ΟΚ"/>
					</form>
				</div>';
	if (!empty($_POST['kwdikos'])){
		$q1="SELECT eidos_id
		FROM eidos
		WHERE eidos_id LIKE '".$_POST['kwdikos']."'";
		$r1=mysqli_query($con,$q1);
			if (mysqli_num_rows($r1)==1)
				header('Location:metakinisi.php?id='.$_POST['kwdikos']);
			else
				$kin_index.='<span style="color:#ff0000;margin:10px 0 0 20px;float:left;">Ο κωδικός που πληκτρολογήσατε δεν υπάρχει.Προσπαθήστε ξανα.</span>';
		}
		else
			$kin_index;
	echo head();
?>
<body>
<?=load_header()?>
	<?php
		if (isset($_GET['id']))
			echo kinisi_form();
		else
			echo  $kin_index;
	?>
	<?=load_footer()?>
</body>