<?php
class SQL {
        const DB_NAME ='hoge';
        const HOST ='hoge';
        const UTF ='hoge';
        const USER ='hoge';
        const PASS ='hoge';

        public PDO $pdo ; 

    public function __construct(){
        $dsn = "mysql:host=" .self::HOST. ";dbname=" .self::DB_NAME. ";charset=" .self::UTF;
        $u = self::USER;
        $p = self::PASS;
        try{
          $this->pdo = new PDO($dsn, $u, $p);
        }catch(Exception){
          exit();
        }
      }
  public function select( array $user){
        try {
          $sql = "SELECT * FROM users WHERE class=:class AND no= :no";
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class", $user["user_class"], PDO::PARAM_STR);
          $st->bindValue(":no", $user["user_no"], PDO::PARAM_STR);
          $st->execute();    
          return $st->fetch(PDO::FETCH_ASSOC);        
        }
        catch (Exception) {
          return  "接続できませんでした。";
        }        
      }

      public function NewUser( array $user){
        try {
          $sql = "INSERT INTO users VALUES( :class, :no, :pw, :name )";
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class",$user["user_class"],PDO::PARAM_STR);
          $st->bindValue(":no",$user["user_no"],PDO::PARAM_STR);
          $hash = password_hash($user["user_pass"], PASSWORD_DEFAULT);
          $st->bindValue(":pw",$hash,PDO::PARAM_STR);
          $st->bindValue(":name",$user["user_name"],PDO::PARAM_STR);
          return $st->execute();    
        }
        catch (Exception) {
          return false;
        }        
      }


      public function Bpattern( array $user){
        try {
          $sql = "SELECT Tpattern  FROM record where class=:class AND NO=:no ORDER BY Tdate DESC LIMIT 1";
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class", $user["user_class"], PDO::PARAM_STR);
          $st->bindValue(":no", $user["user_no"], PDO::PARAM_STR);
          $st->execute();    
          return $st->fetch(PDO::FETCH_ASSOC);        
        }
        catch (Exception) {
          return  "接続できませんでした。";
        }        
      }

      public function record( array $user){
        try {
          $sql = " SELECT Tdate,Tpattern,Tcount  FROM record where class=:class AND NO=:no ";
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class", $user["user_class"], PDO::PARAM_STR);
          $st->bindValue(":no", $user["user_no"], PDO::PARAM_STR);
          $st->execute();    
          return $st->fetchAll(PDO::FETCH_ASSOC);        
        }
        catch (Exception) {
          return  "接続できませんでした。";
        }        
      }

      public function TodayRecord( array $user,array $POST){
        try {
          $sql = "INSERT INTO `record` (`class`, `no`, `Tdate`, `Tpattern`, `Tcount`) VALUES (:class,:no,:Tdate,:Tpattern,:Tcount )";/*SQL文を作る。文はHeidiで作るのが吉。*/
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class", $user["user_class"], PDO::PARAM_STR);
          $st->bindValue(":no", $user["user_no"], PDO::PARAM_STR);
          $st->bindValue(":Tdate",$POST["Tdate"],PDO::PARAM_STR ) ;
          $st->bindValue(":Tpattern",$POST["Tpattern"],PDO::PARAM_STR ) ;
          $st->bindValue(":Tcount",$POST["Tcount"],PDO::PARAM_STR ) ;
          $st->execute();    
          return  "<h1>登録できました。</h1>";        
        }
        catch (Exception) {
          return false;
        }        
      }

      public function Update( array $user,array $POST){
        try {
          $sql = "UPDATE record SET Tpattern=:Tpattern,Tcount=:Tcount WHERE class=:class and NO=:no and Tdate=:Tdate";
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class", $user["user_class"], PDO::PARAM_STR) ;
          $st->bindValue(":no", $user["user_no"], PDO::PARAM_STR) ;
          $st->bindValue(":Tdate",$POST["Tdate"],PDO::PARAM_STR ) ;
          $st->bindValue(":Tpattern",$POST["Tpattern"],PDO::PARAM_STR ) ;
          $st->bindValue(":Tcount",$POST["Tcount"],PDO::PARAM_STR ) ;
          $st->execute() ;
          return  "<h1>修正できました。</h1>";        
        }
        catch (Exception) {
          return false;
        }        
      }


      public function Dbconnect1( array $data){
        try {
          $sql = "SELECT class,no,name FROM users WHERE class=:class";
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class", $data["class"], PDO::PARAM_STR);
          $st->execute();    
          return  $st->fetchAll(PDO::FETCH_ASSOC);        
        }
        catch (Exception) {
          return false;
        }        
      }

      public function Dbconnect2( array $data){
        try {
          $sql = "SELECT record.class,record.no,Tdate,Tpattern,Tcount,name 
          FROM record LEFT OUTER JOIN users ON record.class = users.class 
          AND record.no = users.no WHERE record.class=:class and Tdate=:Tdate";
          $st = $this->pdo->prepare($sql);
          $st->bindValue(":class", $data["class"], PDO::PARAM_STR);
          $st->bindValue(":Tdate", $data["Tdate"], PDO::PARAM_STR);
          $st->execute();    
          return  $st->fetchAll(PDO::FETCH_ASSOC);        
        }
        catch (Exception) {
          return false;
        }        
      }


      
}








    ?>