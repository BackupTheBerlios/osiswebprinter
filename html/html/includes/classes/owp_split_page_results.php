<?php
/* ----------------------------------------------------------------------
   $Id: owp_split_page_results.php,v 1.7 2003/04/24 06:03:13 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: split_page_results.php,v 1.10 2002/04/17 23:09:03 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  class splitPageResults {
    function splitPageResults(&$current_page_number, $max_rows_per_page, &$sql_query, &$query_num_rows) {
      GLOBAL $db;

      if (empty($current_page_number)) $current_page_number = 1;

      $pos_to = strlen($sql_query);
      $pos_from = strpos($sql_query, ' from', 0);

      $pos_group_by = strpos($sql_query, ' group by', $pos_from);
      if (($pos_group_by < $pos_to) && ($pos_group_by != false)) $pos_to = $pos_group_by;

      $pos_having = strpos($sql_query, ' having', $pos_from);
      if (($pos_having < $pos_to) && ($pos_having != false)) $pos_to = $pos_having;

      $pos_order_by = strpos($sql_query, ' order by', $pos_from);
      if (($pos_order_by < $pos_to) && ($pos_order_by != false)) $pos_to = $pos_order_by;

      $pos_limit = strpos($sql_query, ' limit', $pos_from);
      if (($pos_limit < $pos_to) && ($pos_limit != false)) $pos_to = $pos_limit;

      $pos_procedure = strpos($sql_query, ' procedure', $pos_from);
      if (($pos_procedure < $pos_to) && ($pos_procedure != false)) $pos_to = $pos_procedure;

      $offset = ($max_rows_per_page * ($current_page_number - 1));
      $sql_query .= " limit " . $offset . ", " . $max_rows_per_page;

      $count_values = $db->Execute("select count(*) as total " . substr($sql_query, $pos_from, ($pos_to - $pos_from)));
      $query_num_rows = $count_values->fields['total'];
    }

    function display_links($query_numrows, $max_rows_per_page, $max_page_links, $current_page_number, $parameters = '', $page_name = 'page') {
      global $owpSelf;

      if ($parameters != '') $parameters .= '&';

// calculate number of pages needing links
      $num_pages = intval($query_numrows / $max_rows_per_page);

// $num_pages now contains int of pages needed unless there is a remainder from division
      if ($query_numrows % $max_rows_per_page) $num_pages++; // has remainder so add one page

      $pages_array = array();
      for ($i=1; $i<=$num_pages; $i++) {
        $pages_array[] = array('id' => $i, 'text' => $i);
      }

      if ($num_pages > 1) {
        $display_links = owpDrawForm('pages', basename($owpSelf), '', 'get');

        if ($current_page_number > 1) {
          $display_links .= '<a href="' . owpLink(basename($owpSelf), $parameters . $page_name . '=' . ($current_page_number - 1), 'NONSSL') . '" class="splitPageLink">' . PREVNEXT_BUTTON_PREV . '</a>&nbsp;&nbsp;';
        } else {
          $display_links .= PREVNEXT_BUTTON_PREV . '&nbsp;&nbsp;';
        }

        $display_links .= sprintf(TEXT_RESULT_PAGE, owpPullDownMenu($page_name, $pages_array, '', 'onChange="this.form.submit();"'), $num_pages);

        if (($current_page_number < $num_pages) && ($num_pages != 1)) {
          $display_links .= '&nbsp;&nbsp;<a href="' . owpLink(basename($owpSelf), $parameters . $page_name . '=' . ($current_page_number + 1), 'NONSSL') . '" class="splitPageLink">' . PREVNEXT_BUTTON_NEXT . '</a>';
        } else {
          $display_links .= '&nbsp;&nbsp;' . PREVNEXT_BUTTON_NEXT;
        }

        if ($parameters != '') {
          if (substr($parameters, -1) == '&') $parameters = substr($parameters, 0, -1);
          $pairs = explode('&', $parameters);
          while (list(, $pair) = each($pairs)) {
            list($key,$value) = explode('=', $pair);
            $display_links .= owpDrawHiddenField(rawurldecode($key), rawurldecode($value));
          }
        }

        if (SID) $display_links .= owpDrawHiddenField(owpSessionName(), tep_session_id());

        $display_links .= '</form>';
      } else {
        $display_links = sprintf(TEXT_RESULT_PAGE, $num_pages, $num_pages);
      }

      return $display_links;
    }

    function display_count($query_numrows, $max_rows_per_page, $current_page_number, $text_output) {
      $to_num = ($max_rows_per_page * $current_page_number);
      if ($to_num > $query_numrows) $to_num = $query_numrows;
      $from_num = ($max_rows_per_page * ($current_page_number - 1));
      if ($to_num == 0) {
        $from_num = 0;
      } else {
        $from_num++;
      }

      return sprintf($text_output, $from_num, $to_num, $query_numrows);
    }
  }
?>
