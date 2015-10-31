<?php include '_head.html.php';?>

<article>
	<h2><?=$this->title();?></h2>
	<p class="news-info">
		<span class="author">autor: <?=$this->author();?></span>
		<span class="time">dodano <time datetime="<?=$this->date('c');?>"><?=$this->date('j F Y \r\. \o H:i');?></time></span>
		<?php if($this->hasPhotos()): ?><span class="photos">zdjęć: <?=$this->photos();?></span><?php endif;?> 
		<span class="views">odsłon: <?=$this->views();?></span>
		<?php if($this->hasCategory()): ?><span class="category-anchor"><?=$this->categoryAnchor();?></span><?php endif;?> 
	</p>

	<div><?=$this->content();?></div>
</article>

<?php include '_foot.html.php';?>