
<?php

    abstract class Database{
        //Nos constantes
        const DB_HOST = 'mysql:host=localhost;dbname=blog;charset=utf8';
        const DB_USER = 'root';
        const DB_PASS = '';

        private $connection;

        private function checkConnection(){
            //Vérifie si la connection est nulle et fait appel à la fonction getConnection
            if($this -> connection === null){
                return $this -> getConnection();
            }
            //Si la connexion existe, elle est renvoyée, inutle de refaire une connexion
            return $this -> connection;
        }

        //Méthodes de connection à la base de données 
        private function getConnection(){
            //Test de connexion à la base de données
            try{
                $this->connection = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //renvoie la connexion
                return $this->connection;
            }
            //Montre l'erreur de connexion
            catch(Exception $errorConnection){
                die ('Erreur de connection :'.$errorConnection->getMessage());
            }
        }

        protected function createQuery($sql, $parameters=null){
            if($parameters){
                $result = $this -> checkConnection() -> prepare($sql);
                $result->setFetchMode(PDO::FETCH_CLASS, static::class);
                $result -> execute($parameters);
                return $result;
            }
            $result = $this -> checkConnection() -> query($sql);
            $result->setFetchMode(PDO::FETCH_CLASS, static::class);
            return $result;
        }
    }
?>