# Linked-list

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
    
    
# Stack
Very straightforward to use and extend. Implement a new class Stack passing by argument the callback functions to be invoked before and after pushing or popping, otherwise null,null.The callbacks will receive the node number to be pushed, a pointer to the node just pushed. If popping the node number to be popped, the popped node. Follow various methods example as reported below.

    
    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  < ";

    // A new stack. Passing callbacks functions to the constructor
    $mystack = new Stack("beforen","aftern");
   
   
    // insert 20 nodes containing random values
    for($x = 0; $x< 20; $x++)
             $mystack->push(mt_rand());
 
 
    // Print the total number of nodes in the stacj
    echo "<br><br>   total nodes " .  $mystack->getTop()->nodeNum; 
  

    // Print bottom value
    echo "<br><br>   bottom value " .  $mystack->getBottom()->stackvalue . "  ";
   
    
    // Print top value
    echo "<br><br>  top value " .  $mystack->getTop()->stackvalue . "  ";
    

    echo "<br><br> >  memory usage  <" . memory_get_usage() .  ">  bytes  < <br><br>";
 
 
    echo "<br><br>  printing the whole stack <br><br>" . $mystack->listStack();


    // Pushing n nodes in one go
    echo "<br><br>   adding 4 new nodes to the list  <br><br> ";
    $arr = array(356,7689,0,1);
    $mystack->multiPush(sizeof($arr),$arr);


    echo "<br><br>  printing the whole stack <br><br>" . $mystack->listStack();

    echo "<br><br>  popping three elements <br><br> " ;
    
    $poppedelements = array();
    
    $poppedelements[] = $mystack->pop();
    $poppedelements[] = $mystack->pop();
    $poppedelements[] = $mystack->pop(); 

    echo "<br><br>  printing the whole stack " . $mystack->listStack();
    
    for($x = 1; $x <= count($poppedelements); $x++ )
        echo "<br><br>  popped element " . $x . "  " . $poppedelements[$x-1]->stackvalue; 

    // Getting the stack number of nodes
    $totn = $mystack->getTotStackNode();
    
    $poppedelements1 = array();
    
    for($x = 0; $x <= $totn; $x++ )
        $poppedelements1[] = $mystack->pop();
    
    echo "<br><br>  the stack has now  " . $mystack->getTotStackNode() . "  nodes <br><br>";
    
    echo "<br><br>  printing the whole stack <br><br>" . $mystack->listStack();
    
    // Pushing n nodes in one go
    echo "<br><br>   adding 8 new nodes to the list  ";
    $arr = array(1,2,3,4,5,6,7,8);
    $mystack->multiPush(sizeof($arr),$arr);
    
    echo "<br><br>  iterating the stack ";

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
 
    echo "<br><br>  >  memory usage  <" . memory_get_usage() .  ">  bytes  <";
    
    // popping all node
    echo "<br><br>  the stack has now  " . $nodecount = $mystack->getTotStackNode() . "  nodes <br><br>";
    
    echo "<br><br>  popping all nodes  from the stack ";
    for($x = 0; $x < $nodecount; $x++ )
    {
        $mystack->pop();
        echo "<br> node  popped "; 
    }
    gc_collect_cycles();
 
    echo "<br><br>  >  memory usage  <" . memory_get_usage(false) .  ">  bytes  <";p
    
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
  
   
# Stack double linked
Very straightforward to use and extend. Implement a new class StackDoubleLinked passing the key by argument to the constructor. The class StackDoubleLinked extends the class Stack. Follow various methods example as reported below.
  
    
    // instantiate a double linked stack
    echo "<br><br><br> a new double linked stack ";
    echo "<br><br> >  memory usage  <" . memory_get_usage(false) .  ">  bytes  <";

    // A new stack. Passing key to the constructor
    $mydoublestack = new StackDoubleLinked("Double_Linked_Stack");
   
   
    // insert 20 nodes containing random values
    for($x = 0; $x< 200; $x++)
             $mydoublestack->push(mt_rand());
 
 
    // Print the total number of nodes in the stacj
    echo "<br><br>   total nodes " .  $mydoublestack->getTop()->nodeNum; 
  

    // Print bottom value
    echo "<br><br>   bottom value " .  $mydoublestack->getBottom()->stackvalue . "  ";
   
    
    // Print top value
    echo "<br><br>   top value " .  $mydoublestack->getTop()->stackvalue . "  ";
    
    gc_collect_cycles();
    
    echo "<br><br> >  memory usage  <" . memory_get_usage(false) .  ">  bytes  <";
    
    echo "<br><br> the stack key is : " . $mydoublestack->getStackKey();

    echo "<br><br>  iterating the stack from node 20 to 15 ";
    // Iterating and traversing the stack from node to node 
    // and changing the values to 0
    $mydoublestack->iteratorStackNode(function(&$node)
        {
            static $nodenumber = 0;
            
            // Anonymous function called at each iteration
            // Receiving the node currently traversed
            echo   "<br>" . " node n. " . $node->nodeNum . " contains value " . $node->stackvalue;
            
            $node->stackvalue = 0;
            
            return ($nodenumber++ < 5) ? true : false;
            
        },$mydoublestack->getNode(20),"-");
        
        
        
    $mydoublestack->iteratorStackNode(function(&$node)
        {
            static $nodenumber = 0;
            
            // Anonymous function called at each iteration
            // Receiving the node currently traversed
            echo   "<br>" . " node n. " . $node->nodeNum . " now contains value " . $node->stackvalue;
            
            return ($nodenumber++ < 5) ? true : false;
            
        },$mydoublestack->getNode(20),"-");
        

    gc_collect_cycles();
 
    echo "<br><br>  >  memory usage  <" . memory_get_usage() .  ">  bytes  <";
    
  
  
  
# Linked-list Obj

Very straightforward to use and extend.
Instantiate a new class LinkedListObj passing by argument a key for this new list.  Each list node can handle a child which is fundamentally a pointer to an object the class should manage. Children can also be put in a stack for further manipulation. The class LinkedListObj includes a method for stacking through the class Stack documented in stack.php. Follow various methods examples.

  
        // An example of object passed by argument
    class mychild
    {
        public $myvalue;
    
        public function __construct($val) 
        {     
            $this->myvalue = $val;
    
        }
    
    }
    
    
    // Very straightforward to use and extend.
    // Implementing a new class LinkedListObj.
    
    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  <";

    // A new linked List. Passing the key to the constructor
    $mylist1 = new LinkedListObj("a list key");
   
    
    for($x = 0; $x< 20; $x++)
             $mylist1->insertNode((string) mt_rand());
  
    // Print the total number of nodes in the list
    echo "  total nodes " .  $mylist1->getlastNode()->nodeNum . "<br><br>";
  

    // Print first node value
    echo "  first node key " .  $mylist1->getfirstNode()->nodeKey .  "<br><br>";
   
    
    // Print last node value
    echo "  last node key " .  $mylist1->getlastNode()->nodeKey . "<br><br>";
    
    
    echo ">  memory usage  <" . memory_get_usage() .  ">  bytes  <";
 
    
    // Printing the list values
    $mylist1->listList();
    
    echo "<br><br>";

    $node = $mylist1->getNode(23);

    echo $node->nodeKey . " is the key of node 23 <br><br>";


    $node = $mylist1->getNodeOffset(2,$mylist1->getNode($mylist1->getTotListNode()),"-");
    
    echo " offset 2 from the end list is node " . $node->nodeNum . "<br><br>";
    
    echo "deleting node 15 <br><br> ";
    $node = $mylist1->deleteNode(15);
    
    // Printing the list values
    $mylist1->listList();
    
    $node = $mylist1->getNode(5);
    echo  "<br><br> pervious node of node(5) is " . $node->prevNode->nodeNum . "<br><br>";
  
    
    // Printing the list values
    $mylist1->listList();
    
    echo "<br><br> iterating through the list in reverse order and printing the node numbers <br><br>";
    
   
    $mylist1->iteratorList(function($node)
            {
                static $nodenum = 1;
                
                echo " iterating node " . $node->nodeNum . "<br>";
                
                return true;
                
            },$mylist1->getTotListNode(),"-");
       
      
    
    
    
    // sort the list ascending order
    $mylist1->ListSortAsc();
 
     // Printing the list values
    echo "<br><br> list sorted ascending order ";
    $mylist1->listList();
    
    
    
    $mychild = new mychild(" child node");
    echo "<br><br> inserting a child at node 10 <br><br>";
    
    $mylist1->insertChild(10,$mychild);
    
    $node = $mylist1->getNode(10);
    echo "child at node 10 contains > " . $node->child->myvalue . "<br><br>";
    
    
    
    $node = $mylist1->getNode(16);
    echo " node 16 has key " . $node->nodeKey   . "<br><br>";
    
    $node = $mylist1->findFirstNodeSortedAscLinear($node->nodeKey);
 
    if($node !== null)
        echo  "The node with key" .  $node->nodeKey . " is node number  " . $node->nodeNum . " <br><br> ";
    
    $key = mt_rand();
    
    // generate random key
    echo "generating a random key " . $key . " <br><br> ";
    

    $node = $mylist1->findNearestNodeSortedLinear($key);
    
    
    if($node !== null)
        echo  "The nearest node to key " .  $key . " is node number  " . $node->nodeNum . " <br><br> ";
    
    echo  "Stacking child nodes <br><br>";
    // children in a stack. The method stackChildren() should receive by argument
    // the list LinkedListObj containing the nodes with children to stack.
    $stack = $mylist1->stackChildren($mylist1);
    
    echo " there are " . $stack->getTotStackNode() . " children nodes in the stack from list " .  " <br><br> ";


    // resetting the list key
    $key = mt_rand();
    
    $mylist1->setListKey($key); 
    echo " the list key is  " .  $mylist1->getListKey() . "<br><br>";
   

    
    $node = $mylist1->getNode(10);
    echo "before removal child at node 10 contains > " . $node->child->myvalue . "<br><br>";
    


    // removing child from node number 10
    $mylist1->removeChild($mylist1->getNode(10)); 
  
  
    
    $node = $mylist1->getNode(10);
    echo "after removal child at node 10 contains >  " . $node->child->myvalue . "<br><br>";
    
    
    
    // inserting new children
    echo "<br>inserting new children " .  " <br><br> ";
    for($x = 1;$x <= $mylist1->getTotListNode(); $x++ )
    {
        $mychild = new mychild("child of node" . $x);
        echo "<br>new child at node " . $x;
        $mylist1->insertChild($x,$mychild);
    
    }
    echo  " <br><br> ";
  
  
  
    // iterating the list in reverse and printing children contents 
    $mylist1->iteratorList(function($node)
            {
                static $nodenum = 1;
                
                echo " iterating node " . $node->nodeNum . "<br>";
                echo " child node contains: " . $node->child->myvalue . "<br>";
                
                return true;
                
            },$mylist1->getTotListNode(),"-");
      

    echo  " <br><br> ";
  
  
   
    // creating reverse children stack. The method stackChildren() should receive by argument
    // the list LinkedListObj containing the nodes with children to stack, a callback function
    // if any called for each child pushing and the mode "-" to indicate the method the 
    // stacking order.
    $reversestack = $mylist1->stackChildren($mylist1,function($node)
                            {
                                echo "callback called to stack child node " . $node->nodeNum . "<br>";
                                 return true;
                                
                            },"-");

    echo "<br><br> there are " . $reversestack->getTotStackNode() . " children nodes in a reverse children stack <br><br> ";
    
    $mylist1->ListSortDesc();
  
  
    
    // A new linked List. Passing the key to the constructor.
    // Insertion of nodes causes the sorting of the list in descending
    // order.
    $mylist2 = new LinkedListObj("a second list key");

    $mylist2->insertNodeNearestOfSortedDesc("378912578");

    $mylist2->insertNodeNearestOfSortedDesc("378912577");

    $mylist2->insertNodeNearestOfSortedDesc("378912574");

    $mylist2->insertNodeNearestOfSortedDesc("378912579");

    $mylist2->insertNodeNearestOfSortedDesc("378912575");

    $mylist2->insertNodeNearestOfSortedDesc("378912574");

    $mylist2->insertNodeNearestOfSortedDesc("378912580");
     
     
    echo  "<br><br>" . $mylist2->listList(); 
