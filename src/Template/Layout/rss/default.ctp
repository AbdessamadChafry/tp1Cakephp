<?php
if (!isset($channel)) :
    $channel = [];
endif;
if (!isset($channel['marque'])) :
    $channel['marque'] = $this->fetch('marque');
endif;

echo $this->Rss->document(
    $this->Rss->channel([], $channel, $this->fetch('content'))
);
