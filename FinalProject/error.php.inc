<?php
class error_logger
{
	public function __construct($output_file)
	{
		$this->fp = fopen($output_file,"a");
	}
	public function log($message)
	{
		fwrite($this->fp,$message.PHP_EOL);
	}
	public function __destruct()
	{
		fclose($this->fp);
	}
}
?>
