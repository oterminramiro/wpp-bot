<div class="row page-title">
	<div class="col-md-12">
		<nav aria-label="breadcrumb" class="float-right mt-1">
			<ol class="breadcrumb">
				<?php $url = uri_string() ?>
				<?php $url = explode('/',$url) ?>
				<?php foreach($url as $key => $item): ?>
					<?php if($key === array_key_last($url)): ?>
						<li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($item) ?></li>
					<?php else: ?>
						<li class="breadcrumb-item"><a href=""><?php echo ucfirst($item) ?></a></li>
					<?php endif ?>
				<?php endforeach ?>
			</ol>
		</nav>
		<h4 class="mb-1 mt-0"><?php echo $title ?></h4>
	</div>
</div>
