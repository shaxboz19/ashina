<?php  echo '<?xml version="1.0" encoding="utf-8"?>' . "\n"; ?>
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
<channel>
<title><?php echo $feed_name; ?></title>
<description><?php echo $page_description; ?></description>
<link><?php echo $feed_url; ?></link>
<image>
<url></url>
<title><?php echo $feed_name; ?></title>
<link><?php echo $feed_url; ?></link>
</image>
<generator>RSS</generator>
<?php foreach($news as $item): ?>
<item>
<title><![CDATA[<?=_t($item->title, LANG)?>]]></title>
<link><?=site_url("news/$item->alias")?></link>
<guid><?=site_url("news/$item->alias")?></guid>
<description><![CDATA[<?=removeTags(char_lim(_t($item->content, LANG), 200)) ?>]]></description>
<pubDate><?//=mysql_date($item->created_on)?><?=$item->created_on;?></pubDate>
</item>
<?php endforeach; ?>
</channel>
</rss>