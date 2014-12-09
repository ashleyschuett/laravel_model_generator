<?php

$args = explode(',',$argv[1]);

$file = 'file.php';
$handle = fopen($file, 'w') or die ('Connot open file: '.$file);

$content = '<?php '."\n".' 
protected $fillable=[';

foreach($args as $arg){
	$content = $content .  "'". $arg ."',";
}
	
$content = $content . "]; \n 
public static function rules(){ \n 
	return array(\n";

foreach ($args as $arg){
	$content = $content . "\t\t\t'".$arg."' => 'required',\n";
}

$content = $content . "\t);\n
} \n
public static function saver(){ \n
	return array(\n";


foreach ($args as $arg){
	$content = $content . "\t\t\t'".$arg."' => Input::get('".$arg."'),\n";
}

$content = $content . "\t);\n
}\n
?>";


fwrite($handle, $content);
fclose($handle);

?>