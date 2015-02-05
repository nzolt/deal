<?php
require_once 'class/deal.php';
$dealer = new deal();
//$dealer->deal_cards(true);
$dealer->deal_poker(true);
echo PHP_EOL;
echo 'Dealed card number:      ' . $dealer->get_dealedcardnr().PHP_EOL;
echo 'Total cards burned:      ' . $dealer->get_burnedcards().PHP_EOL;
echo 'Remaining cards on deck: ' . $dealer->count_deck().PHP_EOL;
