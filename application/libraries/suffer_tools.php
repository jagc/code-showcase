<?php

/**
 * Super app specific processes
 */
class SufferTools
{
  public function render_suffer_page($render_header_bar_content = false)
  {
    Flight::render('main.view.php', array(
      'render_header_bar_content' => $render_header_bar_content,
    ));
  }
}
