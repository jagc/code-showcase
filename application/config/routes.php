<?php
# main index | login/logout
# none yet
// Flight::route('/', array('Pages', 'index'));

# update records url
Flight::route('/update', array('Pages', 'update'));

# do whatever random test
Flight::route('/test', array('Pages', 'test'));

# search records
Flight::route('/search', array('search', 'index'));

# 404 not found
Flight::map('notFound', function(){
  Flight::json(array
  (
    'success' => 0,
    'message' => 'Invalid URL'
  ));
  Flight::stop();
});
?>
