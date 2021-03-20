<?php
// include_once "../includes/db_connect.php";

class USER
{
	private $db;
	
	function __construct($conn)
	{
		$this->db = $conn;
	}
	public function runQuery($sql)
	{
		$stmt = $this->db->prepare($sql);
		return $stmt;
	}
	public function lasdID()
	{
		$stmt = $this->db->lastInsertId();
		return $stmt;
	}

    private function rand_string_login_key( $length ) 
	{
		$str = NULL;
		$chars = "123456789QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuioplkjhgfdsazxcvbnm";	
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}
    public function locations(){
        $stmt = $this->db->prepare("SELECT * FROM location");
        $stmt->execute(array());
        $local =$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $local;
    }

    public function login($email, $password){
        // return $email;
        try {
            $stmt = $this->db->prepare("SELECT * FROM admin_user WHERE email=:email LIMIT 1");
            $stmt->execute(array(':email'=>$email));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    
            if($stmt->rowCount() > 0){
                if(password_verify($password, $userRow['password'])){
                    $login_secure_key = $this->rand_string_login_key(90);
    
                    $query = "UPDATE admin_user SET login_key=:login_key WHERE id=:id";	
                    $stmt = $this->db->prepare($query);
                    $stmt->execute(array(':login_key'=>$login_secure_key, ':id' =>$userRow['id']));
    
                    $stmt = $this->db->prepare("SELECT * FROM admin_user WHERE id=:id ORDER BY id ASC LIMIT 1");
                    $stmt->execute(array(':id'=>$userRow['id']));
                    $MemberProfile=$stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $_SESSION['SES_USER_id'] = $userRow['id'];
                    $_SESSION['SES_USER_NAME'] = $userRow['name'];
                    $_SESSION['SES_USER_EMAIL'] = $userRow['email'];
                    $_SESSION['SES_USER_NUMBER'] = $userRow['number'];
                    $_SESSION['SESS_USER_DB_LOGINKEY'] = $userRow['login_key'];
    
                    $_SESSION['SESS_USER_LOGINKEY'] = $login_secure_key;
                        
                    $result['result']="ok";
                    $result['status']="success";
                    return $result;	
                    exit;
                    return true;
                    
                }else{
                    return false;
                }
            }else{
                return 'not found';
            }
        }catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

    //Logout	
	public function logout()
	{
		session_destroy();
		unset($_SESSION['SESS_MEMBER_ID']);
		return true;
	}
}