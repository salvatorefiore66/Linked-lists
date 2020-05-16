<?php

// -------------------------------Class Stack ------------------------------------
// Salvatore G. Fiore copyright 2020 www.salvatorefiore.com
// The main purpose: to be used for allocating dynamically a stack with (x)nodes.
//
//  top
//   ^
//   |
//  node
//   ^
//   |
//  node
//   ^
//   |
//  node
//   ^
//   |
// bottom
//
// The node is interlinked in a sequential way to other nodes on a pile stack
// style.
//
// Each node is self contained and the stack is able to manage 
// a value (generic type) for each node;
//
// The stack can use callback user functions before pushing or popping and soon after. 
// If callbeforenode returns false the node will not be pushed or popped from the stack.  
//
// Methods for the management of the stack included are: popping iterating printing multipushing.
// Can handle millions of nodes depending on memory availability. 
// Unsetting a class instance will free the memory allocated for the nodes and all 
// contents will be lost. 
//
// Callback functions will be invoked as : 
//
// during pushing
// before pushing callback (type Integer node_number_to_be_pushed)
// after pushing  callback (type StackNode top_of_the_stack_node)
//
// during popping
// before popping callback (type Integer node_number_to_be_popped)
// after popping callback (type StackNode top_of_the_stack_node)


class Stack
{
       protected $bottom;                   // bottom of the stack
       protected $top;                      // last inserted node top of the stack
       protected $callbeforenode;           // callback function before pushing / popping
       protected $callafternode;            // callback function after pushing / popping
       protected $totNode;                  // total nodes in the stack
    
    
       // Constructor with two arguments.
       // Callback user functions invoked before each node pushing or popping 
       // and soon after.
       public function __construct($before=null,$after=null) 
       {
            $this->bottom = null;
            $this->top = null;
            $this->totNode = 0;
            $this->callbeforenode = $before;   
            $this->callafternode = $after;
       }


       // Pushing a new node on the stack. Returns the node number
       // just inserted on the top of the stack.
       public function push($item) 
       { 
       	    // callback function
       	    if($this->callbeforenode !== null)
       	    {
                if(call_user_func($this->callbeforenode,$this->top->nodeNum+1) === false)
                    return false;
       	    }
          
            $node = new StackNode($item);
            $node->nextNode = null;
            
            if($this->bottom !== null)
               $this->top->nextNode = $node; 
            else
               // set the bottom
               $this->bottom = $node;
               
            $this->top = $node; 
            $this->top->nodeNum = ++$this->totNode;
            if($this->callafternode !== null)
       	    {
                call_user_func($this->callafternode,$this->top);
       	    }
     
            return  $this->top->nodeNum;
        }
        
        
        
        // Pushing n nodes in one go. Values to be inserted
        // are passed in the array $value
        public function multiPush($n,$value)
        {
             for($x = 0; $x< $n; $x++)
             
                 // pushing nodes containing values
                 $this->push($value[$x]);
        }
  
  
        // Popping n nodes in one go.
        public function multiPopping($n)
        {
             for($x = 0; $x< $n; $x++)
                 $this->pop();
        }
  

  
        // Iterator traversing the stack. Callback user function is called at each
        // iteration receiving the current node passed as argument. 
        // Iteration may be offset starting at $startAtNode.
        // The iteration can end prematurely if the callable user function returns false;
        public function iteratorStack($callback,$startAtNode=1) 
        {         
        
            $currentNode = $this->getNode($startAtNode);
        
            while($currentNode !== null) 
            {
                if(call_user_func($callback,$currentNode) === false)
                    return false;
       	    
                $currentNode = $currentNode->nextNode; 
                
            }
            return true;
        }
  
  
  
  
        // Printing the whole stack
        public function listStack() 
        {
          
            $currentNode = $this->bottom;
            while($currentNode !== null)
            {
               // replace this line with your display class method
               echo $currentNode->stackvalue . " -" . $currentNode->nodeNum . "-  ";
                                                        
               $currentNode = $currentNode->nextNode;
            
            }
        }
 
 
 
     
        // Popping a node from the stack. Returns the node popped from the stack.
        // Returns false if the stack is empty
        public function pop() 
        {  
            if($this->totNode > 0)
            {
                // callback function
       	        if($this->callbeforenode !== null)
       	        {
                    if(call_user_func($this->callbeforenode,$this->top->nodeNum) === false)
                        return false;
       	        }
               
                $oldnode = $this->top;
            
                $node = $oldnode;
            
                $this->top = $this->getNode(--$this->totNode);
                $this->top->nextNode = null;
                if($this->totNode == 0)
                    $this->bottom = null;
    
                unset($oldnode);
                
        
                if($this->callafternode !== null)
       	        {
                    call_user_func($this->callafternode,$this->top);
       	        }
     
                return $node; 
            }
            else
                return false; 
        }
 
 
        
        // Returning the value of a node 
        // the node number is passed by parameter
        public function getValue($itemnumb)
        {
                 
            $currentnode = $this->bottom;
             
            for($x=0; $x < $itemnumb && $currentnode !== null;  $x++)
                $currentnode = $currentnode->nextNode;
         
            return $currentnode->stackvalue;     
            
        }
         
         
        // Returning a node with the node number
        // passed by parameter
        public function getNode($nodeNum)
        {
            $node = null;
            $currentnode = $this->bottom;
            for($x=0; $x < $nodeNum && $currentnode !== null;  $x++)
            {
                $node = $currentnode;
                $currentnode = $currentnode->nextNode;
            }
            if ($currentnode === null)
                return false;
            else
                return $node;
        }
         
         
        // Returning bottom of the stack
        public function getBottom()
        {
            return $this->bottom;
        }
       
         
        // Returning top of the stack
        public function getTop()
        {
            return $this->top;
        }
        
        
        // Returning total number of nodes in the stack
        public function getTotStackNode()
        {
            return $this->totNode;
        }
        
       
        // Destructor
        public function __destruct()
        {  
            
        }
        
}



// Class StackNode contains a value an index, a pointer 
// to next node. 
class StackNode
{
    public $stackvalue;                      // the node item value
    public $nodeNum;                         // the node sequential index in the stack
    public $nextNode;                        // pointer to next node in the stack

    public function __construct($stackitem) 
    {
        
        $this->stackvalue = $stackitem;
        $this->nextNode = null;
    }
} 



?>



