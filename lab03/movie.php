<!--Pietro Mondino file html per il contenuto del sito di recensione del film TNMT-->

<?php
$movie = $_GET["movie"];

$info = file("./moviefiles/" . $movie . "/info.txt");
list($title, $year, $score) = $info;

function manage_review($display_buffer)
{
?><p class="review">
		<?php
		if (trim($display_buffer[1]) == "FRESH") {
		?>
			<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/fresh.gif" alt="Fresh">
		<?php
		} else {
		?>
			<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" alt="Rotten">
		<?php
		}
		?>
		<q><?= trim($display_buffer[0]) ?></q>
	</p>
	<p class="reviewer">
		<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
		<?= trim($display_buffer[2]) ?> <br>
		<?= trim($display_buffer[3]) ?>
	</p>
<?php
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Rancid Tomatoes</title>
	<link rel="icon" type="image/x-icon" href="https://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="movie.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div id="heading">
		<img id="header" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes">
	</div>
	<h1><?= strtoupper($title) . "(" . trim($year) . ")" ?></h1>
	<div id="content">
		<div id="poster">
			<img src="<?= "./moviefiles/" . $movie . "/overview.png" ?>" alt="general overview">
		</div>
		<div id="info">
			<dl>
				<?php
				$overview = file("./moviefiles/" . "$movie" . "/overview.txt");
				foreach ($overview as $ln) {
					$key = substr($ln, 0, strpos($ln, ":"));
					$value = substr($ln, strpos($ln, ":") + 1);
					$list[$key] = $value;
				}
				foreach ($list as $info => $content) {
				?>
					<dt><?= $info ?></dt>
					<?php
					if ($info != "STARRING") {
					?>
						<dd><?= trim($content) ?></dd>
						<?php
					} else {
						$cast = explode(",", $content);
						foreach ($cast as $cast) {
						?><dd> <?= trim($cast) ?> </dd><?php
													}
												}
											}
														?>
			</dl>
		</div>
		<div id="banner">
			<?php if ($score < 60) { ?>
				<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rottenbig.png" alt="Rotten">
			<?php } else { ?>
				<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/freshbig.png" alt="Fresh">
			<?php } ?>
			<span><?= $score ?>%</span>
			<?php
				$files = glob("./moviefiles/" . $movie . "/review*.txt");
				if (count($files) <= 10) $display_num = count($files);
				else $display_num = 10;
			?>
		</div>
		<div id="reviews">
			<?php
				$i=1;
			?>
			<div id="left">
				<?php
					while($i <= round($display_num/2)){
						$display_buffer = file($files[$i - 1]);
						manage_review($display_buffer);
						$i++;
					}
				?>
			</div>
			<div id="right">
				<?php
					while($i <= $display_num){
						$display_buffer = file($files[$i - 1]);
						manage_review($display_buffer);
						$i++;
					}
				?>
			</div>
		</div>

	<p id="bottom">(1- <?= $display_num ?>) of <?= count($files) ?></p>
	</div>
	<div id="valid">
		<p>
			<a href="http://validator.w3.org/check/referer"><img width="88" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png" alt="Valid HTML5!"></a>
		<p> <br>
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!"></a>
	</div>
</body>

</html>
