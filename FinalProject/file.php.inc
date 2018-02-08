<?php
require_once("error.php.inc");
class file
{
	private $db;
	private $logger;
	public function __construct($ini_file)
	{
		$ini	  = parse_ini_file($ini_file, true);
		$logger   = new error_logger("logs/files.log");
		$this->db = new mysqli(
			$ini['db']['host'],
			$ini['db']['user'],
			$ini['db']['password'],
			$ini['db']['db']);
		if ($this->db->connect_errno > 0) {
			$this->logger->log("Failed to connect to database".$this->db->connect_error);
			exit(0);
		}
		echo "<p>Connected to db".PHP_EOL;
	}
	public function __destruct()
	{
		$this->db->close();
		echo "<p>Closed connection to db".PHP_EOL;
	}
	public function file_get($file_name)
	{
		$query   = "select file_name from files where file_name='$file_name';";
		$results = $this->db->query($query);
		if (!$results) {
			$this->logger->log("error with results: ".$this->db->error);
			return 0;
		}
		$user = $results->fetch_assoc();
		if (isset($file_name["file_name"])) {
			return $file_name["file_name"];
		}
		return 0;
	}
	public function file_upload()
	{
		$file_name = $this->db->real_escape_string(basename($_FILES['file_up']['name']));
		$temp = explode(".", $_FILES["file_up"]["name"]);
		$newfilename = round(microtime(true)).'.'.end($temp);
		$host_url = "http://192.168.2.4/";
		$dir = "uploads/";
		$file_url = $host_url.$dir.$file_name;
		$now = date("Y-m-d h:i:s", time());		
		$query   = "
			insert into files
			(
				file_name,
				file_url,
				upload_date
			)
			values
			(
				'$file_name',
				'$file_url',
				'$now'
			);";
		
		$results = $this->db->query($query);
		if (move_uploaded_file($_FILES['file_up']['tmp_name'], $dir.$newfilename) && $results)
		{
			echo "<p> The file ".basename($file_name)." has been uploaded";
		}
		else
		{
			$this->logger->log("error with results: ".$this->db->error);
			echo "<p> Sorry, there was a problem uploading your file.";
		}
		return array(
			"success" => true
		);
	}
	public function file_search($param)
	{
		$host_url = "http://127.0.0.1/";
		$dir = "uploads/";
		$term	= $this->db->real_escape_string($param);
		$query	 = "select from files where lower(file_name) like lower('%".$term."%')";
		$results = $this->db->query($query);
		if ($results)
		{
			while ($row = $results->fetch_assoc())
			{
				$file_name = $row['file_name'];
				$file_url = '<a href="'.$host_url.$dir.$file_name.'">'.$file_name.'<a>';
				echo '<p>Filename: '.$file_name;
				echo '<p>URL: '.$file_url;
			}
			return array(
				"success" => true
			);
		}
		else
		{
			echo '<p>No files containing "'. $term .'" found...';
		}
		return array(
			"success" => false
		);
	}
	public function file_browse()
	{
		$host_url = "http://127.0.0.1/";
		$dir = "uploads/";
		$files = glob($dir);
		foreach ($files as $file_name)
		{
			if ($file_name == $dir)
				continue;
			$file_url = '<a href="'.$host_url.$dir.$file_name.'">'.$file_name.'<a>';
			echo '<p>Filename: '.$file_name;
			echo '<p>URL: '.$file_url;
		}
		echo "<p>Finished loading";
	}
	public function file_scan()
	{
		$host_url = "http://127.0.0.1/";
		$dir = "uploads/";
		$files = glob($dir);
		foreach ($files as $file)
		{
			$file_name = $file->getFilename();
			$file_url = $host_url.$dir.$file_name;
			$now = date("Y-m-d h:i:s", time());
			$query   = "
			insert into files
			(
				file_name,
				file_url,
				upload_date
			)
			values
			(
				'$file_name',
				'$file_url',
				'$now'
			);";
			$results = $this->db->query($query);
		}
		echo "<p>Directory rescanned!";
		return array(
			"success" => true
		);
	}
}
?>
