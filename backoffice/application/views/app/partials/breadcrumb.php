<div class="row page-title">
	<div class="col-md-12">
		<nav aria-label="breadcrumb" class="float-right mt-1">
			<ol class="breadcrumb">
				<?php if(isset($breadcrumb)): ?>
					<li class="breadcrumb-item"><a href="">Manage</a></li>
					<li class="breadcrumb-item"><a href="/manage/options/index">Options</a></li>
					<?php
						$Option = Option::where('Guid',$breadcrumb)->first();
						$links[$Option->Guid] = $Option->Name;
						while($Option->IdOptionValue != NULL)
						{
							$Option = Option::where('IdBotOption',$Option->IdOptionValue)->first();
							$links[$Option->Guid] = $Option->Name;
						}

						$i = 1;
						$len = count($links);
					?>


					<?php foreach(array_reverse($links) as $guid => $item): ?>
						<?php if($i === $len): ?>
							<li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($item) ?></li>
						<?php else: ?>
							<li class="breadcrumb-item"><a href="/manage/options/options_value/<?php echo $guid ?>"><?php echo ucfirst($item) ?></a></li>
						<?php endif ?>
						<?php $i++; ?>
					<?php endforeach ?>



				<?php else: ?>
					<?php $url = uri_string() ?>
					<?php $url = explode('/',$url) ?>
					<?php foreach($url as $key => $item): ?>
						<?php if($key === array_key_last($url)): ?>
							<li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($item) ?></li>
						<?php else: ?>
							<li class="breadcrumb-item"><a href=""><?php echo ucfirst($item) ?></a></li>
						<?php endif ?>
					<?php endforeach ?>
				<?php endif ?>
			</ol>
		</nav>
		<h4 class="mb-1 mt-0"><?php echo $title ?></h4>
	</div>
</div>
