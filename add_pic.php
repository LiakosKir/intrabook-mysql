<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	GLOBAL $tmp_error;
		if (!empty($_FILES['eikona'])){
			if (!is_dir('images/'.$_GET['id'])){
				mkdir('images/'.$_GET['id'], 0700);
			}
			if ($_FILES["eikona"]["error"] > 0)
			{
				$tmp_error="Παρουσιάστηκε πρόβλημα κατά το ανέβασμα του αρχείου.";
				$tmp_error.="Κωδικός σφάλματος: " . $_FILES["eikona"]["error"];
			}
			else{
				move_uploaded_file($_FILES["eikona"]["tmp_name"],"images/".$_GET['id']."/".$_FILES["eikona"]["name"]);
			}
		}
	echo head();
?>
<!--  START LIGHTBOX js -->
<script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
<!--  END LIGHTBOX js  -->
<body>
	<?=load_header()?>
	<div id="eidos_view">
		<h1 class="headlines">Προβολή Είδους</h1>
		<table>
			<?php
				mysqli_query($con,"SET NAMES utf8");
					$q="SELECT * FROM eidos 
					INNER JOIN typos ON eidos.typos_id=typos.typos_id
					INNER JOIN ktirio ON eidos.ktirio_id=ktirio.ktirio_id
					INNER JOIN xwros ON eidos.xwros_id=xwros.xwros_id
					INNER JOIN tomeas ON eidos.tomeas_id=tomeas.tomeas_id 
					WHERE eidos_id=".$_GET['id']."";
				$r=mysqli_query($con,$q);				
				$d=mysqli_fetch_assoc($r);
					echo "
						<tr>
							<td>
									<table id='table_ston_table' style='border:none !important;'>
										<tr>
											<td style='text-align:right !important;'>Κωδικός:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".$d['eidos_id']."</td>
										</tr>
										<tr>
											<td style='text-align:right !important;'>Τύπος:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".$d['typos_name']."</td>
										</tr>
										<tr>
											<td style='text-align:right !important;'>Χαρακτηριστικά:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".$d['eidos_xaraktiristika']."</td>
										</tr>
										<tr>
											<td style='text-align:right !important;'>Θέση/Χρήστης:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".$d['eidos_thesi_xristis']."</td>
										</tr>
										<tr>
											<td style='text-align:right !important;'>Ποσότητα:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".$d['eidos_posotita']."</td>
										</tr>
										<tr>
											<td style='text-align:right !important;'>Χώρος:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".$d['xwros_name']."</td>
										</tr>
										<tr>
											<td style='text-align:right !important;'>Τομέας:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".$d['tomeas_name']."</td>
										</tr>
										<tr>
											<td style='text-align:right !important;'>Ημερομηνία Καταχώρησης:</td>
											<td style='text-align:left !important;color:#b1b1b1;'>".date('d/m/Y',$d['hmer_kataxwrisis'])."</td>
										</tr>
									</table>
							</td>
							<td >
								<h1 class='headlines'>Εικόνες</h1>
								<div id='gallery'>
								<ul style=\"list-style:none;width:100%;height:200px;\">";
						//Read Dir
							if(is_dir('images/'.$_GET['id'])){
							if ($handle = opendir('images/'.$_GET['id'])) {								
								/* This is the correct way to loop over the directory. */
								while (false !== ($file = readdir($handle))) {
									if(is_image("images/".$_GET['id']."/".$file))
										echo "<li style='margin:5px;border:solid 1px #ccc;float:left;'>
										<img title='Σβήσιμο Εικόνας' alt='Σβήσιμο Εικόνας' style='cursor:pointer;' src='images/deleteButton.png' onclick=\"location.href='del_image.php?id=".$_GET['id']."&pic=".$file."'\"/>
										<a href=\"images/".$_GET['id']."/$file\">
										<img src=\"images/".$_GET['id']."/$file\" width=\"200\"/>\n</a></li>";
								}
								closedir($handle);
							}
							}
							//End read Dir	
							echo '</ul>
							</div>
							<span style="color:#ff0000;font-size:12px;">'.$tmp_error.'</span><br/>
							<span style="font-size:11px;font-weight:bold;">Προσθήκη νέας εικόνας</span>
								<form enctype="multipart/form-data" action="add_pic.php?id='.$_GET['id'].'" method="post">
									<input type="file" name="eikona"/>
									<input type="submit" value="ΟΚ"/>
								</form>
								
							</td>
						</tr>
						
					';
				
			?>
		</table>
	</div>
	<?=load_footer()?>
</body>
</html>
