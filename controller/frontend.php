<?php 
    require('model/frontend.php');


    function listPosts()
    {
        $posts = getPosts();
        require "view/frontend/listPostsView.php";
    }

    function post($id)
    {
        $safeId = htmlspecialchars($id);
        $post = getPost($safeId);
        $comments = getComments($safeId);

        require "view/frontend/postView.php";
        
    }


?>