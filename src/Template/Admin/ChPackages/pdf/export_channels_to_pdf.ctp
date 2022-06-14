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
<div id="analog" style="border: 1px solid #fff; width: 810px; padding: 1px; margin: 0 auto;">
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
		$name_mini	="";
		$name_csaladi="";
		$name_bovitett="";
		foreach ($programs as $program):
			if($program['PackagesProgram']['packageorder']<=1){ $mini++; }
			if($program['PackagesProgram']['packageorder']<=2){ $csaladi++; }
			if($program['PackagesProgram']['packageorder']<=3){	$bovitett++; }
			$osszes++;

			if($program['PackagesProgram']['packageorder']==1){ $name_mini=$program['Package']['popular_name']; }
			if($program['PackagesProgram']['packageorder']==2){ $name_csaladi=$program['Package']['popular_name']; }
			if($program['PackagesProgram']['packageorder']==3){	$name_bovitett=$program['Package']['popular_name']; }
		endforeach;

		//echo $mini." ".$csaladi." ".$bovitett." ".$osszes;	//Just for text !!! ;-)

		$first = TRUE;
		$package = '';
		$i=0;
		$colspan=1;
		if($csaladi>$mini){ $colspan=2; }
		if($osszes>$csaladi){ $colspan=3; }
		if($mini==$csaladi){ $colspan=2; } //Ha nincs családi pl Felső
		if($osszes==$mini && $csaladi==$mini){ $colspan=1; }


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


<?php 
	$fivan = 0;
	if($city['City']['name'] == 'Felsőszentiván' ){ 
		$fivan = 0;
	}
?>

	<?php if( $i == 0 ){ ?>
				<td rowspan="<?php echo $bovitett+$colspan-$fivan; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ccc; border-left: 1px solid #000; brder-top: 1px solid #000; ">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 50px; margin-right: 6px;">
						<?php echo $name_mini; ?>
					</div>
				</td>
	<?php } ?>



<?php if($city['City']['name'] != 'Felsőszentiván' ){ ?>
<?php if($csaladi>$mini){ ?>
	<?php if( $i == 0 ){ ?>
				<td rowspan="<?php echo $csaladi+2; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ddd; border-left: 1px solid #000;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 50px; margin-right: 6px;">
						<?php echo $name_csaladi; ?>
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
<?php } // Felsőszentiván IF ?>

<?php if($bovitett>$csaladi){ ?>
	<?php if( $i == 0 ){ ?>
				<td rowspan="<?php echo $mini+1; ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #eee; border-left: 1px solid #000;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 50px; margin-right: 6px;">
						<?php echo $name_bovitett; ?>
					</div>
				</td>
	<?php } ?>

<?php if($city['City']['name'] != 'Felsőszentiván' ){ ?>
	<?php if( $i == $mini){ ?>
				<td rowspan="<?php echo ($csaladi-$mini+1) ?>" style="width: 6px; height: 16px; vertical-align: bottom; background: #ddd;">
					<div  class="vertical" style="width: 6px; height: 16px; text-align: center; font-size: 14px; margin-bottom: 4px; margin-right: 6px;">
						&nbsp;
					</div>
				</td>
	<?php } ?>
<?php } // Felsőszentiván IF ?>

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
		<?php 
			$background="#ddd;";
			if($city['City']['name'] == 'Felsőszentiván' ){
				$background="#eee;";
			}
		?>
			<tr>
				<td colspan="6" style="width: 16px; height: 16px; vertical-align: bottom; background: <?php echo $background; ?>; border-right: 1px solid #000; text-align: center; font-weight: bold; font-size: 14px;padding-top:3px; badding-bottom: 3px;">
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
		<!--p style="margin: 5px; text-align: center; font-size: 10px;"><?php //echo $last_sentence_for_analog; ?></p-->
		<!-- p style="float: right; font-size: 10px;">File neve: <?php //echo $this->pdfConfig['filename']; ?>.pdf</p-->
		<p style="float: right; font-size: 10px;">Dátum: <?php echo date('Y.m.d. H:i:s'); ?></p>		
	</div>

</div>

<?php if($digiprograms){ ?>
<!--
-------------------------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------------------------
-->

<?php
	$margin_left = '';
	$width = 500;
	if($city['City']['name'] == 'Felsőszentiván'){
		$margin_left = 'margin-left: 10px;';
		$width = 790;
	}
?>
<div id="digitalis" style="page-break-before:always; width:800px; border: 1px solid #fff; margin: 0 auto;">
	<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/channels/images/logo.png" style="float: left; height: 75px; margin-left: 10px; margin-right: 20px; margin-bottom: 5px; margin-top: 0px;" />
	<h1 style="text-align: center; margin-bottom: 0px; margin-right: 60px;">Sághy-Sat Kft.</h1>
	<p style="text-align: center; margin-bottom: 2px; font-size: 10px; margin-right: 60px;">Sághy-Sat Kft. 7754 Bóly, Ady E. u. 9. - Tel.: 69/696-696 - Web: www.saghysat.hu - Email: info@saghysat.hu</p>
	<div style="margin: 0 auto; width: 800px;">
	<h2 style="text-align: center; margin-right: 60px;"><b><?php echo $city['City']['name'];?></b> digitális csatornakiosztása</h2>
	<div style="clear: both;"></div>
<?php /*
	<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/channels/images/logo.png" style="float: left; height: 75px; margin-left: 15px; margin-right: 20px; margin-bottom: 0px; margin-top: 0px;<?php echo $margin_left; ?>" />
	<h1 style="text-align: left; margin-bottom: 0px;">Sághy-Sat Kft.</h1>
	<p style="font-family: 'Oswald', sans-serif; text-align: left; margin-bottom: 2px; font-size: 13px;">Sághy-Sat Kft. 7754 Bóly, Ady E. u. 9. - Tel.: 69/696-696 - Web: www.saghysat.hu - Email: info@saghysat.hu</p>
	<h2 style="margin-bottom: 4px;"><b><?php echo $city['City']['name'];?></b> digitális csatornakiosztása</h2>
	<div style="clear: both;"></div>
*/ ?>

	<div style="float: left; margin-top: 3px; width: <?php echo $width;?>px; <?php echo $margin_left; ?>">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 0px;">
			<tr>
				<th style="border-top: 1px solid #000; width: 30px; border-left: 1px solid #000;">Sorszám</th>
				<th style="border-top: 1px solid #000; border-left: 1px solid #000;">Program</th>
				<th style="border-top: 1px solid #000; width: 140px;border-left: 1px solid #000;">Jelleg</th>
				<th style="border-top: 1px solid #000; width: 70px; border-left: 1px solid #000;">Nyelv</th>
				<th style="border-top: 1px solid #000; width: 50px; border-left: 1px solid #000; text-align: center; font-size: 8px; border-right: 1px solid #000;">Családi csomagban<br>fogható</th>
			</tr>		
	<?php 
		if($city['City']['name'] != 'Felsőszentiván'){
			$max_lcn = 120;
		}
		if($city['City']['name'] == 'Felsőszentiván'){
			$max_lcn = 999;
		}
		foreach ($digiprograms as $program):
			if($program['PackagesProgram']['lcn']<=$max_lcn){
	?>
			<tr>
				<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['PackagesProgram']['lcn']; ?></td>
				<td style="font-weight: bold; border-left: 1px solid #000;"><?php echo $program['Program']['name'].' '.$program['PackagesProgram']['public_comment']; ?></td>
				<td style="border-left: 1px solid #000;"><?php echo $program['Program']['feature_name']; ?></td>
				<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['Program']['language']; ?></td>
				<td style="text-align: center; border-left: 1px solid #000; border-right: 1px solid #000;"><?php 
					if($program['PackagesProgram']['packageorder']<3){
						echo "X";
					}
				?></td>
			</tr>
	<?php 
			}
		endforeach;
	?>

		</table>

	</div>


	<!--
		############################################# Jobb oldali kis táblácskák #############################################	
	-->
	<?php if($city['City']['name'] != 'Felsőszentiván' ){ ?>
	<div style="float: right; width: 280px;">
		<h2 style='margin: 0px; font-size: 12px; text-align: center; font-family: "Oswald", sans-serif;'>Havidíj ellenében <b>választható digitális csomagjaink</b></h2>
		<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 0px;">

	<?php 
		$package = '';
		$first=TRUE;
		foreach ($digiprograms as $program):
			if($program['PackagesProgram']['lcn']>120){

				if($package != $program['Package']['popular_name']){
	?>
	<?php if(!$first){ ?>
			<tr>
				<th colspan="3" style="text-align: center; border: 0px solid #000; height:2px; font-size: 5px;">&nbsp;</th>
			</tr>		
	<?php } $first=FALSE; ?>
			<tr>
				<th colspan="3" style="text-align: center; border: 1px solid #000; border-bottom: 2px solid #000;"><?php echo $program['Package']['popular_name']." - ".$program['Package']['popular_comment_digital']; ?></th>
			</tr>		
	<?php } //Új fejléc ?>

			<tr>
				<td style="text-align: center; border-left: 1px solid #000;"><?php echo $program['PackagesProgram']['lcn']; ?></td>
				<td style="font-weight: bold; border-left: 1px solid #000;"><?php echo $program['Program']['name']; ?></td>
				<td style="border-left: 1px solid #000; border-right: 1px solid #000; font-size: 10px;"><?php echo $program['Program']['feature_name']; ?></td>
			</tr>
	<?php 
			}
			$package = $program['Package']['popular_name'];
		endforeach;
	?>

		</table>
	</div>
	<?php } //Ha nem felsőszentiván?>

	<!-- ############################################# Lábléc ############################################# -->
	<div style="clear: both;">
		<p style="float: left; font-size: 10px; <?php echo $margin_left; ?>">A csatornák száma a TV-ben elfoglalt alapbeállítását jelölik. Az egyedileg beállított sorrend ettől eltérő lehet.</p>
		<p style="float: right; font-size: 10px;">Dátum: <?php echo date('Y.m.d. H:i:s'); ?></p>
		<p style="float: left; font-size: 10px;"><?php echo $last_sentence_for_digital; ?></p>
	</div>
</div>
<?php } // /if($digiprograms) ?>


