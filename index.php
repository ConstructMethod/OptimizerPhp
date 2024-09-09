<?php
require 'PhpOptimizer.php';

use PhpOptimizer\AdvancedOptimizer;

$code = file_get_contents('your-file.php');
$optimizer = new AdvancedOptimizer($code);
$optimizedCode = $optimizer->optimize();

$filename = "optimized_" . rand(1000,10000) . ".php";
file_put_contents($filename, $optimizedCode);
?>
