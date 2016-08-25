<?= form_open('croom/comment_insert');?>

<?= form_hidden('id_diary', $id);?>

<?= form_label('Comment')?>
<?= form_input('comment', '', 'class="form-control"');?>

<?= form_submit('submit', 'Submit', 'class=btn btn-success');?>
<?= form_close();?>
