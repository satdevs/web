<!-- ############################################################################################################ -->
<!-- -------------------------------------------------- DOKUMENTUMTÁR ------------------------------------------ -->
<!-- ############################################################################################################ -->
<div id="szolgaltatasok-csomagok">
	<div id="contact" class="col-sm-8 col-sm-pull-4">
		<div class="blog">

			<div class="blog-item">
				<h2 class="text-center">Dokumentumtár</h2>

				<div class="container" style="margin-top: 20px;">
					<div class="row">
						<div class="col-sm-12">


							<div>

							  <!-- Nav tabs -->
							  <ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#current" aria-controls="current" role="tab" data-toggle="tab">Hatályos</a></li>
								<li role="presentation"><a href="#non-current" aria-controls="non-current" role="tab" data-toggle="tab">Nem hatályos</a></li>
							  </ul>

							  <!-- Tab panes -->
							  <div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="current">
									<?php /* ############################ CURRENT #################################### */ ?>
									<ul>
<?php
									$group=0;
									foreach( $currents as $document ):
										if($group != $document->servicegroup):
											echo "</ul>\n";
											echo "<h3>".$servicegroup[$document->servicegroup]."</h3>\n";
											echo '<ul style="list-style-type: square;">'."\n";
										endif;
?>
										<li><a href="/download/<?= $document->hash ?>"><?= $document->name ?></a></li>
<?php
										$group = $document->servicegroup;
									endforeach;
?>
									</ul>
									<?php /* ############################ /.CURRENT ################################## */ ?>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="non-current">
									<?php /* ############################ NON-CURRENT #################################### */ ?>								
									<ul>
<?php
									$group=0;
									foreach( $nonCurrents as $document ):
										if($group != $document->servicegroup):
											echo "</ul>\n";
											echo "<h3>".$servicegroup[$document->servicegroup]."</h3>\n";
											echo '<ul style="list-style-type: square;">'."\n";
										endif;
?>
										<li><a href="/download/<?= $document->hash ?>"><?= $document->name ?></a></li>
<?php
										$group = $document->servicegroup;
									endforeach;
?>
									</ul>
									<?php /* ############################ /.NON-CURRENT #################################### */ ?>																
								</div>
							  </div>

							</div>

							<hr>
							<?= $this->cell('Texts', ['parameters'=>[0,0,5]] ); //Parameters: headstation: 0, servicegroup:0, ID=1: Nyilatkozat ?>

						</div>
					</div>
				</div>

			</div><!-- blog-item -->
			<img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />
		</div>
	</div>
</div>
<!-- ############################################################################################################# -->
<!-- ------------------------------------------------ /.DOKUMENTUMTÁR -------------------------------------------- -->
<!-- ############################################################################################################# -->

