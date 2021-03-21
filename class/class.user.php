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
                    $_SESSION['SESS_USER_DB_LOGINKEY'] = $MemberProfile['login_key'];
                    
                    $_SESSION['SES_USER_ROLL'] = 'ADMIN';
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

    // Product_Create
    public function Product_Create($product, $unit_price, $location){

        try {
            // return $product;
            if(empty($product)){
				$result['result']="failed";
				$result['reason']="product name required";
				return $result;	
				exit;
			}

            if(empty($unit_price)){
				$result['result']="failed";
				$result['reason']="unit price required";
				return $result;	
				exit;
			}
            if(empty($location)){
				$result['result']="failed";
				$result['reason']="location required";
				return $result;	
				exit;
			}

            
			$sqlA = 'INSERT INTO product (name, unit_price, location) 
                                    VALUES (:product, :unit_price, :location)';
			$qA = $this->db->prepare($sqlA);
			$qA->execute(array(':product'=>$product,
							   ':unit_price'=>$unit_price,   
							   ':location'=>$location
							   ));	
			
            $result['status']="success";
            $result['result']="OK";
            $result['reason']="new product created successfully";
            
            
            return $result;	
            exit;

        }
        catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

    // All_Products
    public function All_Products(){
        try {
            $stmt = $this->db->prepare("SELECT product.id, product.name as product, product.unit_price, location.id as location_id, location.name as location_name FROM product LEFT JOIN location 
                                    ON product.location= location.id ORDER BY product.id;");
            $stmt->execute(array());
            $result =$stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        catch(PDOException $e)
		{
			echo $e->getMessage();
		}
        
    }

    // customer user
    public function Customer_Register($name, $number, $email,$location ,$password){
        try {
            if(empty($name)){
				$result['result']="failed";
				$result['reason']="name required";
				return $result;	
				exit;
			}
            if(empty($number)){
				$result['result']="failed";
				$result['reason']="number required";
				return $result;	
				exit;
			}
            if(empty($email)){
				$result['result']="failed";
				$result['reason']="email required";
				return $result;	
				exit;
			}
            if(empty($location)){
				$result['result']="failed";
				$result['reason']="location required";
				return $result;	
				exit;
			}
            if(empty($password)){
				$result['result']="failed";
				$result['reason']="location required";
				return $result;	
				exit;
			}

            $query = 'SELECT count(*) FROM user WHERE email=:email LIMIT 1';
			$stmt=$this->db->prepare($query);
			$stmt->execute(array(':email'=>$email));
			$Validation_Email_Address=$stmt->fetchColumn();
			if($Validation_Email_Address>='1')
			{
				$result['cus_name']="$name";
				$result['cus_email']="$email";
				$result['cus_number']="$number";
				$result['cus_location']="$location";
				$result['result']="failed";
				$result['reason']="email address already registered";
				return $result;	
				exit;
			}
            $login_secure_key = $this->rand_string_login_key(90);
            $System_New_Password = password_hash($password, PASSWORD_DEFAULT);
			
			$sqlA = 'INSERT INTO user (name, number, email, password, login_key, location) 
                                VALUES (:name, :number, :email, :password, :login_key, :location)';
			$qA = $this->db->prepare($sqlA);
			$qA->execute(array(':name'=>$name,
							   ':number'=>$number,   
							   ':email'=>$email,
							   ':password'=>$System_New_Password,
							   ':login_key'=>$login_secure_key,
							   ':location'=>$location
							   ));	
			
			$stmt = $this->db->prepare("SELECT * FROM user WHERE email=:email LIMIT 1");
			$stmt->execute(array(':email'=>$email));
			$New_User_Profile=$stmt->fetch(PDO::FETCH_ASSOC);

			$result['new_user_data']=$New_User_Profile;

            $_SESSION['SES_USER_id'] = $New_User_Profile['id'];
            $_SESSION['SES_USER_NAME'] = $New_User_Profile['name'];
            $_SESSION['SES_USER_EMAIL'] = $New_User_Profile['email'];
            $_SESSION['SES_USER_NUMBER'] = $New_User_Profile['number'];
            $_SESSION['SES_USER_LOCATION'] = $New_User_Profile['location'];
            $_SESSION['SESS_USER_DB_LOGINKEY'] = $New_User_Profile['login_key'];

            $_SESSION['SES_USER_ROLL'] = 'customer';
            $_SESSION['SESS_USER_LOGINKEY'] = $login_secure_key;
                
            $result['result']="ok";
            $result['status']="success";
            // return $result;	
            return header('Location: index.php?status=Registration successful');
            exit;

        }
        catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

    // Customer_Login
    public function Customer_Login($email, $password){
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE email=:email LIMIT 1");
            $stmt->execute(array(':email'=>$email));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    
            if($stmt->rowCount() > 0){
                if(password_verify($password, $userRow['password'])){
                    $login_secure_key = $this->rand_string_login_key(90);
    
                    $query = "UPDATE user SET login_key=:login_key WHERE id=:id";	
                    $stmt = $this->db->prepare($query);
                    $stmt->execute(array(':login_key'=>$login_secure_key, ':id' =>$userRow['id']));
    
                    $stmt = $this->db->prepare("SELECT * FROM user WHERE id=:id ORDER BY id ASC LIMIT 1");
                    $stmt->execute(array(':id'=>$userRow['id']));
                    $MemberProfile=$stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $_SESSION['SES_USER_id'] = $userRow['id'];
                    $_SESSION['SES_USER_NAME'] = $userRow['name'];
                    $_SESSION['SES_USER_EMAIL'] = $userRow['email'];
                    $_SESSION['SES_USER_NUMBER'] = $userRow['number'];
                    $_SESSION['SES_USER_LOCATION'] = $userRow['location'];
                    $_SESSION['SESS_USER_DB_LOGINKEY'] = $MemberProfile['login_key'];

                    $_SESSION['SES_USER_ROLL'] = 'customer';
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

    // Order_Create
    public function Order_Create($product_id){
        try {
			$stmt = $this->db->prepare("SELECT * FROM product WHERE id=:product_id LIMIT 1");
			$stmt->execute(array(':product_id'=>$product_id));
			$product_data=$stmt->fetch(PDO::FETCH_ASSOC);
            
            $customer_location = $_SESSION['SES_USER_LOCATION'];
            $customer_id = $_SESSION['SES_USER_id'];
            $customer_location = $_SESSION['SES_USER_LOCATION'];

            $product_location = $product_data['location'];
            $product_id = $product_data['id'];
            $product_u_price = $product_data['unit_price'];

            $order_id = $this->rand_string_login_key(8);

            $d_price = 0;
            $pay_amount = 0;
            $unit_count = 1;
            if ($customer_location == $product_location) {
                $d_price = ($product_u_price - ($product_u_price /100)*25);
                $pay_amount = $d_price * $unit_count;
            }else{
                $pay_amount = $product_u_price;
            }

            
            $sqlA = 'INSERT INTO orders (order_id,customer_id, product_id, unit_count, discount_unit_price, unit_price, pay_amount) 
                                VALUES ( :order_id,:customer_id, :product_id, :unit_count, :discount_unit_price, :unit_price, :pay_amount)';
			$qA = $this->db->prepare($sqlA);
			$qA->execute(array(':order_id'=>$order_id,
							   ':customer_id'=>$customer_id,   
							   ':product_id'=>$product_id,
							   ':unit_count'=> $unit_count,
							   ':discount_unit_price'=>$d_price,
							   ':unit_price'=>$product_u_price,
							   ':pay_amount'=>$pay_amount
							   ));	
			
            $result['result']="ok";
            $result['status']="success";
            $result['massage']="Order successful";

            return $result;	
            exit;
            // return $product_data;

        }catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

    public function All_Order(){

        try {
            
            $stmt = $this->db->prepare("SELECT o.*, c.name as cus_name, c.email as cus_email, c.number,  pro.id as pro_id, pro.name as pro_name 
                                            FROM orders o 
                                            LEFT JOIN user c ON o.customer_id = c.id 
                                            LEFT JOIN product pro ON o.product_id = pro.id 
                                            ORDER BY o.id desc
                                        ");
            $stmt->execute(array());
            $result =$stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

    // Status_Update
    public function Status_Update($status_id, $order_id){
        try {
             $result['status'] = $status_id;
             $result['order_id'] = $order_id;
            // return $result;
            
            $query = "UPDATE orders SET status=:status_id WHERE id=:order_id";	
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute(array(':status_id'=>$status_id, ':order_id' =>$order_id));

            return header('Location: order-list.php?status=successful');
            exit;
            
        }
        catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

    public function Count_Order_Product($product_id, $status){
        try {
            $stmt = $this->db->prepare("SELECT SUM(unit_count) as pro_count FROM `orders` WHERE (status=:status and product_id=:product)
            ");
            $stmt->execute(array(':status'=>$status, ':product' =>$product_id));
            $result =$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;

        } catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
}