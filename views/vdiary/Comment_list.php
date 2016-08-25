<?php

foreach ($comments as $comment) {
	$decrypted = $this->encryption->decrypt($comment['comment']);
	$stranger = $this->encryption->decrypt($this->mdiary->cek_stranger($comment['from_user']));
	echo 'Stranger '.$stranger.' posted:<br />'.$decrypted.'<br />'.$comment['created'].'<br />';
	echo '<br /><br />';
}

?>
