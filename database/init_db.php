<?php

/** 
 *  The class MinishopDBMS implements functionality for onlineshop database actions 
 *  This version implements the creating, editing and organizing of articles. Usermanagement may be added it future versions
 * 
 *  @author Benjamin Kuermayr
 *  @version 2020-04-22
 */
class fileSharing
{
    public $db;

    /**
     * establishes db connection
     */
    public function setup($host, $dbname, $user, $password)
    {
        //connection string
        $dcs = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        $options = array(
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try {
            //connect to db
            $this->db = new PDO($dcs, $user, $password, $options);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }




    public function login($username, $password)
    {
        // Hash the password before comparing it with the stored hash in the database
        $hashedPassword = hash('sha256', $password);

        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php?page=dashboard");
                exit();
                return;
            } else {
                return '<div class="alert alert-danger dark alert-dismissible fade show" role="alert"><strong>Login Failed ! </strong><p> Wrong Username </p></div>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function get_info($hash_id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM uploaded_files WHERE hash_id = :hash_id");
            $stmt->bindParam(':hash_id', $hash_id);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                return ["status" => true, "data" => $data];
            } else {
                return ["status" => false, "data" => "file not found"];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function file_upload($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO uploaded_files (user_id, name, hash_id, description, private, password, size) VALUES (:user_id, :name, :hash_id, :description, :private, :password, :size)");
            $stmt->bindParam(':user_id', $data['user_id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':hash_id', $data['hash_id']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':private', $data['private']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':size', $data['size']);
            $stmt->execute();
            return ["status" => true, "msg" => "File Uploaded!"];
        } catch (PDOException $e) {
            return ["status" => false, "msg" => $e->getMessage()];
        }
    }

    public function uploaded_files($user_id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM uploaded_files WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                return ["status" => true, "data" => $data];
            } else {
                return ["status" => false, "data" => "data not found"];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // public function uploadFile($M) {
    //     try {
    //         $stmt = $thos->prepare("INSERT INTO your_table (name, email) VALUES (:name, :email)");
    //         $stmt->bindParam(':name', $name);
    //         $stmt->bindParam(':email', $email);

    //         $stmt->execute();
    //         echo 'Data inserted successfully';
    //     } catch (PDOException $e) {
    //         echo 'Error: ' . $e->getMessage();
    //     }
    // }


    public function close()
    {
        $this->db = null;
    }

    public function __construct($host, $dbname, $user, $password)
    {
        $this->setup($host, $dbname, $user, $password);
    }
}
