<?php

class Post
{
    private $id;
    private $content;
    private $dateCreated;
    private $image;

    public function __construct($id, $content, $dateCreated, $image)
    {
        $this->setId($id);
        $this->setContent($content);
        $this->setImage($image);
        $date = date_create($dateCreated);
//        $date = date_format($date, 'd.m.Y. H:i');
        $this->setDateCreated($date);
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : null;
    }

    public function __call($name, $arguments)
    {
        $function = substr($name,0,3);
        if ($function === 'set')
        {
            $this->__set(strtolower(substr($name,3)), $arguments[0]);
            return $this;
        }elseif($function == 'get'){
            return $this->__get(strtolower(substr($name ,3)));
        }
        return $this;
    }

    public static function all()
    {
        $list = [];
        $db = Db::connect();
        $statement = $db->prepare("select * from post ORDER BY dateCreated DESC ");
        $statement->execute();
        foreach ($statement->fetchAll() as $post) {
            $list[] = new Post($post->id, $post->content, $post->image, $post->dateCreated);
        }
        return $list;
    }

    public static function find($id)
    {
        $id = intval($id);
        $db = Db::connect();
        $statement = $db->prepare("select * from post where id = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        $post = $statement->fetch();
        return new Post($post->id, $post->content, $post->image, $post->dateCreated);
    }

}