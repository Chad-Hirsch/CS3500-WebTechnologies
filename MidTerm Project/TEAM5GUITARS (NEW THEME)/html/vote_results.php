<?php
$vote = $_REQUEST['vote'];

//get content of textfile
$filename = "poll_result.txt";
$content = file($filename);

//put content in array
$array = explode("||", $content[0]);
$zero = $array[0];
$one = $array[1];
$two = $array[2];
$three = $array[3];
$four = $array[4];
$five = $array[5];

if ($vote == 1) {
  $zero = $zero + 1;
}
if ($vote == 2) {
  $one = $one + 1;
}
if ($vote == 3) {
  $two = $two + 1;
}
if ($vote == 4) {
  $three = $three + 1;
}
if ($vote == 5) {
  $four = $four + 1;
}
if ($vote == 6) {
  $five = $five + 1;
}

//insert votes to txt file
$insertvote = $zero."||".$one."||".$two."||".$three."||".$four."||".$five ;

$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>

<h2>Result:</h2>
<table>
<tr>
<td>0:</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($zero/($zero+$one+$two+$three+$four+$five),6)); ?>'
height='20'>
</td>
</tr>

<tr>
<td>1:</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($one/($zero+$one+$two+$three+$four+$five),6)); ?>'
height='20'>
</td>
</tr>

<tr>
<td>2:</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($two/($zero+$one+$two+$three+$four+$five),6)); ?>'
height='20'>
</td>
</tr>

<tr>
<td>3:</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($three/($zero+$one+$two+$three+$four+$five),6)); ?>'
height='20'>
</td>
</tr>

<tr>
<td>4:</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($four/($zero+$one+$two+$three+$four+$five),6)); ?>'
height='20'>
</td>
</tr>

<tr>
<td>5:</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($five/($zero+$one+$two+$three+$four+$five),6)); ?>'
height='20'>
</td>
</tr>

</table>