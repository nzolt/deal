<?php
require_once 'class/deal.php';
require_once 'PHPUnit/Autoload.php';



class dealTest extends PHPUnit_Framework_TestCase {

    protected $dealer;
    protected $originalDeck;
    protected $shuffledDeck;

    public function __construct() {
        parent::__construct();
        $this->dealer = new deal();
        $this->originalDeck = $this->dealer->get_deck();
    }
    
    public function testDealClass() {
        $this->assertMethodExist($this->dealer, 'get_deck');
        $this->assertMethodExist($this->dealer, 'set_deck');
        $this->assertMethodExist($this->dealer, 'get_cardtypes');
        $this->assertMethodExist($this->dealer, 'get_cards');
        $this->assertMethodExist($this->dealer, 'generate_deck');
        $this->assertMethodExist($this->dealer, 'shuffle_cards');
        $this->assertMethodExist($this->dealer, 'deal_cards');
        $this->assertMethodExist($this->dealer, 'deal_hand');
        $this->assertMethodExist($this->dealer, 'get_hands');
        $this->assertMethodExist($this->dealer, 'get_dealedcardnr');
        $this->assertMethodExist($this->dealer, 'count_deck');
        $this->assertMethodExist($this->dealer, 'print_cards');
    }
        
    public function testDeckNr() {
        $this->assertEquals( 52, count($this->dealer->get_deck()));
    }
    
    public function testDeckNrInternal() {
        $this->assertEquals( 52, $this->dealer->count_deck());
    }
    
    public function testShuffle() {
        $this->shuffledDeck = $this->dealer->shuffle_cards()->get_deck();
        $deckDiff = array_intersect($this->originalDeck, $this->shuffledDeck);
        //var_dump($this->shuffledDeck);
        //var_dump($deckDiff);
        //$this->assert
    }
    
    public function testHand() {
        
    }
    
    public function testHands() {
        
    }
    
    public function testDealHands() {
        /*$this->dealer->
        $this->assertArrayNotHasKey();*/
    }
    
    public function testDealDeck() {
        
    }
    
    public function testHandDeck() {
        
    }

    /**
    * Assert that a class has a method 
    *
    * @param string $class name of the class
    * @param string $method name of the searched method
    * @throws ReflectionException if $class don't exist
    * @throws PHPUnit_Framework_ExpectationFailedException if a method isn't found
    */
   function assertMethodExist($class, $method) {
       $oReflectionClass = new ReflectionClass($class); 
       $this->assertTrue($oReflectionClass->hasMethod($method));
   }
    
}

 

/*echo PHP_EOL;
echo 'Dealed card number:      ' . $dealer->get_dealedcardnr().PHP_EOL;
echo 'Remaining cards on deck: ' . $dealer->count_deck().PHP_EOL;*/
