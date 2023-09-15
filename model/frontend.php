<?php

    /**
     * Permet d'obtenir la liste de tous les posts
     *
     * @return array
     */
    function getPosts(): array
    {
        $db = dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%i") AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0,5');
        $donReq = $req->fetchAll();
        $req->closeCursor();

        return $donReq;
    }

    /**
     * Permet de récup un post
     *
     * @param integer $id
     * @return array
     */
    function getPost(int $id): array
    {
        $db = dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%i") AS creation_date_fr FROM posts WHERE id=?');
        $req->execute([$id]);
        $donReq = $req->fetch();
        $req->closeCursor();

        return $donReq;
    }
    
    /**
     * Permet de récup les commentaires d'un post
     *
     * @param integer $id
     * @return array
     */
    function getComments(int $id): array
    {
        $db = dbConnect();
        $comments = $db->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC");
        $comments->execute([$id]);
        $donCom = $comments->fetchAll();
        $comments->closeCursor();

        return $donCom;
    }



    /**
     * Permet de réaliser une connexion PDO
     *
     * @return PDO
     */
    function dbConnect(): PDO
    {
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=blog2;charset=utf8','root','',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            return $bdd;

        }catch(Exception $e)
        {
            die('Erreur:'.$e->getMessage());
        }
    }

?>