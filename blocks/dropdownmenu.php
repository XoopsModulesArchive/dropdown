<?php

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <http://xoops.codigolivre.org.br>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
function block_DROPDOWN_show()
{
    global $xoopsDB, $xoopsUser;

    $block = [];

    $block['title'] = _DROPDOWN_ADMIN;

    $block['content'] = "<script type='text/javascript'>
<!--
function Go(x) {

   location.href = x;
   document.forms[0].reset();
   document.forms[0].elements[0].blur();

}
//-->
</script><form action='' style='margin-top:0px;'><select size=1 name='Auswahl'  onChange='Go(this.form.Auswahl.options[this.form.Auswahl.options.selectedIndex].value)' class='selectstyle'><option value='' class='optionstyle'>Auswahl</option>";

    $result = $xoopsDB->query('SELECT position, itemname, itemurl, down, membersonly FROM ' . $xoopsDB->prefix('dropdown') . ' ORDER BY position');

    while (list($position, $itemname, $itemurl, $down, $membersonly) = $xoopsDB->fetchRow($result)) {
        if ($xoopsUser or 1 == $membersonly) {
            if (1 == $down) {
                $block['content'] .= "
<option value='$itemurl' class='optionstyle'>$itemname</option>";
            }
        }
    }

    $block['content'] .= '</select></form>';

    return $block;
}



