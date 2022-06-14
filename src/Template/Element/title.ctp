<?php //isset($this->request->params['controller']) && $this->request->params['controller']='Posts' && isset($this->request->params['action']) &&  $this->request->params['action']=='index' && ?>
<?php
	if(!isset($searchtext)){
		$searchtext = " ";
	}
?>
<?php // Vastag sáv a H1-es címnek
 if( !isset($this->request->params['pass'][0]) || (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] != 'home') ): ?>
	<section id="title" class="emerald">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 id="main-title"><?= $this->fetch('title') ?></h1>
					<p><?php
						if(isset($method)){
							echo $method;
						}
						//$this->Text->highlight($method, $searchtext, ['format' => '<span class="highlight">\1</span>']);
					?></p>
				</div>
<?php /*
				<div class="col-sm-0">
					<!--ul class="breadcrumb pull-right">
						<li><a href="/#news">Kezdőlap</a></li>
						<li class="active">Hírek</li>
					</ul-->
				</div>
*/ ?>
			</div>
		</div>
	</section>
	<section id="title-shadow" style="padding: 0px;">
		<img src="/images/shadow.png" style="height: 40px; width:100%;" />
	</section>
<?php endif; ?>
