
<!-- -------------------------------- FORM -------------------------------- -->
    <div id="contact" class="col-sm-8 col-sm-pull-4">
        <div class="blog">
			<div class="blog-item">

				<div class="form-group" style="padding-bottom: 20px;">
					<div class="col-sm-7">
						<h3>Adatok ellenőrzése - kész</h3>
					</div>
					<div class="col-sm-5 text-right">
						<img src="/images/simple.png" style=""/>
					</div>
				</div>

				<div style="clear: both;"></div>
				<hr>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				  <!-- Tab panes -->

					<?= $form ?>
					
				</div>
			
			</div>
			
        </div>
        <img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />

    </div>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->



<!-- Modal -->
<div class="modal fade" id="gdprModal" tabindex="-1" role="dialog" aria-labelledby="gdpeLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gdpeLabel"><?= $gdpr_title ?></h4>
      </div>
      <div class="modal-body">
        <?= $gdpr_body ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Elolvastam</button>
      </div>
    </div>
  </div>
</div>

