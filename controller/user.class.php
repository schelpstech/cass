<?php

class User
{
    // Refer to database connection
    private $db;

    // Instantiate object with database connection
    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }


  public function recordLog($object, $activity, $description)
    {
        try {
            // Define query to insert values into the users table
            $sql = "INSERT INTO log (user_name, uip, object, activity, description) VALUES(:user, :userip, :object, :activity, :description)";

            // Prepare the statement
            $query = $this->db->prepare($sql);

            $user = (isset($_SESSION['activeAdmin'])) ? $_SESSION['activeAdmin'] : $_SESSION['active'];
            // Bind parameters
            $query->bindParam(":user", $user);
            $query->bindParam(":userip", $_SERVER['REMOTE_ADDR']);
            $query->bindParam(":object", $object);
            $query->bindParam(":activity", $activity);
            $query->bindParam(":description", $description);

            // Execute the query
            $query->execute();
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

  

    
}
