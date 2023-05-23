<?php

class Post
{
    public $id;
    public $id_user;
    public $type; // text or|and photo
    public $created_at;
    public $body;
}

interface PostDAO
{
    public function insert(Post $p);
}