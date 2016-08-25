<div class="container">
	<div class="row">
		<div class="col-md-8">
			<p><?= $diary['text']?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-100">
			<p><?= $diary['mood']?></p>
		</div>
	</div>
	<div class="row">
		<p>
			<?php
				for ($i = 1; $i < 100; $i++) {
					if (!empty($images["img$i"])) {echo $images["img$i"];}
				}
			?>
		</p>
		<p>
			<?php
				if ($this->mroom->cek_diary_love($diary['id']) == FALSE) {
					echo anchor(site_url('/croom/add_diary_love/'.$diary['id']), 'Love It', 'class="btn btn-danger"');
				} else {
					echo anchor(site_url('/croom/rmv_diary_love/'.$diary['id']), 'Unlove It', 'class="btn btn-danger"');
				}
			?>
		</p>
		<br /><br /><br />
	</div>
	<div class="row">
		<div class="col-md-3">
			<p><?= anchor(site_url('/cdiary/daftar'), 'Back to list', 'class="btn btn-info"')?></p>
		</div>
	</div>
</div>
