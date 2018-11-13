<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>TD1 : exercice 1</title>
		<link rel="stylesheet" type="text/css" href="TP1-php.css">
	</head>
	<body>
		<table>
			<?php 
				for($i=1; $i <= 9; $i++) {
					for($j=1; $j <= 9; $j++) {
						if($i==1 and $j==1) {
							?>
							<tr>
								<td class="impaire">
								</td>
							<?php
						}
						
						else if($j==1) {
							?>
							<td class="impaire">
								<?php echo $i ?>
							</td>
							<?php
						}
						
						else if($i==$j and $i%2==0){
						?>
						<td class="paire">
							<B><?php echo ($i * $j) ?></B>
						</td>
						<?php
						}
						
						else if($i==$j and $i%2==1){
						?>
						<td class="impaire">
							<B><?php echo ($i * $j) ?></B>
						</td>
						<?php
						}
						
						else if($i%2==0){
						?>
						<td class="paire">
							<?php echo ($i * $j) ?>
						</td>
						<?php
						}
						
						else {
						?>
						<td class="impaire">
							<?php echo ($i * $j) ?>
						</td>
						<?php
						}
						
						if($j==9) {
							?>
							</tr>
							<?php
						}
					}
				}
					
			?>
		</table>
	</body>
</html>