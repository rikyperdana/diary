<?php

foreach ($comments as $comment) {
	$decrypted = $this->encryption->decrypt($comment['comment']);
	echo 'Stranger '.$comment['stranger'].' posted:<br />'.$decrypted.'<br />'.$comment['created'].'<br />';
	echo '<br /><br />';
}

?>
