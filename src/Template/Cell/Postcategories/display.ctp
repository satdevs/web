				<div class="widget categories hidden-xs">
					<h3>Kategóriák</h3>
					<div class="row">
						<div class="col-sm-6"> <!-- A második oszlop is col-sm-6 ... csak törölve lett -->
							<ul class="arrow">
<?php foreach ($postcategories as $postcategory):  ?>
								<li><a href="/posts/index/category/<?= $postcategory->id ?>"><?= $postcategory->title ?></a></li>
								<?php /*  (<?= $postcategory->post_count ?>) */ ?>
<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div><!--/.categories-->
