<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"></meta>
    <head>
        <title>Card dealer</title>
        <meta name="description" content="Absurd test task"></meta>
        <style type="text/css" media="all"> @import url("css/style.css"); </style>
    </head>
    <body class="body">
        <div id="page">
            <div style="clear:both;"></div>
<?php
require_once 'class/deal.php';
$dealer = new deal();
$dealer->set_browser(TRUE);
//$dealer->deal_cards(true);
$dealer->deal_poker(true);
echo 'Dealed card number:      ' . $dealer->get_dealedcardnr();
echo 'Total cards burned:      ' . $dealer->get_burnedcards();
echo 'Remaining cards on deck: ' . $dealer->count_deck();
?>
            <div id="footer">Powered By Jetro © 2013</div>
        </div>
    </body>
</html>
