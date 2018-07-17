<?php
class mssql {

    protected $db;
    protected $cTransID;
    protected $childTrans = array();
    protected $row = array();

    public function __construct($host, $port, $db, $user, $pwd) {

        $this->hostname = $host;
        $this->port = $port;
        $this->dbname = $db;
        $this->username = $user;
        $this->pwd = $pwd;

        $this->connect();
    }

    public function beginTransaction() {

        $cAlphanum = "AaBbCc0Dd1EeF2fG3gH4hI5iJ6jK7kLlM8mN9nOoPpQqRrSsTtUuVvWwXxYyZz";
        $this->cTransID = "T" . substr(str_shuffle($cAlphanum), 0, 7);

        array_unshift($this->childTrans, $this->cTransID);

        $stmt = $this->db->execute("BEGIN TRAN [$this->cTransID];");
        return $stmt;
    }

    public function rollBack() {

        while (count($this->childTrans) > 0) {
            $cTmp = array_shift($this->childTrans);
            $stmt = $this->db->prepare("ROLLBACK TRAN [$cTmp];");
            $stmt->execute();
        }

        return $stmt;
    }

    public function commit() {

        while (count($this->childTrans) > 0) {
            $cTmp = array_shift($this->childTrans);
            $stmt = $this->db->prepare("COMMIT TRAN [$cTmp];");
            $stmt->execute();
        }

        return $stmt;
    }

    public function close() {
        $this->db = null;
    }

    public function queryexecute($sql) {

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function selectquery($sql) 
	{
		try
		{
			$this->row = "";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();	
		}
		catch(Exception $e)
			{
				echo 'Estamos em manutenção !';
			}
    }

    public function teste($sql) {

        $stmt = $this->db->query($sql);
        //$stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        return $linha;
    }

    public function connect(){

        try {
            $this->db = new PDO ("sqlsrv:Server=$this->hostname;Database=$this->dbname;ConnectionPooling=0", "$this->username", "$this->pwd");

        } catch (PDOException $e) {
            echo "No momento estamos em manutenção!";
			
        }

    }
     
    
    /*
    public function connect() {

        try {
            $this->db = new PDO("sqlsrv:Server=$this->hostname,$this->port;Database=$this->dbname;ConnectionPooling=0", "$this->username", "$this->pwd");
        } catch (PDOException $e) {
            $this->logsys .= "Failed to get DB handle: " . $e->getMessage() . "\n";
        }
    }
*/
}
 