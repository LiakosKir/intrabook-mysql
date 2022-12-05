<?php
	require_once("connection.php");
	require_once("lib.php");
	echo login_validation();
	echo head();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
	<?=load_header()?>
	<?php 
	function cmp($a, $b)
{
    $a = preg_replace('@^(a|an|the) @', '', $a);
    $b = preg_replace('@^(a|an|the) @', '', $b);
    return strcasecmp($a, $b);
}

    if (!empty($_GET['id'])){
		mysqli_query($con,"SET NAMES utf8");
		$q="SELECT xwros.xwros_name, typos.typos_name, SUM( eidos.eidos_posotita ) AS posotita
			FROM eidos
			INNER JOIN xwros ON eidos.xwros_id = xwros.xwros_id
			INNER JOIN typos ON eidos.typos_id = typos.typos_id
			WHERE eidos.ktirio_id LIKE '".$_GET['id']."'
			GROUP BY eidos.xwros_id, eidos.typos_id
			ORDER BY xwros.xwros_name, typos.typos_name";		
		$r=mysqli_query($con,$q);
		
		$qeidh="SELECT typos.typos_id, typos_name
			FROM `typos`
			INNER JOIN eidos ON eidos.typos_id = typos.typos_id
			INNER JOIN ktirio ON eidos.ktirio_id = ktirio.ktirio_id
			WHERE ktirio.ktirio_id = '".$_GET['id']."'
			GROUP BY typos_name
			ORDER BY typos_name";
		$reidh=mysqli_query($con,$qeidh);
		$arr_eidh=array();
		while($deidh=mysqli_fetch_assoc($reidh)){			
			$arr_eidh[]=$deidh['typos_name'];			
		}
		
		echo '<table border="1">';			
		$flg=false;
		$tmp="label";
		$arr1[$tmp]=array();
		while($d=mysqli_fetch_assoc($r)){
			if($tmp!=$d['xwros_name'])
				foreach($arr_eidh as $id=>$val){							
							if(!array_key_exists($val,$arr1[$tmp])){								
								$arr1[$tmp][$val]='-';
							}											
				}												
						
			$arr1[$d['xwros_name']][$d['typos_name']]=$d['posotita'];			
			$tmp=$d['xwros_name'];
		}	
		
				foreach($arr_eidh as $id=>$val){											
					if(!array_key_exists($val,$arr1[$tmp])){
								
							$arr1[$tmp][$val]='-';
					}
				}							
		
		foreach($arr1 as $id=>$arrsort){	
			ksort($arr1[$id]);
		}			
	}
	echo '<h1 class="headlines">Γενική Προβολή</h1>
		<table id="gen_provoli"><tr><td>&nbsp;</td>';
	foreach($arr1['label'] as $id=>$val)
		echo '<td>'.$id.'</td>';
	echo '</tr>';
	foreach($arr1 as $id=>$val){
		if($id!="label"){
		echo '<tr><td>'.$id.'</td>';
		foreach($val as $id2=>$tem){
			if($tem!='-'){
				echo '<td class="grey" ><a href="eidiki_provoli.php?xwros='.$id.'&eidos='.$id2.'">'.$tem.'</a></td>';
			}
			else{
				echo '<td>'.$tem.'</td>';
			}
			
		}
		echo '</tr>';
		}
	}
	echo '<tr>
			<td>Σύνολα</td>';
		foreach($val as $id2=>$tem){
			$q="SELECT SUM( eidos.eidos_posotita ) AS posotita
			FROM eidos
			INNER JOIN xwros ON eidos.xwros_id = xwros.xwros_id
			INNER JOIN typos ON eidos.typos_id = typos.typos_id
			WHERE typos.typos_name LIKE '".$id2."'
			AND eidos.ktirio_id LIKE '".$_GET['id']."'";
			$r=mysqli_query($con,$q);
			$d=mysqli_fetch_assoc($r);
			echo '<td class="dark_grey"><b>'.$d['posotita'].'</b></td>';
		}
	echo '</tr>
	</table>
	';
	?>
	<?=load_footer()?>
</body>
</html>