<?php
class Comment
{
    private $content;
    private $commenter;
    private $parent;
    private $post_id;
    private $valid;

    public function __construct($post_id = null, $content = null, $commenter = null, $parent = NULL, $valid = 0)
    {
        if (!is_null($content) && !is_null($commenter) && !is_null($post_id)) {
            $this->content = $content;
            $this->commenter = $commenter;
            $this->parent = $parent;
            $this->post_id = $post_id;
            $this->valid = $valid;
        }
    }
    public function __get($attr)
    {
        if (!isset($this->attr))
            return "";
        else return ($this->attr);
    }
    public function __set($attr, $value)
    {
        $this->attr = $value;
    }
    public function save($db, $id = null)
    {
        try {
            if (!isset($_SESSION)) {
                session_start();
            }
            if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin) {
                $this->valid = true;
            }
            if ($id == null) {
                $sql = "INSERT INTO comment(content,user_id,parent_id,post_id,valid) VALUES (?,?,?,?,?)";
                $params = array($this->content, $this->commenter, $this->parent, $this->post_id, $this->valid);
            } else {
                $sql = "UPDATE comment SET content=:content
                WHERE id=:id";
                $params = array('content' => $this->content, 'id' => $id);
            }
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            echo $e;
            return false;
        }
        return true;
    }

    public static function validate($db, $id)
    {
        try {

            $sql = "UPDATE comment SET valid=:valid
                    WHERE id=:id";
            $params = array('valid' => true, 'id' => $id);
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            echo $e;
            return false;
        }
        return true;
    }
    public static function getNbComments($db, $id_Post)
    {
        try {

            $sql = "SELECT count(comment.valid) as nbcomment FROM comment
                    JOIN post
                    ON comment.post_id=post.id
                    where comment.post_id=? and comment.valid=1 ";
            $params = array($id_Post);
            $resultat = $db->execute_query($sql, $params);
            if (!$resultat) {
                $erreur = $db->errorInfo();
                echo "Lecture impossible, code", $db->errorCode(), $erreur[2];
            } else {
                return $resultat->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            echo $e;
            return false;
        }
    }
    public static function getbyPost($db, $id)
    {
        try {
            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']->isAdmin) {
                    $sql = "SELECT comment.user_id,comment.valid,comment.id,comment.content,comment.submit_date,users.isAdmin as isAdmin,users.usersUid as usersUid FROM comment
                            LEFT JOIN users
                            ON comment.user_id=users.id
                            where comment.post_id=? ";
                    $params = array($id);
                } else {
                    $sql = "SELECT comment.user_id,comment.valid,comment.id,comment.content,comment.submit_date,users.isAdmin as isAdmin,usersUid as usersUid FROM comment
                            LEFT JOIN users
                            ON comment.user_id=users.id
                            where comment.post_id=? and (comment.valid=1 or comment.user_id=?) ";
                    $params = array($id, $_SESSION['user']->id);
                }
            } else {
                $sql = "SELECT comment.user_id,comment.valid,comment.id,comment.content,comment.submit_date,users.usersUid as usersUid,users.isAdmin as isAdmin FROM comment
                        LEFT JOIN users
                        ON comment.user_id=users.id
                        where comment.post_id=? and comment.valid=1 ";
                $params = array($id);
            }

            $resultat = $db->execute_query($sql, $params);
            if (!$resultat) {
                $erreur = $db->errorInfo();
                echo "Lecture impossible, code", $db->errorCode(), $erreur[2];
            } else {
                return $resultat->fetchAll(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            echo $e;
            return false;
        }
    }
    public static function countComment($db)
    {
        try {
            $sql = "SELECT count(valid) as nb
            from comment
            where valid=1";
            $resultat = $db->execute_query($sql);
            if (!$resultat) {
                $erreur = $db->errorInfo();
                echo "Lecture impossible, code", $db->errorCode(), $erreur[2];
            } else {
                return $resultat->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            echo $e;
            return false;
        }
    }
    public static function delete($db, $id)
    {
        try {
            $sql = "DELETE FROM comment where id=?";
            $params = array($id);
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}
