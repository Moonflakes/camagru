<?php
class Commentator{

    //declare all intermal  (private) variables, only accessible within this class
    private $_conn;
    private $_query;
    private $_total;

    //constructor method is called autmaticall when object is instantiated with new keyword
    public function __construct($conn, $query)
    {
        //$this-> variables bocome available anywhere within THIS class
        $this->_conn = $conn; //mysql connection resource
        $this->_query = $query; //mysql query string

        $rs = $this->_conn->prepare($this->_query);
        $rs->execute();
        $this->_total = $rs->rowCount(); // total number of row

    }

    // pour set les commentaires
    public function getData() // set default argument values
    {
        $query = $this->_query." ORDER BY `comment_date` DESC";

        $rs = $this->_conn->prepare($query);
        $rs->execute();

        $i = 0;
        include_once 'check_user.php';
        while ($row = $rs->fetch(PDO::FETCH_ASSOC))
        {
            //store this arry in $result=>data below
            $results['comment_'.++$i] = $row;

            $requid = "SELECT * FROM `users` WHERE `user_id`=?";
            $req = $this->_conn->prepare($requid);
            $req->execute(array($results['comment_'.$i]['comment_author']));
            $userinfo = $req->fetch();
            $results['comment_'.$i]['comment_author'] = $userinfo['user_uid'];
        }

        //return data as object, new stdClass() creates new empty object
        $result = new stdClass();
        $result->total = $this->_total;
        $result->data = (isset($results)) ? $results : null; //$result->data = array

        return ($result);
    }
}
?>