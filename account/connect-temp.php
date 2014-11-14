<?php
//---abstracted ! ------
class connection{
    public $host ="localhost";
    public $user = "root"; 
    public $password = "a58105810";
    public $db="elder";
    public $dbc;
    
    function __construct() {
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->db);
        
        if(mysqli_errno($con)){
            echo"sum error";
            
        }
        else{
           $this->dbc = $con; // assign $con to $dbc
           echo"connected ";
        }
    }
}


?>
