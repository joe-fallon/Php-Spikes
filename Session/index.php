<?php

$dbname = 'spike_session';
$dbuser = 'spike_session';
$dbpass = 'spike_session';
$dbhost = 'localhost';
$dbport = '3306'; 


$dsn = "mysql:host=$dbhost;port=$dbport;dbname=$dbname";

/*
SQL:

CREATE TABLE `sessions` (
`id` CHAR( 40 ) NOT NULL ,
`data` LONGTEXT NOT NULL ,
`created` DATETIME NOT NULL ,
`last_activity` DATETIME NOT NULL ,
PRIMARY KEY ( `id` ) ,
INDEX ( `created` , `last_activity` )
) ENGINE = InnoDB;

INSERT INTO `sessions` (
`id` ,
`data` ,
`created` ,
`last_activity`
)
VALUES (
        MD5( 'adasdasdasdssadasdaasdasd' ) , 
        MD5( 'adasdasdasdsasadasd' ) , 
        '2013-01-30 10:19:37', 
        '2013-01-30 10:19:40'
    ), (
        MD5( 'kj654hgfd' ) , 
        MD5( 'kjhgr467ffefdd' ) ,
        '2013-01-30 10:20:56', 
        '2013-01-30 10:20:59'
);


 */

$output = null;

class DbSession
{
    private static $_instance = null;
    private static $_dbConnection = null;
    
    private function __construct()
    {
        session_set_save_handler(
            array($this,'open'),
            array($this,'close'),
            array($this,'read'),
            array($this,'write'),
            array($this,'destroy'),
            array($this,'gc')
        );
        
        
        
    }
    
    public static function initialize($dbConnection)
    {
        self::$_dbConnection = $dbConnection;
        self::$_instance = new DbSession();
    }
    
    public static function open()
    {
        global $output;
        $output .= "open session\n";
        return true;
    }
    
    public static function close()
    {
        global $output;
        $output .= "close session\n";
        return true;
    }
    
    public static function read($id)
    {
        //global $output;
        //$output .= "read session($id)\n";
        
        $dbConn = self::$_dbConnection;
        $stmt = $dbConn->prepare("SELECT * FROM sessions WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($row) > 0)
        {
            // update last activity
            $stmt = $dbConn->prepare('UPDATE sessions SET last_activity = :last_activity WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->bindValue(':last_activity', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->execute();
            
            return $row[0]['data'];
        }
        
        return false;
    }
    
    public static function write($id, $data)
    {
        //global $output;
        //$output .= "write session($id)\n";
        
        $dbConn = self::$_dbConnection;
        $stmt = $dbConn->prepare("SELECT * FROM sessions WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //$output .= print_r($row, true);
        
        if(count($row) > 0)
        {
            // update last activity and data
            $stmt = $dbConn->prepare('UPDATE sessions SET last_activity = :last_activity, data = :data WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->bindValue(':data', $data, PDO::PARAM_STR);
            $stmt->bindValue(':last_activity', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->execute();
        }
        else
        {
            // create the session
            $stmt = $dbConn->prepare('INSERT INTO sessions(id,data,created,last_activity) VALUES(:id,:data,:created,:last_activity)');
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->bindValue(':data', $data, PDO::PARAM_STR);
            $stmt->bindValue(':last_activity', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->bindValue(':created', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->execute();
            //die('dead');
        }
        
    }
    
    public static function destroy($id)
    {
        $dbConn = self::$_dbConnection;
        $stmt = $dbConn->prepare("DELETE FROM sessions WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        
        //global $output;
        //$output .= "destroy session ($id)\n";
    }
    
    public static function gc()
    {
        return true;
    }
    
}

?>

<pre>
-------------------------------------------
Session Spike
-------------------------------------------

Test (x500):
1. Start file-based session.
2. Save a value to session. 
3. Read a value from session.
4. Unset and destroy the session.

<?php

$start = microtime(true);

for($i = 0; $i < 500; $i++)
{
    session_start();
    
    $_SESSION['foo'] = mt_rand();
    $bar = $_SESSION['foo'];
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    $bar = null;
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";


?>


Test (x500):
1. Start file-based session.
2. Save a value to session. 
3. Read a value from session.
4. Close the session and write session to disk.

<?php

$start = microtime(true);

for($i = 0; $i < 500; $i++)
{
    session_start();
    
    $_SESSION['foo'] = mt_rand();
    $bar = $_SESSION['foo'];
    
    session_write_close();
    
    $bar = null;
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";


?>



<?php
$dbConn = new PDO($dsn, $dbuser, $dbpass);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

DbSession::initialize($dbConn);

?>


Test (x500):
1. Start database-based session.
2. Save a value to session. 
3. Read a value from session.
4. Unset and destroy the session.

<?php

$start = microtime(true);

for($i = 0; $i < 500; $i++)
{
    session_start();
    
    $_SESSION['foo'] = mt_rand();
    $bar = $_SESSION['foo'];
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    $bar = null;
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";


?>


Test (x500):
1. Start database-based session.
2. Save a value to session. 
3. Read a value from session.
4. Close the session.

<?php

$start = microtime(true);

for($i = 0; $i < 500; $i++)
{
    session_start();
    
    $_SESSION['foo'] = mt_rand();
    $bar = $_SESSION['foo'];
    
    session_write_close();
    
    $bar = null;
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";

//echo $output;

?>

Test (x500):
1. Start database-based session.
2. Regenerate the session id.
2. Save a value to session. 
3. Read a value from session.
4. Unset and destroy the session.

<?php

$start = microtime(true);

for($i = 0; $i < 500; $i++)
{
    session_start();
    session_regenerate_id(true);
    
    $_SESSION['foo'] = mt_rand();
    $bar = $_SESSION['foo'];
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    
    $bar = null;
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";


?>

</pre>