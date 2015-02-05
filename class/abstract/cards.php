<?php

/* 
 * 
 */
require_once '/class/interface/dealinterface.php';

abstract class cards implements dealinterface {
    
    /**
     * @var browser bool - display type (cli / browser)
     * @var burn bool - if vant to burn card
     * @var deck array - deck of cards 
     */
    protected $browser = FALSE;
    protected $burn = TRUE;
    protected $deck = array();
    
    /**
     * set display type (TRUE = Browser, FALSE = cli)
     * default FALSE - cli
     * @param bool $to_browser
     */
    public function set_browser($to_browser) {
        $this->browser = $to_browser;
    }
    
    /**
     * set burn cards between rounds
     * default TRUE - burn
     * @param bool $burn
     */
    public function set_burn($burn) {
        $this->burn = $burn;
    }
    
    /**
     * get the deck of cards, generate new if none or reset
     * @param bool $reset
     * @return array
     */
    public function get_deck($reset = FALSE){
        if($reset){
            $this->reset_deck();
        }
        if(count($this->deck) == 0){
            $this->set_deck();
        }
        return $this->deck;
    }
    
    /**
     * drop the current deck
     * @return \cards
     */
    protected function reset_deck() {
        $this->deck = array();
        return $this;
    }
    
    /**
     * set the current deck of cards with a predefined deck
     * @param array $deck
     * @return \cards
     */
    protected function set_deck(array $deck = NULL) {
        if($deck === NULL){
            $this->generate_deck();
        } else {
            $this->deck = $deck;
        }
        return $this;
    }
    
    /**
     * get card types ('Heart', 'Club', 'Diamond', 'Spade')
     * @return array
     */
    protected function get_cardtypes() {
        return array('Heart', 'Club', 'Diamond', 'Spade');
    }
    
    /**
     * get cards of the types
     * ('Ace', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Jack', 'Queen', 'King')
     * @return array
     */
    protected function get_cards() {
        return array('Ace', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Jack', 'Queen', 'King');
    }
    
    /**
     * generate the cards deck from cardtypes and cards
     * set the $this->deck array count 52 cards
     * @return \cards
     */
    protected function generate_deck() {
        $cards = $this->get_cards();
        foreach ($this->get_cardtypes() as $type) {
            foreach ($cards as $card) {
                if($this->browser === FALSE){
                    $this->deck[] = $type.' '.$card;
                } else {
                    $this->deck[] = '<div class="Cards ' .$type.' '.$card.'"></div>';
                }
            }
        }
        return $this;
    }
}