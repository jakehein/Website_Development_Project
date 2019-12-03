<?php
		
  require_once('db_credentials.php');

  /* Connect to the database with the credentials given in the file above
     Return a handle to the PDO instance or output an error message and exit (stop execution)
   */
  function db_connect() {
	try {
		$dbh = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME,
		DB_USER,
		DB_PWD,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch (PDOException $e){
		?> 
		There was a problem connecting to the database
		<?php
		exit();
	}
	return $dbh;
	// TO BE COMPLETED

  }

  /* disconnect from the database, if needed
   */
  function db_disconnect() {
	global $db;
	if(isset($db)){
		$db = null;
	}
  }

 ?>
