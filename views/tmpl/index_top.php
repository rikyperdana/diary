<div class="container">
<div>User: <?= $this->muser->id_user_name($this->session->userdata('id_user'))?><?= anchor('/cdiary/logout', 'Keluar', 'Logout')?></div>
<div><a href='<?= site_url('/cdiary/write_diary')?>' class='btn btn-success'>Write Today</a></div>
</div>
