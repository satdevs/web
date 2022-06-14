				<div class="widget tags hidden-xs">
					<h3>Cimke felhő</h3>
					<ul class="tag-cloud">
<?php foreach ($labels as $label) { ?>
						<li><a class="btn btn-xs btn-primary" href="/posts/index/label/<?= $label->id ?>"><?= $label->name ?></a></li>
<?php } ?>
					</ul>
				</div><!--/.tags-->
