# Linked-lists

Very straightforward to use and extend.
Instantiate a new class LinkedList passing by argument the callback functions to be invoked before and after nodes insertion, otherwise null,null.The callbacks will receive the node number to be inserted, a pointer to the node just inserted. Follow various methods examples.




    // A new linked List. Passing callbacks functions to the constructor
    $mylist = new LinkedList("beforen","aftern");
   
   
    // insert 2 millions nodes containing random values
    for($x = 0; $x< 2000000; $x++)
             $mylist->insertNode(mt_rand());
  
    // Printing the total number of nodes in the list
    echo "  total nodes " .  $mylist->getlastNode()->nodeNum; 
  

    // Printing first node value
    echo "  first node node value " .  $mylist->getfirstNode()->listvalue . "  ";
   
    
    // Printing last node value
    echo "  last node value " .  $mylist->getlastNode()->listvalue . "  ";
    

    // Getting a pointer to a node.
    // The node number is passed by argument
    $node = $mylist->getNode(3);
    echo " you have been looking for node number   $node->nodeNum  ";
    
    
    // Allocating n nodes in one go 
    $arr = array("red","blue","yellow","white");
    $mylist->allocateNode(sizeof($arr),$arr);


    // Searching for a value
    echo " item red found in node number  " . $mylist->findFirstLinear("red")  . "   " ;

    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  <";
    
    // Reducing the list to 10 nodes
    echo " the list is now reduced to 10 nodes  ";
    $mylist->cutList(10);
   
    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  <";
    
    // Printing the list values
    $mylist->listList();
   
 
    // Allocating n nodes in one go
    echo "  adding 4 new nodes to the list  ";
    $arr = array(356,7689,0,1);
    $mylist->allocateNode(sizeof($arr),$arr);
    
    $mylist->listList();
    
    // Swapping two nodes. Node numbers are passed by
    // argument
    echo "  swapping nodes * 10 - 13 * ";
    $mylist->swapNodes(10,13);
    
    $mylist->listList();
    
    
    //  Deleting node 11
    echo "  deleting node 11  ";
    $mylist->deleteNode(11);

    $mylist->listList();
    
    // Sorting the list in descending order
    echo "  sorting the list in  desc ";
    $mylist->ListSortDesc();
  
    $mylist->listList();
     
     
     
    // Callback function called before node insertion
    function beforen($item)
    { 
        return true;
    } 
    
    // Callback function called after node insertion
    function aftern($item)
    {
        return true;
    }
    
    
Very straightforward to use and extend. Implement a new class Stack passing by argument the callback functions to be invoked before and after pushing or popping, otherwise null,null.The callbacks will receive the node number to be pushed, a pointer to the node just pushed. If popping the node number to be popped, the popped node. Follow various methods example as reported below.

    
    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  <";

    // A new stack. Passing callbacks functions to the constructor
    $mystack = new Stack("beforen","aftern");
   
   
    // insert 20 nodes containing random values
    for($x = 0; $x< 20; $x++)
             $mystack->push(mt_rand());
 
 
    // Print the total number of nodes in the stacj
    echo "  total nodes " .  $mystack->getTop()->nodeNum; 
  

    // Print bottom value
    echo "  bottom value " .  $mystack->getBottom()->stackvalue . "  ";
   
    
    // Print top value
    echo "  top value " .  $mystack->getTop()->stackvalue . "  ";
    

    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  <";
 
 
    echo " printing the whole stack " . $mystack->listStack();

    // Pushing n nodes in one go
    echo "   4 new nodes to the stack  ";
    $arr = array(356,7689,0,1);
    $mystack->multiPush(sizeof($arr),$arr);


    echo " printing the whole stack " . $mystack->listStack();

    echo " popping three elements " ;
    
    $poppedelements = array();
    
    $poppedelements[] = $mystack->pop();
    $poppedelements[] = $mystack->pop();
    $poppedelements[] = $mystack->pop(); 

    echo " printing the whole stack " . $mystack->listStack();
    
    for($x = 1; $x <= count($poppedelements); $x++ )
        echo " popped element " . $x . "  " . $poppedelements[$x]->stackvalue; 


    // Getting the stack number of nodes
    $totn = $mystack->getTotStackNode();
    
    $poppedelements1 = array();
    
    for($x = 0; $x <= $totn; $x++ )
        $poppedelements1[] = $mystack->pop();
    
    echo " the stack has now  " . $mystack->getTotStackNode() . "  nodes ";
    
    echo " printing the whole stack " . $mystack->listStack();
    
    // Pushing n nodes in one go
    echo "  8 new nodes to the stack  ";
    $arr = array(1,2,3,4,5,6,7,8);
    $mystack->multiPush(sizeof($arr),$arr);
    
    echo " iterating the stack ";

    $startAtNode = 1;
    
    // Iterating and traversing the stack
    $mystack->iteratorStack(function($node)
        {
            // Anonymous function called at each iteration
            // Receiving the node currently traversed
            echo " node n. " . $node->nodeNum;
            
            return true;
            
        },$startAtNode);
        

    gc_collect_cycles();
  

    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  <";
    
    
    // Callback function called before node insertion
    function beforen($item)
    { 
        return true;
    } 
    
    // Callback function called after node insertion
    function aftern($item)
    {
        return true;
    }
    
