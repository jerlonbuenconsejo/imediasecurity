<?php 
	class Database{
		public $isConn;
		protected $datab;

		//connec to db
		public function __construct($username = "root", $password = "", $host = "localhost", $dbname = "db_imedia", $options = []){			
			session_start();
			$this->isConn = TRUE;		
			try{
				$this->datab = new PDO("mysql:host={$host};dbname=$dbname; charset=utf8", $username, $password, $options);
				$this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			}catch(PDOException $e){
				throw new Exception($e->getMessage());

			}
		}
		//get row
		public function getRow($query, $params = []){
			try {
				$stmnt = $this->datab->prepare($query);
				$stmnt->execute($params);
				return $stmnt->fetch();
			} catch (PDOException $e) {
				throw new Exception($e->getMessage());
				//echo "No such ID"; 
			}
		}

		//get rows
		public function getRows($query, $params= []){
			try {
				$stmnt	=	$this->datab->prepare($query);
				$stmnt->execute($params);
				return $stmnt->fetchAll();
			} catch (PDOException $e) {
				throw new Exception($e->getMessage());
			}
		}

		//insert row
		public function insertRow($query, $params= []){
			try {
				$stmnt = $this->datab->prepare($query);
				$stmnt->execute($params);
				return TRUE;
			} catch (PDOException $e) {
				throw new Exception($e->getMessage());
			}

		}

		public function login($username,$password)
		 {
		    try
		    {
		          $stmt = $this->datab->prepare("SELECT * FROM account WHERE username=:uname  LIMIT 1");
		          $stmt->execute(array(':uname'=>$username));
		          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		          if($stmt->rowCount() > 0)
		          {
		             if($password==$userRow['password'])
		             {
		                $_SESSION['user_session'] = $userRow['username'];
		                return true;
		             }
		             else
		             {
		                return false;
		             }
		          }
		    }
		       catch(PDOException $e)
		       {
		           echo $e->getMessage();
		       }
		 }		 
		public function is_loggedin()
		{
		      if(isset($_SESSION['user_session']))
		      {
		         return true;
		      }
		}
		public function redirect($url){
			echo "<script>
				window.location.href = '$url';
				</script>";		
		}
		public function logout()
		{
		        session_destroy();
		        unset($_SESSION['user_session']);
		        return true;
		}
				//disconnect from db
		public function Disconnect(){
			$this->datab = NULL;
			$this->isConn = FALSE;
		}

		//update row
		public function updateRow($query, $params= []){
			$this->insertRow($query, $params);

		}

		//delete row
		public function deleteRow($query, $params= []){
			$this->insertRow($query, $params);

		}

		public function getParent($parent){
			$parent = 	$this->getRow("SELECT catName from categories WHERE catID = ".$parent."");
			if($parent=="0"){
				return "";
			} else{
				return $parent->catName;
			}
		}

	}
 ?>