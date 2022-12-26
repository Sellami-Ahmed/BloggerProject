<?php
class User
{


    //Find user by email or username
    public static function addLikedPost($db, $id, $post, $bool)
    {
        try {
            if ($bool) {
                $sql = 'UPDATE users set likedPost=concat(likedPost,?) 
            WHERE id=?';
            } else {
                $sql = "UPDATE users set  likedPost=REPLACE(likedPost,?,'') WHERE id=?";
            }
            $params = array("#" . $post, $id);
            $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return false;
        }
    }
    public static function findLikedPost($db, $id, $post)
    {
        try {
            $sql = 'SELECT * FROM users WHERE id =? and (likedPost LIKE ? )';
            $params = array($id, "%" . $post . "%");
            $resultat = $db->execute_query($sql, $params);
            $row = $resultat->fetchAll(PDO::FETCH_OBJ);
            if (count($row) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return false;
        }
    }
    public static function findUserByEmailOrUsername($db, $email, $pwd)
    {
        try {
            $sql = 'SELECT * FROM users WHERE usersPwd = :userspwd and (usersUid = :username OR usersEmail = :email)';
            $params = array('username' => $email, 'email' => $email, 'userspwd' => $pwd);
            $resultat = $db->execute_query($sql, $params);
            $row = $resultat->fetch(PDO::FETCH_OBJ);
            if ($row) {
                return $row;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return null;
        }
    }


    public static function register($db, $data)
    {

        try {
            $sql = 'INSERT INTO users (username, usersEmail, usersUid, usersPwd) 
                VALUES (?, ?, ?, ?)';
            $params = array($data['usersName'], $data['usersEmail'], $data['usersUid'], $data['usersPwd']);
            $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return false;
        }
        return true;
    }

    //Login user
    public function login($db, $nameOrEmail, $password)
    {
        $row = $this->findUserByEmailOrUsername($db, $nameOrEmail, $password);

        if ($row == false) return false;
        foreach ($row as $r) {
            $hashedPassword = $r["usersPwd"];
            if ($password == $hashedPassword) {
                return $row;
            } else {
                return false;
            }
        }
    }

    // ===================================================================================================
    public static function updateUser($db, $id, $isAdmin)
    {
        try {
            $sql = 'UPDATE users set isAdmin=? WHERE id=?';
            $params = array($isAdmin, $id);
            $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return false;
        }
        return true;
    }


    public static function isAdmin($db, $id)
    {
        try {
            $sql = 'SELECT isAdmin FROM users WHERE id=?';
            $params = array($id);
            $resultat = $db->execute_query($sql, $params);
            $isAdmin = $resultat->fetch(PDO::FETCH_OBJ);
            if ($isAdmin) {
                return $isAdmin;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return false;
        }
    }

    public static function delete($db, $id)
    {
        try {
            $sql = 'DELETE FROM users WHERE id=?';
            $params = array($id);
            $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return false;
        }
        return true;
    }


    // ===================================================================================================
    public static function getAll($db)
    {
        try {
            $sql = 'SELECT id,username,usersEmail,usersUid,isAdmin FROM users';
            $resultat = $db->execute_query($sql);
            $row = $resultat->fetchAll(PDO::FETCH_OBJ);
            if ($row) {
                return $row;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return null;
        }
    }
}
