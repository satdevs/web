<style>
	body{ font-family: Arial; font-size: 12px; letter-spacing: .05px; }
	table{ margin-bottom: 20px; }
	tr{	background: transparent; }
	th{	font-size: 12px; font-weight: bold;	text-align: center;	font-family: 'Roboto Condensed', sans-serif; padding: 0px; border-bottom: 1px solid #000; }
	td{	padding-top: 1px; padding-bottom: 0px; padding-left: 6px; font-size: 11px; font-family: 'Roboto Condensed', sans-serif; text-align: left; border-bottom: 1px solid #000; }
	p{ margin: 3px;	font-size: 11px; font-family: 'Roboto Condensed', sans-serif; font-family: 'Oswald', sans-serif; }
	h1{	font-family: 'Oswald', sans-serif; font-family: 'Roboto Condensed', sans-serif; margin: 0px; font-size: 32px; }
	h2{	font-family: 'Oswald', sans-serif; font-family: 'Roboto Condensed', sans-serif; margin: 0px; font-size: 18px; text-align: left;} 
	.vertical{ font-weight: bold; -webkit-transform:rotate(-90deg); -moz-transform:rotate(-90deg); -o-transform: rotate(-90deg); -ms-transform:rotate(-90deg); transform: rotate(-90deg); white-space:nowrap; height: auto; }
</style>
<div style="border: 1px solid #fff; width: 810px; padding: 1px; margin: 0 auto;">
	<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/channels/images/logo.png" style="float: left; height: 75px; margin-left: 10px; margin-right: 20px; margin-bottom: 5px; margin-top: 0px;" />
	<h1 style="text-align: center; margin-bottom: 0px; margin-right: 60px;">Sághy-Sat Kft.</h1>
	<p style="text-align: center; margin-bottom: 2px; font-size: 10px; margin-right: 60px;">Sághy-Sat Kft. 7754 Bóly, Ady E. u. 9. - Tel.: 69/696-696 - Web: www.saghysat.hu - Email: info@saghysat.hu</p>
	<div style="margin: 0 auto; width: 800px;">
	<h2 style="text-align: center; margin-right: 60px;"><b><?php echo $city['City']['name'];?></b> analóg csatornakiosztása</h2>
	<div style="clear: both;"></div>
	<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 0px;">

	<?php
		$mini 		= 0;
		$csaladi 	= 0;
		$bovitett 	= 0;
		$osszes 	= 0;
		foreach ($programs as $program):
			if($program['PackagesProgram']['packageorder']<=1){ $mini++; }
			if($program['PackagesProgram']['packageorder']<=2){ $csaladi++; }
			if($program['PackagesProgram']['packageorder']<=3){	$bovitett++; }
			$osszes++;
		endforeach;

		//echo $mini." ".$csaladi." ".$bovitett." ".$osszes;

		$first = TRUE;
		$package = '';
		$i=0;
		$colspan=1;
		if($csaladi>$mini){ $colspan=2; }
		if($osszes>$csaladi){ $colspan=3; }

?>

		<tr>
			<th colspan="<?php echo $colspan; ?>">&nbsp;</th>
			<th style="">Sorszám</th>
			<th style="">Program</th>
			<th style="">Jelleg</th>
			<th style="">Nyelv</th>
			<th style="">Csatorna</th>
			<th style="">Frekvencia MHz</th>
		</tr>		




<?php
		foreach ($programs as $program): 
	?>

			<tr>

	<?php if( $i == 0 ){ ?>
				<td rowspan="<?php echo $bovitett+$colspan; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ccc; border-left: 1px solid #000; brder-top: 1px solid #000; ">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 150px; margin-right: 6px;">
						<?php //echo $program['Package']['popular_name']; ?>&nbsp;
					</div>
				</td>
	<?php } ?>




<?php if($csaladi>$mini){ ?>
	<?php if( $i == 0 ){ ?>
				<td rowspan="<?php echo $csaladi+2; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ddd; border-left: 1px solid #000;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 100px; margin-right: 6px;">
						<?php //echo $program['Package']['popular_name']; ?>&nbsp;
					</div>
				</td>
	<?php } ?>
	<?php if( $i == $csaladi ){ ?>
				<td rowspan="<?php echo $osszes - $csaladi+1; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ccc; border-bottom: 0px solid #hhh;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 4px; margin-right: 6px;">
						&nbsp;
					</div>
				</td>
	<?php } ?>
<?php } ?>



<?php if($bovitett>$csaladi){ ?>
	<?php if( $i == 0 ){ ?>
				<td rowspan="<?php echo $mini+1; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #eee; border-left: 1px solid #000;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 75px; margin-right: 6px;">
						<?php //echo $program['Package']['popular_name']; ?>&nbsp;
					</div>
				</td>
	<?php } ?>
	<?php if( $i == $mini){ ?>
				<td rowspan="<?php echo ($csaladi-$mini+1) ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ddd;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 4px; margin-right: 6px;">
						&nbsp;
					</div>
				</td>
	<?php } ?>
	<?php if( $i == $csaladi ){ ?>
				<td rowspan="<?php echo $osszes - $csaladi+1; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ccc; border-bottom: 1px solid #000;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 4px; margin-right: 6px;">
						&nbsp;
					</div>
				</td>
	<?php } ?>
<?php } ?>

				<td style="font-size: 12px; text-align: center; border-left: 1px solid #000;"><?php echo $program['PackagesProgram']['lcn']; ?></td>
				<td style="font-size: 12px; font-weight: bold; border-left: 1px solid #000;"><?php echo $program['Program']['name'].' '.$program['PackagesProgram']['public_comment']; ?></td>
				<td style="border-left: 1px solid #000;"><?php echo $program['Program']['feature_name']; ?></td>
				<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['Program']['language']; ?></td>
				<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['Band']['id']; ?></td>
				<td style="text-align: center; border-left: 1px solid #000; border-right: 1px solid #000;"><?php echo $program['Band']['video_frequency']; ?> MHz</td>
			</tr>

<?php if($csaladi>$mini){ ?>
	<?php if( $i == $mini-1 ){ ?>
			<tr>
				<td colspan="6" style="width: 16px; height: 16px; vertical-align: bottom; background: #eee; border-right: 1px solid #000; text-align: center; font-weight: bold; font-size: 14px;padding-top:3px; badding-bottom: 3px;">
					<?php echo $program['Package']['popular_name']." - ".$program['Package']['popular_comment_analog']; ?>
				</td>
			</tr>
	<?php } ?>
<?php } ?>
<?php if($bovitett>$csaladi){ ?>
	<?php if( $i == $csaladi-1 ){ ?>
			<tr>
				<td colspan="6" style="width: 16px; height: 16px; vertical-align: bottom; background: #ddd; border-right: 1px solid #000; text-align: center; font-weight: bold; font-size: 14px;padding-top:3px; badding-bottom: 3px;">
					<?php echo $program['Package']['popular_name']." - ".$program['Package']['popular_comment_analog']; ?>
				</td>
			</tr>
	<?php } ?>
<?php } ?>
	<?php if( $i == $bovitett-1 ){ ?>
			<tr>
				<td colspan="6" style="width: 16px; height: 16px; vertical-align: bottom; background: #ccc; border-right: 1px solid #000; text-align: center; font-weight: bold; font-size: 14px; padding-left: 60px;padding-top:3px; badding-bottom: 3px;">
					<?php echo $program['Package']['popular_name']." - ".$program['Package']['popular_comment_analog']; ?>
				</td>
			</tr>
	<?php } ?>


	<?php 
			$package = $program['Package']['popular_name'];
			$i++;
		endforeach;
	?>
			<tr>
				<td colspan="<?php echo 9-$colspan+3; ?>" style="border-top: 1px solid #000; border-bottom: 1px solid #fff; height: 3px; font-size: 3px;">&nbsp;</td>
			</tr>

		</table>
		<!--p style="margin: 5px; text-align: center; font-size: 10px;"><?php //echo $last_sentence; ?></p-->
		<!-- p style="float: right; font-size: 10px;">File neve: <?php //echo $this->pdfConfig['filename']; ?>.pdf</p-->
		<p style="font-size: 10px;">Dátum: <?php echo date('Y.m.d. H:i:s'); ?></p>
	</div>

</div>

