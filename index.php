<?php 
    require "controller/frontend.php";
    try{
        if(isset($_GET['action']))
        {
            if($_GET['action'] == 'listPost')
            {
                listPosts();
            }elseif($_GET['action'] == 'post')
            {
                if(isset($_GET['id']) && $_GET['id'] > 0)
                {
                    post($_GET['id']);
                }else{
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }elseif($_GET['action']=="addComment")
            {
                if(isset($_GET['id']))
                {
                    postCommentController($_GET['id']);
                }else{
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }else{
                throw new Exception("La page que vous cherchez, n'existe pas (ou plus)");
            }
        }else{
            // page home
            listPosts();
        }

    }catch(Exception $e)
    {
        $errorMessage = $e->getMessage();
        require "view/frontend/errorView.php";
    }

