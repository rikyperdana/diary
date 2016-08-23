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
	</div>
	<div class="row">
		<div class="col-md-3">
			<p><?= anchor(site_url('/cdiary/daftar'), 'Back to list', 'class="btn btn-info"')?></p>
		</div>
	</div>
</div>
