# github

Very straightforward to use and extend.
Implement a new class LinkedList passing by argument the callback functions to be invoked before and after nodes insertion, otherwise null,null.The callbacks will receive the node number to be inserted, a pointer to the node just inserted. Follow various methods examples.




    // A new linked List. Passing callbacks functions to the constructor
    $mylist = new LinkedList("beforen","aftern");
   
   
    // insert 2 millions nodes containing random values
    for($x = 0; $x< 2000000; $x++)
             $mylist->insertNode(mt_rand());
  
    // Printing the total number of nodes in the list
    echo "  total nodes " .  $mylist->getlastNode()->nodeNum; 
  

    // Printinb first node value
    echo "  first node node value " .  $mylist->getfirstNode()->listvalue . "  ";
   
    
    // Printinb last node value
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


 
