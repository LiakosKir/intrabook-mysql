<?php
	require_once("bibliopoleioCon.php");
	require_once("lib.php");
	echo bib_login_validation();
	echo head();
?>
	<body>
		<?=load_bibliopoleio_header()?>
		<ul id="bibliopwleio_start_cont">
			<li class="btnHover">
				<a href="suggrafeis.php"><img src="images/suggrafeis_btn.png"/>Συγγραφείς</a>
			</li>
			<li>
				<a href="paraggelies.php"><img src="images/paragkelies_btn.png"/>Παραγγελίες Βιβλίων</a>
			</li>
			<li>
				<a href="#"><img src="images/isbn_btn.png"/>Αιτήσεις ISBN</a>
			</li>
			<li>
				<a href="#"><img src="images/sygkentrwtika_btn.png"/>Συγκεντρωτικά</a>
			</li>
			<li>
				<a href="#"><img src="images/symfwnitika_btn.png"/>Συμφωνητικά Συγγραφέων</a>
			</li>
			<li class="btnHover">
				<a href="pwliseis.php"><img src="images/pwliseis_btn.png"/>Πωλήσεις</a>
			</li>
			<li>
				<a href="#"><img src="images/plirwmes_btn.png"/>Πληρωμές Συγγραφέων</a>
			</li>
			<li class="btnHover">
				<a href="biblia.php"><img src="images/biblia_btn.png"/>Βιβλία</a>
			</li>
			<li class="btnHover">
				<a href="ekdotikoi.php"><img src="images/ekdotes_btn.png"/>Εκδότες</a>
			</li>
		</ul>
		<?=load_footer()?>
	</body>
</html>