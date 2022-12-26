<?php
class Post
{
    private $header;
    private $title;
    private $content;
    private $category;
    private $tags;
    private $blogger;
    public function __construct($header = null, $title = null, $content = null, $category = null, $tags = null, $blogger = null)
    {
        if (!is_null($header) && !is_null($title) && !is_null($content) && !is_null($category) && !is_null($blogger)) {
            $this->header = $header;
            $this->title = $title;
            $this->content = $content;
            $this->category = $category;
            $this->tags = $tags;
            $this->blogger = $blogger;
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
            if ($id == null) {
                $sql = "INSERT INTO post(title, header, content, category_id, tags,blogger) 
                VALUES (?,?,?,?,?,?)";
                $params = array($this->title, $this->header, $this->content, $this->category, $this->tags, $this->blogger);
                $resultat = $db->execute_query($sql, $params);
                return $db->lastId();
            } else {
                $sql = "UPDATE post SET title=?,
            
            header=?,
            content=?,
            category_id=?,
            blogger=?,
            tags=?
            WHERE id= ?";

                $params = array(
                    $this->title,

                    $this->header,
                    $this->content,
                    $this->category,
                    $this->blogger,
                    $this->tags,
                    $id
                );

                $resultat = $db->execute_query($sql, $params);
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }

            return false;
        }

        return true;
    }
    public static function getFeatred($db)
    {
        $sql = "SELECT post.id, post.title, post.header, post.content,post.likes,post.views,post.submit_date,post.comments, category.name as category
        FROM post
        LEFT JOIN category
        ON post.category_id = category.id WHERE post.id=( SELECT MAX(ID) FROM post )";
        $resultat = $db->execute_query($sql);
        if (!$resultat) {
            $erreur = $db->errorInfo();
            echo "Lecture impossible, id", $db->errorCode(), $erreur[2];
        } else {

            return $resultat->fetch(PDO::FETCH_OBJ);
        }
    }
    public static function getAll($db)
    {
        $sql = "SELECT post.id, post.title, post.header, post.content,post.likes,post.views,post.submit_date,post.comments, category.name as category
            FROM post
            LEFT JOIN category
            ON post.category_id = category.id";
        $resultat = $db->execute_query($sql);
        if (!$resultat) {
            $erreur = $db->errorInfo();
            echo "Lecture impossible, id", $db->errorCode(), $erreur[2];
        } else {

            return $resultat->fetchAll(PDO::FETCH_OBJ);
        }
    }
    public static function incViews($db, $id)
    {
        try {
            $sql = "UPDATE post
            SET views = views + 1
            WHERE id=?";
            $params = array($id);
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    public static function incLikes($db, $id, $op)
    {
        try {
            $sql = "UPDATE post
            SET likes = likes " . $op . " 1
            WHERE id=?";
            $params = array($id);
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    public static function incComments($db, $id, $op = "+")
    {
        try {
            $sql = "UPDATE post
            SET comments = comments " . $op . " 1
            WHERE id=?";
            $params = array($id);
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    public static function getbyid($db, $id)
    {
        $sql = "SELECT post.id,post.category_id, post.title, post.header, post.blogger, post.content,post.likes,post.views,post.submit_date,post.comments,post.tags, category.name as category
        FROM post
        LEFT JOIN category
        ON post.category_id = category.id
        WHERE post.id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql, $params);
        if (!$resultat) {
            $erreur = $db->errorInfo();
            echo "Lecture impossible, id", $db->errorCode(), $erreur[2];
        } else {
            return $resultat->fetch(PDO::FETCH_OBJ);
        }
    }
    public static function delete($db, $id)
    {
        try {
            $sql = "DELETE FROM post WHERE id=?";
            $params = array($id);
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    public static function searchByTag($db, $tag)
    {
        $sql = "SELECT post.id,post.category_id, post.title, post.header, post.content,post.likes,post.views,post.submit_date,post.comments,post.tags, category.name as category
        FROM post
        LEFT JOIN category
        ON post.category_id = category.id
        WHERE post.tags LIKE ?";
        $params = array("%" . $tag . "%");
        $resultat = $db->execute_query($sql, $params);
        if (!$resultat) {
            $erreur = $db->errorInfo();
            echo "Lecture impossible, id", $db->errorCode(), $erreur[2];
        } else {
            return $resultat->fetchAll(PDO::FETCH_OBJ);
        }
    }

    public static function searchByName($db, $name)
    {
        $sql = "SELECT post.id,post.category_id, post.title, post.header, post.content,post.likes,post.views,post.submit_date,post.comments,post.tags, category.name as category
        FROM post
        LEFT JOIN category
        ON post.category_id = category.id
        WHERE post.title LIKE ?";
        $params = array("%" . $name . "%");
        $resultat = $db->execute_query($sql, $params);
        if (!$resultat) {
            $erreur = $db->errorInfo();
            echo "Lecture impossible, id", $db->errorCode(), $erreur[2];
        } else {
            return $resultat->fetchAll(PDO::FETCH_OBJ);
        }
    }
    public static function searchByCategory($db, $cat_id)
    {


        $sql = "SELECT post.id,post.category_id, post.title, post.header, post.content,post.likes,post.views,post.submit_date,post.comments,post.tags, category.name as category
        FROM post
        JOIN category
        ON post.category_id = category.id
        WHERE post.category_id=? ";
        $params = array($cat_id);
        $resultat = $db->execute_query($sql, $params);

        if (!$resultat) {
            $erreur = $db->errorInfo();
            echo "Lecture impossible, id", $db->errorCode(), $erreur[2];
        } else {
            return $resultat->fetchAll(PDO::FETCH_OBJ);
        }
    }
}
