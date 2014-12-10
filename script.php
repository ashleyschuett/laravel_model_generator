<?php

$args = explode(',',$argv[1]);

$file = 'file.php';
$handle = fopen($file, 'w') or die ('Connot open file: '.$file);


$fillable = '';
$rules = '';
$saver = '';

foreach($args as $arg){
	$fillable = $fillable .  "'". $arg ."',";
	$rules = $rules . "\t\t\t'".$arg."' => 'required',\n";
	$saver = $saver . "\t\t\t'".$arg."' => Input::get('".$arg."'),\n";
}

$content = '<?php '."\n".' 
	protected $fillable=['. $fillable ."];\n
	
	public static function rules(){\n
		return array(\n" .$rules."
		);\n
	}\n
	
	public static function saver(){ \n
		return array(\n".$saver."
		);\n
	}\n
?>";

fwrite($handle, $content);
fclose($handle);

?>