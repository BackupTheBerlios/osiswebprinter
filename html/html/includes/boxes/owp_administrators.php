<!-- administrators //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'params' => 'class="menuBoxHeading"',
                               'text'  => BOX_HEADING_ADMINISTRATORS,
                               'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=administrators')
                              );
  new infoBoxHeading($info_box_contents);

  if ($selected_box == 'administrators') {
    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left',
                                 'text'  => '<a href="' . tep_href_link(FILENAME_ADMINISTRATORS, '', 'NONSSL') . '">' . BOX_ADMINISTRATORS_SETUP . '</a>'
                                );
    new infoBox($info_box_contents);
  }
?>
            </td>
          </tr>
<!-- administrators_eof //-->
