					<li class="dropdown messages-menu">
						<!-- Menu toggle button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-envelope-o"></i>
<?php if($total_posts){ ?>
							<span class="label label-danger"><?= $total_posts ?></span>
<?php } ?>
						</a>
						<ul class="dropdown-menu">

							<li class="header">Összesen <b><?= $total_posts ?></b> üzeneted van</li>
							<li>
								<!-- inner menu: contains the messages -->
								<ul class="menu">
<?php foreach ($recent_posts as $message): ?>
									<li><!-- start message -->
										<a href="<?php if($admin){echo "/admin"; } ?>/messages/view/<?= $message->id ?>">
											<div class="pull-left">
												<img src="/img/avatars/zsolt.jpg" class="img-circle" style="max-height: 40px;" alt="<?= $message->name ?>"><!-- User Image -->
											</div>
											<h4><!-- Message title and timestamp -->
												<?= $message->name ?>
												<small><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?= $this->Time->format( $message->created, 'yyyy.MM.dd. HH:mm:ss', null ); ?></small>
											</h4>
											<!-- The message subject -->
											<p><?= $message->subject ?></p>
										</a>
									</li><!-- end message -->
<?php endforeach; ?>									
									
								</ul>
								<!-- /.menu -->
							</li>
							<li class="footer"><a href="<?php if($admin){echo "/admin"; } ?>/messages">Összes üzenet megtekintése</a></li>
						</ul>
					</li><!-- /.messages-menu -->


