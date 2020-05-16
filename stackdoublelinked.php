<?php

 
include 'stack.php';


// -------------------------------Class StackDoubleLinked--------------------------------------
// Salvatore G. Fiore copyright 2020 www.salvatorefiore.com
// The main purpose: to be used for extending an allocated dynamically stack to a double linked 
// stack with (x)nodes. The class is abstracted on a double linked list structure.
//
//     T O P
//      ^|
//      |v
//     node
//      ^|
//      |v
//     node
//      ^|
//      |v
//     node
//      ^|
//      |v
//  B O T T O M
//
// The node are interlinked in a sequential way to other nodes with double links on a pile stack 
// style.
// Some methods are overridden to allow the implementation of a pointer to previous nodes
// to work armoniously with the next node pointer.
// 

class StackDoubleLinked extends Stack
{
      
       protected $key;        // key of the list (alphanumeric)
    
       // Constructor calling parent constructor
       public function __construct($key) 
       {
                $this->key = (string) $key;
                parent::__construct();
       }


       // Pushing a new node on the stack. Returns the node number
       // just inserted on the top of the stack.
       public function push($item) 
       {
            $node = new StackNodeDoubleLinked($item);
            $node->nextNode = null;
            $node->prevNode = $this->top;
            
            if($this->bottom !== null)
               $this->top->nextNode = $node; 
            else
               // set the bottom
               $this->bottom = $node;
               
            $this->top = $node; 
            
            // update total of nodes in the stack
            $this->top->nodeNum = ++$this->totNode;
     
            return  $this->top->nodeNum;
        }
        
        
        // Popping a node from the stack.
        // Returns false if the stack is empty
        public function pop() 
        {  
            if($this->totNode > 0)
            {
                $prevnode = $this->top->prevNode;
                unset($this->top);
                
                $this->top = $prevnode;
            
                --$this->totNode;
                return true; 
            }
            else
                return false; 
        }
 
 
        // Printing the whole stack
        public function listStack() 
        {
    
            $currentNode = $this->bottom;
            while($currentNode !== null)
            {
               // replace this line with your display class method
               echo $currentNode->stackvalue . " -" . $currentNode->nodeNum . "-  " . "<" . $currentNode->prevNode->nodeNum  .  ">";
                                                        
               $currentNode = $currentNode->nextNode;
            
            } 
        }
 
 
        // Iterator traversing the stack. Callback user function is called at each
        // iteration receiving the current node passed as argument. 
        // Iteration may be offset starting at $Node. During iteration node position
        // can be changed by the $callback function if receiving the $currentNode reference.
        // The iteration can end prematurely if the callable user function returns false;
        public function iteratorStackNode($callback,$Node=null,$mode=null) 
        {         
            if($Node === null)
                $currentNode = $this->top;
            else
               $currentNode = $Node;
               
            while($currentNode !== null) 
            {
                if(call_user_func($callback,$currentNode) === false)
                    return false;
       	        
       	        if($mode !== "-")
                    $currentNode = $currentNode->nextNode;
                else
                    $currentNode = $currentNode->prevNode;
                
            }
            return true;
        }
  
  


     
        public function getStackKey()
        {      
            return $this->key;
        }
 
 
 
        // Destructor
        public function __destruct()
        {  
            
        }
        
}




// Class StackNode contains a value an index, a pointer 
// to next node. 
class StackNodeDoubleLinked extends StackNode
{
    public $prevNode;          // pointer to previous node in the stack


    // constructor calling parent constructor and initialising the previous
    // node pointer to null
    public function __construct($item) 
    {
        parent::__construct($item);
        $this->prevNode = null;
    }
} 



?>



