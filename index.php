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
            }
        }else{
            // page home
            listPosts();
        }

    }catch(Exception $e)
    {
        $errorMessage = $e->getMessage();

    }

