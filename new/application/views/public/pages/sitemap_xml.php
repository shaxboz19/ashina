<?php header('Content-type: text/xml'); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">


<url>
  <loc><?=base_url()?></loc>
</url>
<url>
  <loc><?=base_url().'ru'?></loc>
</url>
<url>
  <loc><?=base_url().'oz'?></loc>
</url>
<url>
  <loc><?=base_url().'en'?></loc>
</url>


<? foreach($menu as $item): ?>

<url>
<?php if($item->options){ ?>
  <loc><?=base_url().'ru/'.$item->options?></loc>
<?php } else {?>
  <loc><?=base_url().'ru/menu/'.$item->alias?></loc>
<?php }?>
</url>
<url>
  <?php if($item->options){ ?>
  <loc><?=base_url().'oz/'.$item->options?></loc>
<?php } else {?>
  <loc><?=base_url().'oz/menu/'.$item->alias?></loc>
<?php }?>
  <?php if($item->options){ ?>
  <loc><?=base_url().'en/'.$item->options?></loc>
<?php } else {?>
  <loc><?=base_url().'en/menu/'.$item->alias?></loc>
<?php }?>
</url>


<? endforeach; ?>
<? foreach($footer_menu as $item): ?>

<url>
<?php if($item->options){ ?>
  <loc><?=base_url().'ru/'.$item->options?></loc>
<?php } else {?>
  <loc><?=base_url().'ru/pages/'.$item->alias?></loc>
<?php }?>
</url>
<url>
  <?php if($item->options){ ?>
  <loc><?=base_url().'oz/'.$item->options?></loc>
<?php } else {?>
  <loc><?=base_url().'oz/pages/'.$item->alias?></loc>
<?php }?>
  <?php if($item->options){ ?>
  <loc><?=base_url().'en/'.$item->options?></loc>
<?php } else {?>
  <loc><?=base_url().'en/pages/'.$item->alias?></loc>
<?php }?>
</url>


<? endforeach; ?>

</urlset>