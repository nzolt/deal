<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * interface class for 
 * @author Zoltan Nagy
 */
interface dealinterface {
    
    public function get_deck($reset = FALSE);
    public function deal_cards($print = FALSE, $shuffle = TRUE);
    public function deal_poker($print = FALSE, $shuffle = TRUE);
}
