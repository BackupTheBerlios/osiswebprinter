<?php
/* ----------------------------------------------------------------------
   $Id: owp_navigation_history.php,v 1.5 2003/05/03 15:55:33 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: navigation_history.php,v 1.2 2002/08/01 10:55:27
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  class navigationHistory {
    var $path, $snapshot;

    function navigationHistory() {
      $this->reset();
    }

    function reset() {
      $this->path = array();
      $this->snapshot = array();
    }

    function add_current_page() {
      global $_GET, $_POST, $_SERVER;

      $set = 'true';
      for ($i=0; $i<sizeof($this->path); $i++) {
        if ( ($this->path[$i]['page'] == basename($_SERVER['PHP_SELF'])) ) {
          array_splice($this->path, ($i));
          $set = 'true';
          break;
        }
      }

      if ($set == 'true') {
        $this->path[] = array('page' => basename($_SERVER['PHP_SELF']),
                              'mode' => (($_SERVER['HTTPS'] == 'on') ? 'SSL' : 'NONSSL'),
                              'get' => $_GET,
                              'post' => $_POST);
      }
    }

    function set_snapshot($page = '') {
      global $_GET, $_POST, $_SERVER;

      if (is_array($page)) {
        $this->snapshot = array('page' => $page['page'],
                                'mode' => $page['mode'],
                                'get' => $page['get'],
                                'post' => $page['post']);
      } else {
        $this->snapshot = array('page' => basename($_SERVER['PHP_SELF']),
                                'mode' => (($_SERVER['HTTPS'] == 'on') ? 'SSL' : 'NONSSL'),
                                'get' => $_GET,
                                'post' => $_POST);
      }
    }

    function clear_snapshot() {
      $this->snapshot = array();
    }

    function set_path_as_snapshot($history = 0) {
      $this->snapshot = array('page' => $this->path[(sizeof($this->path)-1-$history)]['page'],
                              'mode' => $this->path[(sizeof($this->path)-1-$history)]['mode'],
                              'get' => $this->path[(sizeof($this->path)-1-$history)]['get'],
                              'post' => $this->path[(sizeof($this->path)-1-$history)]['post']);
    }

    function debug() {
      for ($i=0; $i<sizeof($this->path); $i++) {
        echo $this->path[$i]['page'] . '?';
        while (list($key, $value) = each($this->path[$i]['get'])) {
          echo $key . '=' . $value . '&';
        }
        if (sizeof($this->path[$i]['post']) > 0) {
          echo '<br>';
          while (list($key, $value) = each($this->path[$i]['post'])) {
            echo '&nbsp;&nbsp;<b>' . $key . '=' . $value . '</b><br>';
          }
        }
        echo '<br>';
      }

      if (sizeof($this->snapshot) > 0) {
        echo '<br><br>';

        echo $this->snapshot['mode'] . ' ' . $this->snapshot['page'] . '?' . owpArraytoString($this->snapshot['get'], array(owpSessionName())) . '<br>';
      }
    }
  }
?>