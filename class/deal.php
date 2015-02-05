<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of deal
 *
 * @author Zoltan Nagy
 */
require_once 'abstract/cards.php';

class deal extends cards {

    /**
     *
     * @var type 
     */
    protected $hands = array();
    public $shuffle = 10;
    protected $players = array('Player 1', 'Player 2', 'Player 3', 'Player 4');
    protected $dealed_cards;
    protected $burned_cards = array();

    /**
     * set the shuffle times of deck
     * @param int $stimes
     * @return \deal
     */
    public function set_shuffle($stimes) {
        if(is_int($stimes) && $stimes <= 5000){
            $this->shuffle = $stimes;
        }
        return $this;
    }
    
    /**
     * We will shuffle the pack 10 times for good measures!
     * @return \deal
     */
    protected function shuffle_cards($deck = array()) {
        if(count($deck) == 0){
            $deck = $this->get_deck();
        }
        
        for ($i = 0; $i != $this->shuffle; $i++) {
            mt_srand((double) microtime() * 1000000);
            $offset = mt_rand(10, 40);
            //First we will split our deck cards:
            $sliced_cards[0] = array_slice($deck, 0, $offset);
            $sliced_cards[1] = array_slice($deck, $offset, 52);

            //Then Shuffle Eeach
            shuffle($sliced_cards[0]);
            shuffle($sliced_cards[1]);

            //Reverse each pile
            $sliced_cards[0] = array_reverse($sliced_cards[0]);
            $sliced_cards[1] = array_reverse($sliced_cards[1]);

            //Re-Shuffle
            shuffle($sliced_cards[0]);
            shuffle($sliced_cards[1]);

            //Merge both stacks
            $unsliced = array_merge($sliced_cards[0], $sliced_cards[1]);

            //And another shuffle
            shuffle($unsliced);

            //Add in a flip
            array_flip($unsliced);
        }
        $this->set_deck($unsliced);

        return $this;
    }

    /**
     * deal 4 hands of 7 cards 
     * @param bool $print
     * @param bool $shuffle
     * @return \deal
     */
    public function deal_cards($print = FALSE, $shuffle = TRUE) {
        if($shuffle){
            $this->shuffle_cards();
        }
        $this->dealed_cards = $this->deal_hand(7, $this->players);
        if($print){
            $this->print_cards();
        }
        return $this;
    }
    
    /**
     * deal 4 hands Texas Holdem 
     * (4 hands of 2 cards, 3 cards for FLOP, 1 card TURN, 1 card RIVER)
     * @param bool $print
     * @param bool $shuffle
     * @return \deal
     */
    public function deal_poker($print = FALSE, $shuffle = TRUE) {
        if($shuffle){
            $this->shuffle_cards();
        }
        $this->dealed_cards = $this->deal_hand(2, $this->players);
        ($this->burn) ? $this->burn_card() : '';
        $this->dealed_cards += $this->deal_hand(3, array('Flop'));
        ($this->burn) ? $this->burn_card() : '';
        $this->dealed_cards += $this->deal_hand(1, array('Turn'));
        ($this->burn) ? $this->burn_card() : '';
        $this->dealed_cards += $this->deal_hand(1, array('River'));
        if($print){
            $this->print_cards();
        }
        return $this;
    }
    
    /**
     * burn the first card from the top (end) of deck
     * and incrase the number of burned cards
     * @return \deal
     */
    protected function burn_card() {
        $this->burned_cards[] = array_pop($this->deck);
        return $this;
    }

    /**
     * get the Nr. of gealed cards
     * @return int
     */
    public function get_dealedcardnr() {
        return $this->dealed_cards;
    }
    
    /**
     * get the current Nr. of cards burned
     * @return int
     */
    public function get_burnedcards() {
        return count($this->burned_cards);
    }

    /**
     * deal number of cards for each hand, returns number of cards dealed
     * one card for each player on one round
     * @param int $cardnr
     * @param array $keys
     * @param array $deck
     * @return int $dealed_cards
     */
    protected function deal_hand($cardnr, array $keys) {
        $dealed_cards = 0;
        for ($i = 1; $i <= $cardnr; $i++) {
            foreach ($keys as $player) {
                $this->hands[$player][$i] = array_pop($this->deck);
                $dealed_cards ++;
            }
        }
        return $dealed_cards;
    }

    /**
     * get the cards on hands
     * @return array
     */
    protected function get_hands() {
        return $this->hands;
    }
    
    /**
     * get number of cards on the current deck in game
     * @return int
     */
    public function count_deck() {
        return count($this->deck);
    }
                
    /**
     * print the cards on all hands
     * @param array $hands
     * @return \deal
     */
    public function print_cards(array $hands=NULL) {
        if($hands === NULL){
            $hands = $this->get_hands();
        }
        foreach ($hands as $playername => $hand) {
            if($this->browser === FALSE){
                echo $playername . ': ' . implode(' - ', $hand).PHP_EOL;
            } else {
                echo '<div class="players"><div class="players playername">'.$playername.'</div>';
                foreach ($hand as $card) {
                    echo $card;
                }
                echo '</div>';
            }
            
        }
        return $this;
    }

}
