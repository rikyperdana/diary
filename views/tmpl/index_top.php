<div class="container">
<div>User: <?= $this->session->userdata('userlog')?><?= anchor('/cdiary/logout', 'Keluar', 'Logout')?></div>
<div><a href='<?= site_url('/cdiary/write_diary')?>' class='btn btn-success'>Write Today</a></div>
</div>
