# github

Very straightforward to use and extend.
Implement a new class LinkedList passing by argument the callback functions to be invoked before and after nodes insertion, otherwise null,null.The callbacks will receive the node number to be inserted, a pointer to the node just inserted. Follow various methods examples.


Callback function called before node insertion
function beforen($item)
{ 
    return true;
} 
    
Callback function called after node insertion
function aftern($item)
{
    return true;
} 


    // A new linked List
    $mylist = new LinkedList("beforen","aftern");
   
   
    
    for($x = 0; $x< 40000; $x++)
    {    
             // insert 40000 nodes containing random values
             $mylist->insertNode(mt_rand());
             
    
    }
  
    // Print the total number of nodes in the list
    echo "  total nodes " .  $mylist->getlastNode()->nodeNum; 
  

    // Print first node value
    echo "  first node node value " .  $mylist->getfirstNode()->listvalue . "  ";
   
    
    // Print last node value
    echo "  last node value " .  $mylist->getlastNode()->listvalue . "  ";
    
    
    // Sorting the list in ascending order
    echo "  sorting the list in  asc ";
    $mylist->ListSortAsc();
 
    // Getting a pointer to a node.
    // The node number is passed by argument
    $node = $mylist->getNode(3);
    echo " you have been looking for node number   $node->nodeNum  ";
    
    
    // Allocating n nodes in one go 
    $arr = array("red","blue","yellow","white");
    $mylist->allocateNode(sizeof($arr),$arr);


    // Searching for a value
    echo " item red found in node number  " . $mylist->findFirstLinear("red")  . "   " ;


    // Reduce the list to 10 nodes
    echo " the list is now reduced to 10 nodes  ";
    $mylist->cutList(10);
   
    // Print the whole list values
    $mylist->listList();
   
 
    // Allocating n nodes in one go
    echo "  adding 4 new nodes to the list  ";
    $arr = array(356,7689,0,1);
    $mylist->allocateNode(sizeof($arr),$arr);
    
    $mylist->listList();
    
    // Swapping two nodes. Node numbers are passed by
    // argument
    echo "  swapping nodes  ";
    $mylist->swapNodes(10,13);
    
    
    // Sorting the list in descending order
    echo "  sorting the list in  desc ";
    $mylist->ListSortDesc();
  
    $mylist->listList();
