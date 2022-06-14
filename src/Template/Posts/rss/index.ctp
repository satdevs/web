<?php
foreach ($posts as $post) {
    $created = strtotime($post->created);
    $link = ['controller' => 'Posts','action' => 'view',$post->id];
    $body = h(strip_tags($post->body)); // Remove & escape any HTML to make sure the feed content will validate.
    $body = $this->Text->truncate($body, 400, [
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    ]);
    echo  $this->Rss->item([], [
        'title' => $post->title,
        'link' => $link,
        'guid' => ['url' => $link, 'isPermaLink' => 'true'],
        'description' => $body,
        'pubDate' => $created
    ]);
}
?>