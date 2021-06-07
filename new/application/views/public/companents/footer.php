<footer class="footer">
	<div class="container">
		<div class="footer__main">
			<div class="footer__main__first">
				<a href="<?= site_url() ?>" class="footer__main__first__logo">
					<img src="<?= get_resource_url() ?>/images/ashina-logo2.png" alt>
				</a>
				<div class="footer__main__first__text">
					<p>Общество с ограниченной
						ответственностью</p>
				</div>
			</div>
			<div class="footer__main__contact">
				<div class="footer__main__contact__title">
					<h3><?= lang('contact') ?></h3>
				</div>
				<div class="footer__main__contact__menu">
					<ul>
						<?php
						$tel = strip_tags(_t(getPosts(29, 'content_html'), LANG));
						$email = strip_tags(_t(getPosts(29, 'short_content'), LANG));
						$address = strip_tags(_t(getPosts(29, 'content'), LANG));
						?>
						<li>
							<span><?= lang('phone') ?>: <a href="tel:<?= $tel ?>"><?= $tel ?></a></span>
						</li>
						<li>
							<span><?= lang('email') ?>: <a href="mailTo:<?= $email ?>"><?= $email ?></a></span>
						</li>
						<li>
							<span><?= lang('address') ?>: <a href="#!"><?= $address ?></a>
							</span>
						</li>
					</ul>
				</div>


			</div>
			<div class="footer__main__menu">
				<ul>
					<? foreach($menu as $item):
                            if($item->options){
                                $link = site_url($item->options);
                            }elseif($item->option_2){
                                $link = $item->option_2;
                            }else{
                                $link = site_url('menu/'.$item->alias);
                            }
                            if($item->category_id == 0){
                                ?>

					<li>
						<a href="<?= $link ?>"><?= _t($item->title, LANG) ?></a>
					</li>
					<? } endforeach; ?>
				</ul>
			</div>
			<div class="footer__main__last">
				<div class="footer__main__last__text">
					<p>Наша компания в соц сетях</p>
				</div>
				<div class="footer__main__last__menu">
					<ul>
						<li><a href="#!" class="icon-facebook"></a></li>
						<li><a href="#!" class="icon-instagram"></a></li>
					</ul>
				</div>
			</div>
			<div class="footer__main__copy">
				<span>© 2019 - <?= date('Y') ?>. <?= lang('copy') ?></span>
				<span><?= lang('development') ?>: <a href="https://osg.uz" target="_blank">Online Service Group
					</a></span>
			</div>
		</div>
	</div>

</footer>