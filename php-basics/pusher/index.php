<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'us2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '0a39d0430c5ad1dc2e93',
    '71183f73ab93e19d1ad6',
    '1059329',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('channel-1', 'event-1', $data);
?>

