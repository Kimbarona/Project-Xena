<!-- *********THIS IS FOR THE DB CONNECTION (new file)**** -->
<?php
class Database
{
    private $host = "localhost";
    private $db_name = "db_engineering";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection()
	{

	    $this->conn = null;
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>


<!-- ********THIS IS FOR THE POSTING TO CLASS *****(postingtoclass.php) -->

<?php
require_once("class.php");
$AddNew = new AddNew();

    $var1 = $_POST['var1'];
    $var2 = $_POST['var2'];



// eror trapping dito

    if($AddNew->InputNew($var1, $var2)){

    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>ok!</strong> Successfully saved!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="fa fa-times"></span>
        </button>
    </div>
    <?php

   }


   else{
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>opps!</strong> Error input.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
    </div>
    <?php
   }

?>


<!-- // ********* THIS IS FOR THE CLASS (class.php) ***** -->

<?php

require_once('../database/db.php');

class AddNew
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

    public function InputNew($var1, $var2){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  tb_name (col1, col2)
            VALUES(:var1, :var2)");

                        $stmt->bindparam(":var1",$var1);
                        $stmt->bindparam(":var2",$var2);


            $stmt->execute();

			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}


}


?>

