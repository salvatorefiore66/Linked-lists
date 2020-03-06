<?php

// -------------------------------Class LinkedList------------------------------------
// Salvatore G. Fiore copyright 2020 www.salvatorefiore.com
// The main purpose: to be used for allocating dinamically a linked list with (x)nodes.
//
// head----->node----->node----->node----->node----->node----->null
//
// The node is interlinked in a sequential way to other nodes. 
// Each node is self contained and the list is able to manage 
// a value (generic type) for each node;
// The list can use callback user functions before each node insertion and soon after. 
// If callbeforenode returns false the node will not be inserted. 
// Methods for the management of the list include sorting searching 
// cutting unsetting inserting renumbering circular deleting. Can handle millions of 
// nodes depending on memory availability.


class LinkedList
{
       protected $head;                   // head of the list
       protected $lastNode;               // last inserted node
       protected $callbeforenode;         // callback function before insertion
       protected $callafternode;          // callback function after insertion
       protected $totNode;                // total nodes in the list
    
     
       // Constructor with two arguments 
       public function __construct($before,$after) 
       {
            $this->head = null;
            $this->lastNode = null;
            $this->totNode = 0;
            $this->callbeforenode = $before; 
            $this->callafternode = $after;
       }
    
    
       // Inserting a new node. Returns the node number
       // just inserted
       // before callback (type Integer node_number_to_be_inserted)
       // after  callback (type ListNode node)
       public function insertNode($item) 
       { 
       	    // callback function
       	    if($this->callbeforenode !== null)
       	    {
                if(call_user_func($this->callbeforenode,$this->lastNode->nodeNum+1) === false)
                    return false;
       	    }
          
            $node = new ListNode($item);
            $node->nextNode = null;
            
            if($this->head !== null)
               $this->lastNode->nextNode = $node; 
            else
               // set the head
               $this->head = $node;
               
            $this->lastNode = $node; 
            
            if($this->callafternode !== null)
       	    {
                if(call_user_func($this->callafternode,$this->lastNode) === false)
                    return false;
       	    }
            
            $this->totNode++;
            $this->lastNode->nodeNum = $this->totNode;
            return  $this->lastNode->nodeNum;
        }
        
        
        // Allocating n nodes in one go. Values to be inserted
        // are passed in the array $value
        public function allocateNode($n,$value)
        {
             for($x = 0; $x< $n; $x++)
             
                 // insert nodes containing values
                 $this->insertNode($value[$x]);
        }
  

        // Finding the first node value passed as argument
        // returns the number of node containing the value otherwise
        // 0 if the value has not been found
        public function findFirstLinear($item) 
        {         
            $currentNode = $this->head;
                       
            while($currentNode->listvalue != $item && $currentNode !== null) 
                    $currentNode = $currentNode->nextNode; 
            if($currentNode !== null)  
                   return $currentNode->nodeNum;
            else
                   return 0;
        }
     
     
        
        // Printing the whole list
        public function listList() 
        {
          
            $currentNode = $this->head;
            while($currentNode !== null)
            {
               // replace this line with your display class method
               echo $currentNode->listvalue . " -" . $currentNode->nodeNum . "-  ";
                                                        
               $currentNode = $currentNode->nextNode;
            
            }
        }
 
 
    
        // Swapping the value of two nodes
        // the node numbers are passed by parameter
        public function swapNodes($nodeoneNum,$nodetwoNum)
        {
            
            $cNode= $this->getNode($nodeoneNum); 
            $nNode = $this->getNode($nodetwoNum);
      
            // Access the nodes and swap values
            $tempvar = $cNode->listvalue;
            $cNode->listvalue = $nNode->listvalue;
            $nNode->listvalue = $tempvar; 
            
        }
        
        
     
        // Renumbering the whole list >= 1 <= n
        public function renumList() 
        {
          
            $currentNode = $this->head;
            $numb = 0;
            
            while($currentNode !== null)
            {
                        
                $numb++;
                $currentNode->nodeNum = $numb;
                                                        
                $currentNode = $currentNode->nextNode;
            
            }
            $this->totNode = $numb;
        }
     
     
        // Delete a node from the list. Node number is passed as argument.
        // Returns the total nodes in the list
        public function deleteNode($n) 
        {  
            $node = $this->getNode($n);
            
            if($n === 1)
            {
                $this->head = $this->getNode($n+1);
            }
            elseif($n === $this->totNode)
            { 
                $this->lastNode = $this->getNode($n-1);
                $this->lastNode->nextNode = null;
            }
            else
            {   
                $nodeb = $this->getNode($n-1);
                $nodeb->nextNode = $this->getNode($n+1);
            }
    
            unset($node->listvalue);
            unset($node->nodeNum);
            unset($node->nextNode);
            unset($node);
            
            $this->lastnode = $this->getNode($this->totNode);
            $this->totNode = $this->totNode-1;
            $this->renumList();
            return $this->totNode;
        }
 
 
 
    
        // Cutting the list at node n
        public function cutList($n) 
        {
            $oldnode = null;
            $currentNode = $this->head;
            
            while($currentNode !== null)
            {
                if($currentNode->nodeNum ===  $n)
                {
                    $oldnode = $currentNode->nextNode;
                    $currentNode->nextNode = null;
                    $this->lastNode = $currentNode;
                
                    $this->totNode = $n;
                    break;
                }
                
                $currentNode = $currentNode->nextNode;
            }
            $currentNode = $oldnode;
            while($currentNode !== null)
            {
                $currentNode = $currentNode->nextNode;
            
                unset($oldnode->listvalue);
                unset($oldnode->nodeNum);
                unset($oldnode->nextNode);
                unset($oldnode);
                
                $oldnode = $currentNode;
            }
        }
     
        
    
        // Descendending order list sorting with bubble sort
        // It's a bit slow for high number of nodes > 80000
        public function ListSortDesc() 
        {
            static $len=0;
            $tempvar;
            $lenght = $this->lastNode->nodeNum;
            $cNode = $this->head;
            $nNode = $this->head->nextNode;
           
            for($n=0; $n < $lenght-1; $n++)
            {         
                if($cNode->listvalue <  $nNode->listvalue)
                {              
                    $tempvar = $nNode->listvalue;
                    $nNode->listvalue = $cNode->listvalue;
                    $cNode->listvalue = $tempvar;                           
                }
              
                $cNode = $cNode->nextNode;
                $nNode = $cNode->nextNode;
            }     
            while($len < $lenght)
            {
                $len++;
                $this->ListSortDesc();  
            }       
            $this->lastNode = $cNode;
        }
        
        
    
    
        // Ascendending order list sorting with bubble sort
        // It's a bit slow for high number of nodes > 80000
        public function ListSortAsc() 
        {
            static $len=0;
            $tempvar;
            $lenght = $this->lastNode->nodeNum;
            $cNode = $this->head;
            $nNode = $this->head->nextNode;
           
            for($n=0; $n < $lenght-1; $n++)
            {         
                if($cNode->listvalue > $nNode->listvalue)
                {              
                    $tempvar = $cNode->listvalue;
                    $cNode->listvalue = $nNode->listvalue;
                    $nNode->listvalue = $tempvar;                           
                }
                                   
                $cNode = $cNode->nextNode;
                $nNode = $cNode->nextNode;
            }     
            while($len < $lenght)
            {
                $len++;
                $this->ListSortAsc();  
            }       
            $this->lastNode = $cNode;
        }
     
        
        
        
        // Transforms a linked list in a circular list
        public function makecircular()
        {
            $this->lastNode->nextNode = $this->head; 
        }
        
        
        // Returning the value of a node 
        // the node number is passed by parameter
        public function getValue($itemnumb)
        {
                 
            $currentnode = $this->head;
             
            for($x=0; $x < $itemnumb && $currentnode !== null;  $x++)
                $currentnode = $currentnode->nextNode;
         
            return $currentnode->listvalue;     
            
        }
         
         
        // Returning a node with the node number
        // passed by parameter
        public function getNode($nodeNum)
        {
            $node = null;
            $currentnode = $this->head;
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
         
        
         
        // Returning last node
        public function getlastNode()
        {
            return $this->lastNode;
        }
        
        // Returning first node
        public function getfirstNode()
        {
            return $this->head;
        }
        
}



// Class node contains a value an index, a pointer 
// to next node. 
class ListNode
{
    public $listvalue;                   // the node item value
    public $nodeNum;                     // the node sequential index in the list
    public $nextNode;                    // pointer to next node in the list

    public function __construct($listitem) 
    {
        
        $this->listvalue = $listitem;
        $this->nextNode = null;
    }
} 

?>
