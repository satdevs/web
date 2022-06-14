<?php
	$karbantartas = false;
?>
<div class="col-sm-8 col-sm-pull-4" style="border: 1px solid #ddd; padding: 10px;">
	<div class="blog">
			<div class="box">
				<div style="clear: both;"></div>
				<div class="box-body">
<?php if($karbantartas){ ?>
					<h2>Karbantartás!<br>Kérem nézzen vissza picit később!</h2>
<?php }else{ ?>
					<?= $text->text ?>
					<br />
					<div class="box-footer">
					
						<?= $this->Form->create($freeinternet, ['class'=>'form-horizontal']) ?>					
						
						<?php //debug($pdfinvoice); die();
							$accept = '';
							if($freeinternet->accept){$accept=' checked';}
						?>

						<div class="form-group">						
							<label for="none" class="col-md-1 control-label">&nbsp;</label>
							<div class="col-xs-12 col-sm-11 col-md-11 col-lg-11">
								<div id="div-accept" class="icheck-turquoise" style="border-bottom: 1px solid lightgray; padding-bottom: 10px; padding: 5px;">
									<input type="checkbox" id="accept" name="accept"<?= $accept ?> />
									<label for="accept"><span style="color: red; font-weight: bold;">*</span>&nbsp;Büntetőjogi felelősségem tudatában kijelentem, hogy az 510/2020.(XI.14.) Korm. rendelet szerinti ingyenes internet-szolgáltatás igénybevételének feltételei fennállnak, kérem a szolgáltatás díjmentes biztosítását 30 napra.<br>
									<i>(Elfogadás esetén, kérem jelölje be a jelölőnégyzetet!)</i>
									</label>
								</div>						
							</div>
						</div>
						
						
						<button type="submit" class="btn btn-success" style="width: 100%; padding-top: 20px; padding-bottom: 20px; font-size: 16px; font-weight: bold;">Kattintson ide az igénylő adatlap kitöltéséhez!</button>

						<?= $this->Form->end() ?>
						
					</div>
<?php } ?>

				</div>
			</div>
	</div>
</div>

