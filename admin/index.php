<?php

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <http://xoops.codigolivre.org.br>                             //
// ------------------------------------------------------------------------- //
// Based on:                                                                     //
// myPHPNUKE Web Portal System - http://myphpnuke.com/                               //
// PHP-NUKE Web Portal System - http://phpnuke.org/                               //
// Thatware - http://thatware.org/                                             //
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

require_once 'admin_header.php';

function DropDownAdmin()
{
    global $xoopsDB, $xoopsConfig, $xoopsModule;

    xoops_cp_header();

    OpenTable();

    echo '<big><b>' . _DROPDOWN_TITLE . '</big></b>';

    // Menueintrag hinzufügen

    echo "<h4 style='text-align:left;'>" . _DROPDOWN_ADDMENUITEM . "</h4>
        <form action='index.php' method='post'>
        <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
        <tr>
        <td class='bg2'>
                <table width='100%' border='0' cellpadding='4' cellspacing='1'>
                <tr>
                <td class='bg3'><b>" . _DROPDOWN_POS . "</b></td>
                <td class='bg1'><input type='text' name='xposition' size='4' maxlength='4'>&nbsp&nbsp&nbsp(0 - 9999)</td>
                </tr>
                <tr>
                <td class='bg3'><b>" . _DROPDOWN_ITEMNAME . "</b></td>
                <td class='bg1'><input type='text' name='itemname' size='50' maxlength='60'></td>
                </tr>
                <td class='bg3'></td>
                <td class='bg1'>
                <input type='hidden' name='down' value='1'>
                </td>
                </tr>
                <tr>
                <td class='bg3'><b>" . _DROPDOWN_ITEMURL . "</b></td>
                <td class='bg1'><input type='text' name='itemurl' size='50' maxlength='100'></td>
                </tr>
                <tr>
                <td class='bg3'><b>" . _DROPDOWN_MEMBERSONLY . "</b></td>
                <td class='bg1'>
                <input type='radio' checked name='membersonly' value='1'>" . _DROPDOWN_ALL . "
                <input type='radio'         name='membersonly' value='0'>" . _DROPDOWN_MEMBERS . "
                </td>
                </tr>
                <tr>
                <td class='bg3'>&nbsp;</td>
                <td class='bg1'><input type='hidden' name='fct' value='dropdown'><input type='hidden' name='op' value='DropDownAdd'><input type='submit' value='" . _DROPDOWN_ADD . "'></td>
                </tr>
                </table>
        </td>
        </tr>
        </table>
        </form>
        <br>";

    // Menueintrag ändern/löschen

    echo "<h4 style='text-align:left;'>" . _DROPDOWN_CHANGEMENUITEM . "</h4>
        <form action='index.php' method='post'>
        <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
        <tr>
        <td class='bg2'>
                <table width='100%' border='0' cellpadding='4' cellspacing='1'>
                <tr class='bg3'>
                <td><b>" . _DROPDOWN_POS_SHORT . '</b></td>
                <td><b>' . _DROPDOWN_ITEMNAME . '</b></td>
                <td><b>' . _DROPDOWN_ITEMURL . '</b></td>
                <td><b>' . _DROPDOWN_MEMBERSONLY_SHORT . '</b></td>
                <td><b>' . _DROPDOWN_FUNCTION . '</b></td>';

    $result = $xoopsDB->query('SELECT menuid, position, itemname, itemurl, down, membersonly FROM ' . $xoopsDB->prefix('dropdown') . ' ORDER BY position');

    $myts = MyTextSanitizer::getInstance();

    while (list($menuid, $position, $itemname, $itemurl, $down, $membersonly) = $xoopsDB->fetchRow($result)) {
        $itemname = htmlspecialchars($itemname, ENT_QUOTES | ENT_HTML5);

        $itemurl = htmlspecialchars($itemurl, ENT_QUOTES | ENT_HTML5);

        echo "<tr class='bg1'><td align='right'>$position</td>";

        echo "<td>$itemname</td>";

        echo "<td>$itemurl</td>";

        if (1 == $membersonly) {
            echo '<td>' . _DROPDOWN_YES . '</td>';
        } else {
            echo '<td> </td>';
        }

        echo "<td><a href='index.php?op=DropDownEdit&amp;menuid=$menuid'>" . _DROPDOWN_EDIT . "</a> | <a href='index.php?op=DropDownDel&amp;menuid=$menuid&amp;ok=0'>" . _DROPDOWN_DELETE . '</a></td>
                </tr>';
    }

    echo '</table>
        </td>
        </tr>
        </table>
        </form>';

    CloseTable();
}

function DropDownEdit($menuid)
{
    global $xoopsDB, $xoopsConfig, $xoopsModule;

    xoops_cp_header();

    $result = $xoopsDB->query('SELECT position, itemname, itemurl, down, membersonly FROM ' . $xoopsDB->prefix('dropdown') . " WHERE menuid=$menuid");

    [$xposition, $itemname, $itemurl, $down, $membersonly] = $xoopsDB->fetchRow($result);

    $myts = MyTextSanitizer::getInstance();

    $itemname = htmlspecialchars($itemname, ENT_QUOTES | ENT_HTML5);

    $itemurl = htmlspecialchars($itemurl, ENT_QUOTES | ENT_HTML5);

    OpenTable();

    echo '<big><b>' . _DROPDOWN_TITLE . "</big></b>
        <h4 style='text-align:left;'>" . _DROPDOWN_EDITMENUITEM . "</h4>
        <form action='index.php' method='post'>
        <input type='hidden' name='menuid' value='$menuid'>
        <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
        <tr>
        <td class='bg2'>
                <table width='100%' border='0' cellpadding='4' cellspacing='1'>
                <tr>
                <td class='bg3'><b>" . _DROPDOWN_POS . "</b></td>
                <td class='bg1'><input type='text' name='xposition' size='4' maxlength='4' value='$xposition'>&nbsp&nbsp&nbsp(0 - 9999)</td>
                </tr>
                <tr>
                <td class='bg3'><b>" . _DROPDOWN_ITEMNAME . "</b></td>
                <td class='bg1'><input type='text' name='itemname' size='50' maxlength='60' value='$itemname'></td>
                </tr>
                <tr>
                <td class='bg3'></td>
                <td class='bg1'>";

    echo "
                <input type='hidden' name='down' value='1'>
                </td>
                </tr>
                <tr>
                <td class='bg3'><b>" . _DROPDOWN_ITEMURL . "</b></td>
                <td class='bg1'><input type='text' name='itemurl' size='50' maxlength='100' value='$itemurl'></td>
                </tr>
                <td class='bg3'><b>" . _DROPDOWN_MEMBERSONLY . "</b></td>
                <td class='bg1'>";

    if (0 == $membersonly) {
        $checked_members = 'checked';

        $checked_allusers = '';
    } else {
        $checked_allusers = 'checked';

        $checked_members = '';
    }

    echo "
                <input type='radio' $checked_members  name='membersonly' value='1'>" . _DROPDOWN_ALL . "
                <input type='radio' $checked_allusers name='membersonly' value='0'>" . _DROPDOWN_MEMBERS . "
                </td>
                </tr>
                <tr>
                <td class='bg3'>&nbsp;</td>
                <td class='bg1'><input type='hidden' name='fct' value='dropdown'><input type='hidden' name='op' value='DropDownSave'><input type='submit' value='" . _DROPDOWN_SAVECHANG . "'></td>
                </tr>
                </table>
        </td>
        </tr>
        </table>

        </form>";

    CloseTable();
}

function DropDownSave($menuid, $xposition, $itemname, $itemurl, $down, $membersonly)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $itemname = $myts->addSlashes(trim($itemname));

    $itemurl = $myts->addSlashes(trim($itemurl));

    $xoopsDB->query('UPDATE ' . $xoopsDB->prefix('dropdown') . " SET position=$xposition, itemname='$itemname', itemurl='$itemurl', down=$down, membersonly=$membersonly WHERE menuid=$menuid");

    redirect_header('index.php?op=DropDownAdmin', 1, _DROPDOWN_DBUPDATED);

    exit();
}

function DropDownAdd($xposition, $itemname, $itemurl, $down, $membersonly)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $itemname = $myts->addSlashes(trim($itemname));

    $itemurl = $myts->addSlashes(trim($itemurl));

    $newid = $xoopsDB->genId($xoopsDB->prefix('dropdown') . '_menuid_seq');

    $xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('dropdown') . " (menuid, position, itemname, itemurl, down, membersonly) VALUES ($newid, $xposition, '$itemname', '$itemurl', $down, $membersonly)");

    redirect_header('index.php?op=DropDownAdmin', 1, _DROPDOWN_DBUPDATED);

    exit();
}

function DropDownDel($menuid, $ok = 0)
{
    global $xoopsDB, $xoopsConfig, $xoopsModule;

    if (1 == $ok) {
        $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix(dropdown) . " WHERE menuid=$menuid");

        redirect_header('index.php?op=DropDownAdmin', 1, _DROPDOWN_DBUPDATED);

        exit();
    }

    xoops_cp_header();

    OpenTable();

    $result = $xoopsDB->query('SELECT position, itemname, itemurl, down, membersonly FROM ' . $xoopsDB->prefix('dropdown') . " WHERE menuid=$menuid");

    [$position, $itemname, $itemurl, $down, $membersonly] = $xoopsDB->fetchRow($result);

    echo '<big><b>' . _DROPDOWN_TITLE . '</big></b>';

    echo "<h4 style='text-align:left;'>" . _DROPDOWN_DELETEMENUITEM . "</h4>
                <form action='index.php' method='post'>
                <input type='hidden' name='menuid' value='$menuid'>
                <table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%'>
                        <tr>
                        <td class='bg2'>
                        <table width='100%' valign='top' border='0' cellpadding='4' cellspacing='1'>
                                <tr>
                                <td class='bg3' width='30%'><b>" . _DROPDOWN_POS . "</b></td>
                                <td class='bg1'>" . $position . "</td>
                                </tr>
                                <tr>
                                <td class='bg3'><b>" . _DROPDOWN_ITEMNAME . "</b></td>
                                <td class='bg1'>" . $itemname . "</td>
                                </tr>
                                <tr>
                                <td class='bg3'><b>" . _DROPDOWN_ITEMURL . "</b></td>
                                <td class='bg1'>" . $itemurl . '</td>
                                </tr>
                        </table>
                        </td>
                        </tr>
                </table>
                </form>';

    echo "<table valign='top'><tr>";

    echo "<td width='30%'valign='top'><span style='color:#ff0000;'><b>" . _DROPDOWN_WANTDEL . '</b></span></td>';

    echo "<td width='3%'>\n";

    echo myTextForm("index.php?op=DropDownDel&menuid=$menuid&ok=1", _DROPDOWN_YES);

    echo "</td><td>\n";

    echo myTextForm('index.php?op=DropDownAdmin', _DROPDOWN_NO);

    echo "</td></tr></table>\n";

    CloseTable();
}

switch ($op) {
    case 'DropDownDel':
        DropDownDel($menuid, $ok);
        break;
    case 'DropDownAdd':
        DropDownAdd($xposition, $itemname, $itemurl, $down, $membersonly);
        break;
    case 'DropDownSave':
        DropDownSave($menuid, $xposition, $itemname, $itemurl, $down, $membersonly);
        break;
    case 'DropDownAdmin':
        DropDownAdmin();
        break;
    case 'DropDownEdit':
        DropDownEdit($menuid);
        break;
    default:
        DropDownAdmin();
        break;
}
xoops_cp_footer();
