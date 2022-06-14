<div class="row">
	<div class="col-lg-12">
		<?php
			foreach($result as $res){
				echo '<div class="program-logo">';
					echo '<img class="img img-responsive logo" src="/images/logo/'.$res->ch_program->logo_file.'" title="'.$res->ch_program->name.'" />';
					//echo $res->ch_program->name."<br><br>";
				echo '</div>';
			}
		?>
	</div>
</div>