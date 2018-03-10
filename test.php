<?php
$posi = array();
$p = fopen("position.txt", "r");
while(!feof($p)) { array_push($posi,fgets($p)); }
fclose($p);
$i = 0; ?>
<script>
for (i = 0; i < 5; i++) {
  var val =[<?php foreach($posi as $a){echo trim($a) . ',';}; ?>];
  console.log(val);
  <?php $i++; ?>
}
</script>
