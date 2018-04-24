<style type="text/css">
	.daftar-club{
		font-size: 14px;
		padding: 5px;
	}
</style>

<?php foreach ($club as $cl): ?>
	<div class="daftar-club" id="cl-<?= $cl->id_club; ?>" onclick="select_club(<?= $cl->id_club; ?>)">
		<?= $cl->name; ?>
	</div>
<?php endforeach ?>
