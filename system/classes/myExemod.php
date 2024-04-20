<?
class myExemod{
	var $data;
	public function __construct($exe)
	{
		$this->data = file_get_contents($exe);
	}
	public function search_names()
	{
		$s_tag = 'SO!#';
		$r_tag = '¶';
		$e_tag = 'EO!#';
		$point = 0;
		while(($point=strpos($this->data, $s_tag, $point))!==false)
		{	
			$point += 4;
			$name_pos = $point;
			$point = strpos($this->data, $r_tag, $point);
			$name = substr($this->data, $name_pos, $point-$name_pos);
			$point += 1;
			$data_pos = $point;
			$point = strpos($this->data, $e_tag, $point);
			//$data = substr($this->data, $data_pos, $point-$data_pos);
			$out[] = $name;
		}
		array_unique($out);
		return $out;
	}
	public function __destruct()
	{
		unset( $this->data );
	}
}
?>