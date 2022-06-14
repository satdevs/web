<?php if( isset($this->request->params['controller']) && $this->request->params['controller']='Posts' && isset($this->request->params['action']) &&  $this->request->params['action']=='index' && isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == 'home' ){ ?>

	<section id="free-internet" style="padding: 10px;">
		<div class="container">
			<div class="row" style="padding-left: 15px; padding-right: 15px;">
				<div id="free-internet-cover">
					<div class="col-md-6 text-center" style="padding: 20px;">
						<a href="/dijmentes-internet" class="btn btn-lg btn-default hidden-md hidden-sm hidden-xs"><b>Regisztráció a díjmentes Internethez</b></a>
						<a href="/dijmentes-internet" class="btn btn-md btn-default hidden-lg"><b>Regisztráció a díjmentes Internethez</b></a>
					</div>
					<div class="col-md-6 text-center" style="display: inline-block; vertical-align: middle; float: none; height: 45; padding: 20px;">
						<p style="font-size: 16px;">Az ingyenes Internethez való igényüket 2020. november 16. és 27. között jelezhetik ügyfélszolgálatunkon vagy itt
						a regisztráció gombra kattintva!</p>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	
<?php } ?>