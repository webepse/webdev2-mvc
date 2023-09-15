<?php 
    require('model/frontend.php');

    function postCommentController($id)
    {
        $safeId = htmlspecialchars($id);
        if(isset($_POST['author']))
        {
            if($post = getPost($safeId))
            {
                $error = 0;
                if(empty($_POST['author']))
                {
                    $error = 1;
                }else{
                    $author = htmlspecialchars($_POST['author']);
                }

                if(empty($_POST['comment']))
                {
                    $error = 2;
                }else{
                    $comment = htmlspecialchars($_POST['comment']);
                }

                if($error==0)
                {
                    // model pour insertion
                    $postCom = postComment($safeId, $author, $comment);
                    if($postCom)
                    {
                        $post = getPost($safeId);
                        $comments = getComments($safeId);
                        require "view/frontend/postView.php";
                    }else{
                        throw new Exception("Impossible d'ajouter le commentaire!");
                    }
                }else{
                    $post = getPost($safeId);
                    $comments = getComments($safeId);
                    $myError = $error;
                    require "view/frontend/postView.php";

                }
            }else{
                throw new Exception("Le post n'existe pas");
            }
        }else{
            throw new Exception("Mauvaise destination");
        }
    }


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