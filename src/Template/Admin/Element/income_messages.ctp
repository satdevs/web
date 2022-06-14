<?php $income = $this->requestAction(['controller' => 'Messages', 'action' => 'income']); ?>
<?php //$income = Cake\Routing\RequestActionTrait::requestAction(['controller' => 'Messages', 'action' => 'income']); ?>
<?php
	//echo "<pre>";
	//print_r($income);
	//die();
?>


					
					<li class="dropdown messages-menu">
						<!-- Menu toggle button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-envelope-o"></i>
							<span class="label label-success">14</span>
						</a>
						<ul class="dropdown-menu">

							<li class="header">Összes <b>14</b> üzeneted van</li>
							<li>
								<!-- inner menu: contains the messages -->
								<ul class="menu">
<?php /*
foreach ($messages as $message): 
*/?>
									<li><!-- start message -->
										<a href="/<?php if($admin){echo "/admin"; } ?>/messages/view/<?php //= $message->id ?>">
											<div class="pull-left">
												<img src="/img/avatars/zsolt.jpg" class="img-circle" alt="<?php //= $message->name ?>"><!-- User Image -->
											</div>
											<h4><!-- Message title and timestamp -->
												<?php //= $message->name ?>
												Varga Zsolt
												<small><i class="fa fa-clock-o"></i> 8<?php //= $message->created ?> perccel ezelőtt</small>
											</h4>
											<!-- The message subject -->
											<p><?php //= $message->subject ?>Üzenet tárgy része</p>
										</a>
									</li><!-- end message -->
<?php
/*
endforeach;
*/
?>									
									
								</ul>
								<!-- /.menu -->
							</li>
							<li class="footer"><a href="/<?php if($admin){echo "/admin"; } ?>/messages">Összes üzenet megtekintése</a></li>
						</ul>
					</li><!-- /.messages-menu -->


