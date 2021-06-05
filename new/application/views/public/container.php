<?php if ($site_off) { ?>
	<?php $this->load->view('admin/components/site_off/container'); ?>
<?php
} else { ?>
	<!DOCTYPE html>
	<html prefix="og: http://ogp.me/ns#" class="boxed <?= LANG ?>">
	<?php $this->load->view('public/companents/page_header'); ?>

	<body class="<?= (@$sel == 'home') ? 'home-wrapper ' : 'pages-wrapper' ?>">

		<div class="wrapper">
			<?php $this->load->view('public/companents/header'); ?>

			<?php if ($sel == 'home') { ?>


			<?php } ?>

			<?php $this->load->view($body) ?>
			<? $this->load->view('public/companents/footer'); ?>

			<?php if ($sel == 'home') { ?>

			<?php } ?>

		</div>

		<? $this->load->view('public/companents/footer_scripts'); ?>

	</body>

	</html>
<?php
} ?>