<?php

class Post
{
    public $id;
    public $id_user;
    public $type; // text or|and photo
    public $created_at;
    public $body;
    public $my = false;
    public $liked = false;
    public $comments = [];
    public $user;
    public $likeCount = 0;
}

interface PostDAO
{
    public function insert(Post $p);
    public function getHomeFeed($id_user);
}