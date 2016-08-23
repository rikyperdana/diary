<?php

foreach ($comments as $comment) {
	echo 'Stranger '.$comment['stranger'].' posted:<br />'.$comment['comment'].'<br />'.$comment['created'].'<br />';
	echo '<br /><br />';
}

?>
