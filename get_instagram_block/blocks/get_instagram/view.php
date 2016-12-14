<?php defined("C5_EXECUTE") or die("Access Denied.");?>
<?php if($photos_data):?>
<div class="gi-wrapper">
	<ul class="gi-wrapper--photo">
	<?php
	foreach($photos_data as $photo):
		$id = $photo->id;
		$tags = $photo->tags;
		$type = $photo->type;
		$created_time = $photo->created_time;
		$url = $photo->images->standard_resolution->url;
		$text = $photo->caption->text;
	?>
		<li id="<?php echo $id;?>">
			<img src="<?php echo $url;?>" alt="">
			<p class="gi-wrapper--photo__hash"><?php echo implode(',', $tags);?></p>
			<p class="gi-wrapper--photo__txt"><?php echo $text;?></p>
			<p class="gi-wrapper--photo__date"><?php echo date('Y/m/d',$created_time);?></p>
		</li>
	<?php endforeach?>
	</ul>
</div>
<?php endif;?>