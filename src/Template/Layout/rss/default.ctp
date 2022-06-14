<?php
	$title = $this->fetch('title');
	if(!isset($title)){$title="Hiányzó cím!";}
	$this->assign('title', 'Sághy-Sat | '.$title);
	/*
	if (!isset($channel)):
	    $channel = [];
	endif;
	if (!isset($channel['title'])):
	    $channel['title'] = $this->fetch('title');
	endif;

	echo $this->Rss->document(
	    $this->Rss->channel(
	        [], $channel, $this->fetch('content')
	    )
	);
	*/

	if (!isset($documentData)) {
	    $documentData = [];
	}
	if (!isset($channelData)) {
	    $channelData = [];
	}
	if (!isset($channelData['title'])) {
	    $channelData['title'] = $this->fetch('title');
	}
	$channel = $this->Rss->channel([], $channelData, $this->fetch('content'));
	echo $this->Rss->document($documentData, $channel);
?>