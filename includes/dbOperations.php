<?php

class DbOperations
{

    private $con;

    public function __construct()
    {

        require_once dirname(__FILE__) . '/dbConnection.php';

        $db = new DbConnect();

        $this->con = $db->connect();
    }

    /* CRUD  -> C -> CREATE */

    // addding new user
    public function createUser($first_name, $last_name, $email, $contact, $username, $pass, $user_type, $status)
    {
        $password = md5($pass); // password hashing
        if ($this->isUserExist($username, $email)) {
            // user exists
            return 0;
        } else {
            $stmt = $this->con->prepare("INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `contact`, `password`, `user_type`, `status`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("ssssssss", $first_name, $last_name, $username, $email, $contact, $password, $user_type, $status);

            if ($stmt->execute()) {
                // user created
                return 1;
            } else {
                // some error
                return 2;
            }
        }
    }

    // addding new question
    public function createPost($user_id, $title, $description)
    {
        $stmt = $this->con->prepare("INSERT INTO `questions` (`question_id`, `user_id`, `title`, `description`) VALUES (NULL, ?, ?, ?);");
        $stmt->bind_param("iss", $user_id, $title, $description);

        if ($stmt->execute()) {
            // question created
            return 0;
        } else {
            // some error
            return 1;
        }

    }

    // adding comments
    public function addComment($question_id, $user_id, $comment)
    {
        $stmt = $this->con->prepare("INSERT INTO `comments` (`comment_id`, `question_id`, `user_id`, `comment`) VALUES (NULL, ?, ?, ?);");
        $stmt->bind_param("iis", $question_id, $user_id, $comment);

        if ($stmt->execute()) {
            // comment added
            return 0;
        } else {
            // some error
            return 1;
        }
    }

    /* CRUD  -> R -> RETRIEVE */

    // user login
    public function userLogin($username, $pass)
    {
        $password = md5($pass); // password decrypting
        $stmt = $this->con->prepare("SELECT `user_id` FROM `users` WHERE `username` = ? AND `password` = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // retreiving user data by username
    public function getUserByUsername($username)
    {
        $stmt = $this->con->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // checking if the user exists
    private function isUserExist($username, $email)
    {
        $stmt = $this->con->prepare("SELECT `user_id` FROM `users` WHERE `username` = ? OR `email` = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // retrieving questions table
    public function getAllQuestions()
    {
        $stmt = $this->con->prepare("SELECT * FROM `questions` INNER JOIN `users` ON users.user_id = questions.user_id ");
        $stmt->execute();
        return $stmt->get_result();
    }

    // retrieving users table
    public function getAllUsers()
    {
        $stmt = $this->con->prepare("SELECT * FROM `users` WHERE `user_type` != 'ADMIN' AND `status` != 'PENDING'");
        $stmt->execute();
        return $stmt->get_result();
    }

    // retrieving pending users
    public function getPendingUsers()
    {
        $stmt = $this->con->prepare("SELECT * FROM `users` WHERE `user_type` = 'CLINIC' AND `status` = 'PENDING'");
        $stmt->execute();
        return $stmt->get_result();
    }

    // retrieving questions by user
    public function getMyQuestions($user_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM `questions` WHERE `user_id` = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // retreiving single question
    public function getSingleQuestion($question_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM `questions` INNER JOIN `users` ON users.user_id = questions.user_id WHERE `question_id` = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // retreiving comments per question
    public function getCommentsPerQuestion($question_id)
    {
        $stmt = $this->con->prepare("SELECT * FROM `comments` INNER JOIN `users` ON users.user_id = comments.user_id WHERE `question_id` = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    /* CRUD  -> U -> UPDATE */

    // update user status
    public function updateUserStatus($user_id, $status)
    {
        $stmt = $this->con->prepare("UPDATE `users` SET `status` = ? WHERE `user_id` = ?");
        $stmt->bind_param("si", $status, $user_id);

        if ($stmt->execute()) {
            // user status updated
            return 0;
        } else {
            // some error
            return 1;
        }
    }

    /* CRUD  -> D -> DELETE */

    // deleting questions
    public function deleteQuestion($question_id)
    {
        $stmt = $this->con->prepare("DELETE FROM `questions` WHERE `question_id` = ?");
        $stmt->bind_param("i", $question_id);

        if ($stmt->execute()) {
            // question deleted
            return 0;
        } else {
            // some error
            return 1;
        }
    }

}
