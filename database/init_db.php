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
                return ["status" => false, "message" => '<div class="alert alert-danger dark alert-dismissible fade show" role="alert"><strong>Login Failed ! </strong><p> Wrong Username </p></div>'];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function register($username, $password)
    {
        try {

            // Check if the username is already taken
            $checkUsernameSql = "SELECT user_id FROM users WHERE username = :username";
            $checkUsernameStmt = $this->db->prepare($checkUsernameSql);
            $checkUsernameStmt->bindParam(':username', $username);
            $checkUsernameStmt->execute();

            if ($checkUsernameStmt->rowCount() > 0) {
                return ["status" => false, "message" => '<div class="alert alert-danger dark alert-dismissible fade show" role="alert"><strong>Register Failed ! </strong><p> Username already taken </p></div>'];
            }

            // Hash the password
            $hashedPassword = hash('sha256', $password);

            // Input User Record
            $insertUserSql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $insertUserStmt = $this->db->prepare($insertUserSql);
            $insertUserStmt->bindParam(':username', $username);
            $insertUserStmt->bindParam(':password', $hashedPassword);
            $insertUserStmt->execute();

            return ["status" => true, "message" => '<div class="alert alert-success dark alert-dismissible fade show" role="alert"><strong>Register Success ! </strong><p> You can login now </p></div>'];
        } catch (PDOException $e) {
            // Handle database connection or query errors
            return ["status" => false, "message" => "Error: " . $e->getMessage()];
        }
    }

    public function get_user_info($user_id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                return ["status" => true, "data" => $data];
            } else {
                return ["status" => false, "data" => "users not found"];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    public function get_recently_uploaded_files($limit)
    {
        // Replace this with your actual database query to fetch recently uploaded files
        $sql = "SELECT * FROM uploaded_files ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mark_all($user_id, $completed)
    {

        try {
            $stmt = $this->db->prepare("UPDATE tasks SET completed = :completed WHERE user_id = :user_id");
            $stmt->bindParam(":completed", $completed, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['status' => true, 'message' => 'All tasks marked']);
        } catch (PDOException $e) {
            // Return error response
            echo json_encode(['status' => false, 'message' => 'Error marking all tasks as complete']);
        }
    }

    public function delete_task($user_id, $task_id)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("DELETE FROM tasks WHERE task_id = :task_id AND user_id = :user_id");
            $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return json_encode(['status' => true, 'message' => 'Task deleted successfully']);
        } catch (PDOException $e) {
            return json_encode(['status' => false, 'message' => 'Error deleting task']);
        }
    }

    public function new_tasks($user_id, $task)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO tasks (user_id, task, completed) VALUES (:user_id, :task, 0)");
            $stmt->bindParam(':task', $task, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $lastInsertedId = $this->db->lastInsertId();


            return json_encode(['status' => true, 'message' => 'Task added successfully', "task_id" => $lastInsertedId]);
        } catch (PDOException $e) {
            return json_encode(['status' => false, 'message' => 'Error adding task' . $e]);
        }
    }

    public function mark($user_id, $task_id, $completed)
    {
        try {
            // Prepare the SQL statement to update the completion status of the task
            $stmt = $this->db->prepare("UPDATE tasks SET completed = :completed WHERE task_id = :task_id AND user_id = :user_id");
            // Bind parameters
            $stmt->bindParam(':completed', $completed, PDO::PARAM_INT);
            $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['status' => 'success', 'message' => 'Task completion status updated successfully']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error updating task completion status']);
        }
    }

    public function get_tasks($user_id)
    {
        // Replace this with your actual database query to fetch recently uploaded files
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_info($hash_id)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT uf.*, u.username 
                FROM uploaded_files uf
                INNER JOIN users u ON uf.user_id = u.user_id
                WHERE uf.hash_id = :hash_id
            ");
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

    // File Upload Function
    public function file_upload($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO uploaded_files (user_id, name, title, hash_id, description, private, password, size) VALUES (:user_id, :name, :title, :hash_id, :description, :private, :password, :size)");
            $stmt->bindParam(':user_id', $data['user_id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':title', $data['title']);
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


    public function get_total_downloads()
    {
        try {
            $stmt = $this->db->query("SELECT SUM(downloaded) AS total_downloads FROM uploaded_files");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['total_downloads'])) {
                return $result['total_downloads'];
            } else {
                return 0; // Return 0 if no records or total_downloads is not set
            }
        } catch (PDOException $e) {
            // Handle the exception, log the error, or return false
            return $e;
        }
    }



    public function count_all_uploaded_files()
    {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) AS total_rows FROM uploaded_files");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['total_rows'])) {
                return $result['total_rows'];
            } else {
                return 0; // Return 0 if no records or total_rows is not set
            }
        } catch (PDOException $e) {
            // Handle the exception, log the error, or return false
            return $e;
        }
    }

    public function count_total_users()
    {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) AS total_users FROM users");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['total_users'])) {
                return $result['total_users'];
            } else {
                return 0; // Return 0 if no records or total_users is not set
            }
        } catch (PDOException $e) {
            // Handle the exception, log the error, or return false
            return $e;
        }
    }
    public function count_total_tasks()
    {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) AS total_tasks FROM tasks");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['total_tasks'])) {
                return $result['total_tasks'];
            } else {
                return 0; // Return 0 if no records or total_users is not set
            }
        } catch (PDOException $e) {
            // Handle the exception, log the error, or return false
            return $e;
        }
    }


    public function update_download_count($hash_id)
    {
        try {

            $stmt = $this->db->prepare("SELECT downloaded FROM uploaded_files WHERE hash_id = :hash_id");
            $stmt->bindParam(':hash_id', $hash_id);
            $stmt->execute();
            $currentDownloadCount = $stmt->fetchColumn();


            $newDownloadCount = $currentDownloadCount + 1;


            $stmt = $this->db->prepare("UPDATE uploaded_files SET downloaded = :downloaded WHERE hash_id = :hash_id");
            $stmt->bindParam(':hash_id', $hash_id);
            $stmt->bindParam(':downloaded', $newDownloadCount);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return false;
            }

            return true; // Record updated successfully
        } catch (PDOException $e) {

            return $e;
        }
    }

    public function update_file_record($hash_id, $newFileName, $newTitle, $newDescription, $newIsPrivate, $newPassword)
    {
        try {
            $stmt = $this->db->prepare("UPDATE uploaded_files SET name = :name, title = :title,  description = :description, private = :private, password = :password WHERE hash_id = :hash_id");
            $stmt->bindParam(':name', $newFileName);
            $stmt->bindParam(':title', $newTitle);
            $stmt->bindParam(':description', $newDescription);
            $stmt->bindParam(':private', $newIsPrivate, PDO::PARAM_INT);
            $stmt->bindParam(':password', $newPassword, PDO::PARAM_INT);
            $stmt->bindParam(':hash_id', $hash_id);
            $check = $stmt->execute();
            if ($stmt->rowCount() == 0) {
                return false; // Record not updated
            }

            return $check; // Record updated successfully
        } catch (PDOException $e) {
            // Handle the exception, log the error, or return false
            return $e;
        }
    }

    // check if the file is the same owner 
    public function check_file_ownership($hash_id, $user_id)
    {
        $stmt = $this->db->prepare("SELECT user_id FROM uploaded_files WHERE hash_id = :hash_id");
        $stmt->bindParam(':hash_id', $hash_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['user_id'] == $user_id) {
            return true;
        } else {
            return false;
        }
    }


    // delete data rows
    public function delete_file_record($hash_id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM uploaded_files WHERE hash_id = :hash_id");
            $stmt->bindParam(':hash_id', $hash_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Record deleted successfully
            } else {
                return false; // Record not found or not deleted
            }
        } catch (PDOException $e) {

            return false;
        }
    }

    // delete the file
    public function delete_file($hash_id, $user_id)
    {

        if ($this->check_file_ownership($hash_id, $user_id)) {
            // Retrieve file information
            $fileInfo = $this->get_info($hash_id);

            if ($fileInfo['status']) {
                // Define the file path and folder path
                $filePath = __DIR__ . '/../uploaded_files/' . $fileInfo['data']['hash_id'] . '/' . $fileInfo['data']['name'];
                $folderPath = __DIR__ . '/../uploaded_files/' . $fileInfo['data']['hash_id'];

                if (unlink($filePath)) {
                    if (rmdir($folderPath)) {
                        $this->delete_file_record($hash_id);

                        return ['status' => true, 'message' => 'File and folder deleted successfully'];
                    } else {
                        return ['status' => false, 'message' => 'Failed to delete folder'];
                    }
                } else {
                    return ['status' => false, 'message' => 'Failed to delete file from server'];
                }
            } else {
                return ['status' => false, 'message' => 'File not found'];
            }
        } else {
            return ['status' => false, 'message' => 'Permission denied'];
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
