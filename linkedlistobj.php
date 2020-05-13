<?php

include 'stack.php';


// -------------------------------Class  LinkedListObj------------------------------
// Salvatore G. Fiore copyright 2020 www.salvatorefiore.com
// The main purpose: to be used for allocating dynamically a double linked list of
// (x)nodes with child pointers to objects.
//
// head----->node----->node----->node----->node----->node----->null
//             |         |         |         |         |
//           child     child     child     child     child    
//
//
// head<-----node<-----node<-----node<-----node<-----node<-----null
//             |         |         |         |         |
//           child     child     child     child     child    
//
// The node is interlinked in a sequential way to other nodes (next and previous)
// Each node is self contained and the list is able to manage 
// a key for each node and a pointer to children objects.
// Each list node can handle a child which is fundamentally a pointer to an object 
// the class should manage. Children can also be put in a stack for further manipulation. 
// The class LinkedListObj includes a method for stacking through the class Stack documented 
// in stack.php. 
//
// Methods for the management of the list include sorting searching 
// cutting unsetting inserting renumbering circular deleting.
// Can handle millions of  nodes depending on memory availability. 
// Unsetting a class instance will free the memory allocated for the nodes and all 
// contents will be lost. 

      

class LinkedListObj
{
        protected $key;                    // key of the list (alphanumeric)
        protected $head;                   // head of the list
        protected $lastNode;               // last inserted node
        protected $totNode;                // total nodes in the list
  

        // Constructor with list key as argument
        public function __construct($key=null) 
        {
            $this->head = null;
            $this->lastNode = null;
            $this->totNode = 0;
            $this->key = (string ) $key;
        }
    
    
        // Set the list key with an alphanumeric value.
        public function setListKey($key) 
        {
            $this->key = (string ) $key;
            return true;
        }
       
       
        // Inserting a new node. Returns the inserted node.
        public function insertNode($item) 
        { 
            $node = new ListNodeObj($item);
            $node->nextNode = null;
            $node->prevNode = $this->lastNode;
            
            if($this->head !== null)
               $this->lastNode->nextNode = $node; 
            else
               // set the head
               $this->head = $node;
               
            $this->lastNode = $node; 
            $this->lastNode->nodeNum = ++$this->totNode;
    
            return $node;
        }
        
        

        // Inserting a new node at a given position. Returns the inserted node.
        public function insertNodeAt($n,$item) 
        {
          
            if($n > $this->lastNode->nodeNum)
       	    {
       	        return $this->insertNode($item);
       	    }
       	    
            $node = new ListNodeObj($item);
       	    $currnode= $this->getNode($n);
       	        
       	    if($n === 1)
       	    {
       	        $prevNode = null;
       	        $this->head = $node;
       	    }
       	    else
       	    {
       	        $prevNode = $currnode->prevNode;
       	        $prevNode->nextNode = $node;
       	    
       	    }
       	        
       	    // update pointers to previous and next nodes
       	    $node->nextNode = $currnode;
       	    $node->prevNode = $prevNode;
       	    $currnode->prevNode = $node;
       	    
       	
            $this->renumNode($node->prevNode);
            return  $node;
        }
        
        
        
    
        // Inserting a new node in the ascending sorted list nearest
        // to the key $key. Returns the inserted node.
        // If the list is descending order sorted the insert direction 
        // $mode should be set to "-".
        public function insertNodeNearestOf($key,$mode=null) 
        {
            if($mode != "-")
            { 
                $Node = $this->head;
                while($Node !== null && $Node->nodeKey < $key)
                    $Node = $Node->nextNode;
            }
            else
            { 
                $Node = $this->lastNode;
                while($Node !== null && $Node->nodeKey < $key)
                    $Node = $Node->prevNode;
            }
           
            $node = new ListNodeObj($key);
            
            if($Node->nodeNum == 1)
       	    {
       	        $prevNode = null;
       	        $this->head = $node;
       	    }
       	    else
       	    {
       	        $prevNode = $Node->prevNode;
       	        $prevNode->nextNode = $node;
       	    }
       	        
       	    // update pointers to previous and next nodes
       	    $node->nextNode = $Node;
       	    $node->prevNode = $prevNode;
       	    $Node->prevNode = $node;
       	
            $this->renumNode($node->prevNode);
            return  $node;
        }
        
        
        

        // Allocating n nodes in one go. Values to be inserted
        // are passed in the array $value
        public function allocateNode($n,$value)
        {
             for($x = 0; $x< $n; $x++)
             
                 // insert nodes containing values
                 $this->insertNode($value[$x]);
        }
  
  
  
  
        // Allocating n nodes in one go. Position of insertion and values
        // to be inserted are passed respectively in the array $n and $value
        public function allocateNodeAt($values)
        {
            foreach($values as $key => $value)
                // insert nodes containing values
                $this->insertNodeAt($key,$value);
        }
  
  
  
  
        // Inserting a child for a node number $n. The actual node where to insert
        // can also be passed. Returns the inserted child.
        // The object should be passed in $childobj already instantiated and 
        // initialised.
        public function insertChild($node,$childobj) 
        {
       	    if(is_numeric($node))
       	        $node = $this->getNode($node);
       	        
            $node->child = $childobj;
            
            return $node->child ;
        }
  
 
  
        
        // unset child node from $node
        public function removeChild($node) 
        {
       	    if(is_numeric($node))
       	        $node = $this->getNode($node);
       	        
            unset($node->child);
            
            return true;
        }
  
  
  
  
        // Iterator traversing the list. Callback user function is called at each
        // iteration receiving the current node passed as argument. 
        // Iteration may be offset starting at $startAtNode
        // For reverse order iterations $mode should be set to "-"
        // The iteration can end prematurely if the callable user function returns false;
        public function iteratorList($callback,$startAtNode=1,$mode="") 
        {         
        
            $currentNode = $this->getNode($startAtNode);
        
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
  
  
  
    
        // Iterator traversing the list. Callback user function is called at each
        // iteration receiving the current node passed as argument. 
        // Iteration may be offset starting at $Node.
        // The iteration can end prematurely if the callable user function returns false;
        // The method can receive the node number or the actual node from where to
        // start the iteration.
        public function iteratorListAtNode($callback,$Node=null,$mode="") 
        {         
        
            if($Node === null)
                $currentNode = $this->head;
            else if(is_numeric($Node))
                $currentNode = $this->getNode($Node);
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
  
  
  
  
        // Iterator traversing the list. The  callback user function
        // which is called at each iteration receiving the current node passed as argument.
        // The callback can however change the current list node position being iterated receiving
        // a reference to it.
        // Iteration may be offset starting at $Node.
        // The iteration can end prematurely if the callable user function returns false;
        public function iteratorNode($callback,$Node=null,$mode="") 
        {         
        
            if($Node === null)
                $currentNode = $this->head;
            else
               $currentNode = $Node;
        
            while($currentNode !== null) 
            {
        
                if($callback($currentNode) === false)
                    return false;
       	    
                if($mode !== "-")
                    $currentNode = $currentNode->nextNode; 
                else
                    $currentNode = $currentNode->prevNode; 
                
            }
            return true;
        }
  
  
      
        

        // Seeking the first node value passed as argument
        // Returns the number of node containing the value otherwise
        // 0 if the value has not been found
        public function findFirstLinear($item) 
        {         
            $currentNode = $this->head;
                       
            while($currentNode->nodeKey != $item && $currentNode !== null) 
                    $currentNode = $currentNode->nextNode; 
            if($currentNode !== null)  
                   return $currentNode->nodeNum;
            else
                   return 0;
        }
    

    
    
    
        // Seeking the first node value passed as argument
        // Returns the node containing the value otherwise null if the value has not been found.
        // A callback function can be called for user check routine passing current node value. 
        // If callback returns true the search is stopped returning current node.
        // Returns null if the node value has not been found
        public function findFirstNodeLinear($item,$callback=null) 
        { 
            $currentNode = $this->head;
                       
            while($currentNode !== null)
            {
                if($callback !== null)
                {
                    if(call_user_func($callback,$currentNode) === true)
                        break;
                }
                else
                {
                    // direct comparison
                    if($currentNode->nodeKey === $item)
                        break;
                    
                }
                $currentNode = $currentNode->nextNode; 
            }
            
            return $currentNode;
        }
     
    


        // Seeking the first node value passed as argument in the  ascending
        // sorted list. Returns the node containing the value otherwise null 
        // if the value has not been found.
        public function findFirstNodeSortedAscLinear($item) 
        {         
            $currentNode = $this->head;
        
            while($currentNode !== null && $currentNode->nodeKey < $item)
               
                $currentNode = $currentNode->nextNode;
        

            if($currentNode->nodeKey === $item)
                return $currentNode;
            else
                return null;
        }
    

        
        // Seeking the nearest node value passed as argument in the
        // ascending order sorted list. Returns the nearest node to the 
        // searched key $item. If the list is descending order sorted
        // the search direction $mode shoud be set to "-".
        public function findNearestNodeSortedLinear($item,$mode=null) 
        {         
           
            if($mode != "-")
                $currentNode = $this->head;
            else
                $currentNode = $this->lastNode;

            while($currentNode !== null && $currentNode->nodeKey < $item)
            {
                if($mode != "-")
                    $currentNode = $currentNode->nextNode;
                else
                    $currentNode = $currentNode->prevNode;
            }
                
            return $currentNode;
        }
   
   
        
        // Seeking the nearest node value passed as argument in the
        // ascending order sorted list. Returns the nearest node to the 
        // searched key $item.
        public function findNearestNodeSortedAscLinear($item) 
        {         
           
            $currentNode = $this->head;

            while($currentNode !== null && $currentNode->nodeKey < $item)
                    $currentNode = $currentNode->nextNode;
    
            return $currentNode;
        }
   
   
        
        // Seeking the nearest node value passed as argument in the
        // descending order sorted list. Returns the nearest node to the 
        // searched key $item. 
        public function findNearestNodeSortedDescLinear($item) 
        {         

            $currentNode = $this->lastNode;

            while($currentNode !== null && $currentNode->nodeKey < $item)
                    $currentNode = $currentNode->prevNode;
                
            return $currentNode;
        }
   
        
   
        // Printing the whole list
        public function listList() 
        {
            $currentNode = $this->head;
            while($currentNode !== null)
            {
               // replace this line with your display class method
               echo $currentNode->nodeKey . " -" . $currentNode->nodeNum . "-  " . " < " .$currentNode->prevNode->nodeNum . " > ";
                                                        
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
            $tempvar = $cNode->nodeKey;
            $cNode->nodeKey = $nNode->nodeKey;
            $nNode->nodeKey = $tempvar; 
            
        }
        
         
        // Renumbering the whole list >= 1 <= n.
        // The renumbering will start from this node onwards 
        // until the end of the list is reached.
        public function renumNode($Node) 
        {
            $currentNode = $Node;
            $numb = $Node->nodeNum-1;
            
            while($currentNode !== null)
            {
                $currentNode->nodeNum = ++$numb;
                $currentNode = $currentNode->nextNode;
            }
            $this->totNode = $numb;
        }
     
    
     
        // Renumbering the whole list >= 1 <= n.
        public function renumList() 
        {
            $currentNode = $this->head;
            $numb = 0;

            while($currentNode !== null)
            {
                $currentNode->nodeNum = ++$numb;
                $currentNode = $currentNode->nextNode;
            }
            $this->totNode = $numb;
        }
     
    
    
    
        // Delete a node from the list. Node number is passed as argument.
        // Returns the total nodes in the list
        public function deleteNode($n) 
        {  
        
            $currentNode = $this->head;
            
            while($currentNode !== null && $currentNode->nodeNum < $n)
                $currentNode = $currentNode->nextNode;
                
            if($n === 1)
            {
                $this->head = $this->head->nextNode;
                $this->head->prevNode = null;
            }
            elseif($n === $this->totNode)
            { 
                $this->lastNode = $this->lastNode->prevNode;
                $this->lastNode->nextNode = null;
            }
            else
            {   
              $currentNode->prevNode->nextNode = $currentNode->nextNode;
              $currentNode->nextNode->prevNode = $currentNode->prevNode;
            }
    
            
            unset($currentNode);

        
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
            
                unset($oldnode);
                
                $oldnode = $currentNode;
            }
        }
     
        
    
        // Descending order list sorting with bubble sort
        // It's a bit slow for high number of nodes > 80000
        public function ListSortDesc() 
        {
            static $len=0;
            
            $lenght = $this->lastNode->nodeNum;
            $cNode = $this->head;
            $nNode = $this->head->nextNode;
           
            for($n=0; $n < $lenght-1; $n++)
            {         
                if($cNode->nodeKey <  $nNode->nodeKey)
                {              
                    $tempkey = $nNode->nodeKey;
                    $tempchild = $nNode->child;
                    $nNode->nodeKey = $cNode->nodeKey;
                    $nNode->child = $cNode->child;
                    $cNode->nodeKey = $tempkey;
                    $cNode->child = $tempchild;
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
     
     
        
        
        // Ascending order list sorting with bubble sort
        // It's a bit slow for high number of nodes > 80000
        public function ListSortAsc() 
        {
            static $len=0;
            
            $lenght = $this->lastNode->nodeNum;
            $cNode = $this->head;
            $nNode = $this->head->nextNode;
           
            for($n=0; $n < $lenght-1; $n++)
            {         
                if($cNode->nodeKey > $nNode->nodeKey)
                {              
                    $tempkey = $cNode->nodeKey;
                    $tempchild = $cNode->child;
                    $cNode->nodeKey = $nNode->nodeKey;
                    $cNode->child = $nNode->child;
                    $nNode->nodeKey = $tempkey;
                    $nNode->child = $tempchild;
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
        
      
        
        
        // Returning the key of a node 
        // the node number is passed by parameter
        public function getKey($itemnumb)
        {
            $currentnode = $this->head;
             
            for($x=0; $x < $itemnumb && $currentnode !== null;  $x++)
            {
                $node = $currentnode;
                $currentnode = $currentnode->nextNode;
            }  
         
            return $node->nodeKey;
        }
         
    
    
     
        // Returning a node with the node number
        // passed by parameter
        // Return null if the node does not exists
        public function getNode($itemnumb)
        {
            $node = null;
            $currentnode = $this->head;
            
            if($itemnumb <= $this->totNode)
            {
                for($x=0; $x < $itemnumb && $currentnode !== null;  $x++)
                {
                    $node = $currentnode;
                    $currentnode = $currentnode->nextNode;
                }
            }
            return $node;     
         
        }
        
        
        
        // Returning a node offset from $Node
        // The function can also receive the node number in $Node.
        // Returns the offset node. If the mode is "-" the offset is calculated
        // on the left of the $Node
        public function getNodeOffset($offset,$Node,$mode=null)
        {
            if(is_numeric($Node))
                $Node = $this->getNode($Node);
      
            $node = null;
            $currentnode = $Node; 
            
            for($x=0; $x < $offset+1 && $currentnode !== null;  $x++)
            {
            
                $node = $currentnode;
                
                if($mode !== "-")
                    $currentnode = $currentnode->nextNode; 
                else
                    $currentnode = $currentnode->prevNode; 
               
            }  
            return $node;     
        }
        
     
        
        // Renumbering and linking backwards the whole list >= 1 <= n
        public function linkBackList() 
        {
           
            $numb = 0;
            $prevnode = null;
            $currentNode = $this->head;
            
            while($currentNode !== null)
            {
                $currentNode->prevNode = $prevnode;
                $currentNode->nodeNum = ++$numb;
                $prevnode = $currentNode; 
                $currentNode = $currentNode->nextNode;
    
            }
            $this->totNode = $numb;
        }
    

    
        // Stacking children in an dynamically allocated stack
        // A callback user function can be invoked at each node iteration and if
        // returning true the child will be saved on the stack.
        // The final stack order can be reversed by passing "-" in $mode.
        public function stackChildren($List,$callback=null,$mode=null) 
        {
    
            if($mode != "-")
                $currentNode = $List->head;
            else
                $currentNode = $List->lastNode;
    
            $stack = new Stack(null,null);
            
            while($currentNode !== null)
            {
                if($callback !== null)
                {
                    if(call_user_func($callback,$currentNode) === true)
                        $stack->push($currentNode->child);
                }
                else
                    $stack->push($currentNode->child);
                    
                if($mode != "-")
                    $currentNode = $currentNode->nextNode;
                else
                    $currentNode = $currentNode->prevNode;
            }
            return $stack;
        }
    
    
        
        // Returning first node
        public function getfirstNode()
        {
            return $this->head;
        }
       
         
        // Returning last node
        public function getlastNode()
        {
            return $this->lastNode;
        }
        
        
        
        // Returning total number of nodes in the list
        public function getTotListNode()
        {
            return $this->totNode;
        }
        
        
        
        // Returning the list key
        public function getListKey()
        {
            return $this->key;
        }
        
       
        // Destructor
        public function __destruct()
        {  
            
        }
        
}



// Class node contains a value an index, a pointer 
// to next node a pointer to previous node
class ListNodeObj
{
    public $nodeKey;                     // the node key (alphanumeric)
    public $nodeNum;                     // the node sequential index in the list
    public $child;                       // pointer to a generic object 
    public $nextNode;                    // pointer to next node in the list / last node pointing to null
    public $prevNode;                    // pointer to previous node in the list / first node pointing to null

    public function __construct($listitem) 
    {
        $this->nodeKey = (string ) $listitem;
        $this->child = null;
        $this->nextNode = null;
    }
} 



?>
