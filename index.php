<!--Projekt: Kalkulator CRC-->
<!DOCTYPE html>
<html>
<title>Crc calculator</title>
<meta charset="utf-8">

<body>
	<!--Informacja o projekcie-->
	<h1>Crc calculator PHP</h1>
	<h2>Autor: Nazarii Diadyk </h2>
	<h3>Grupa: AiSM</h3>
	<hr>
	<h4>Kod zródlowy jest umieściony na stronie GitHub-----></h4>
	<a href="https://github.com/ZeroGravity2208">Github</a>
	<br>
	<?php
	$input_file = fopen("plik1.txt", "r")
		or die("Can`t open this file!");
	$output_file = fopen("plik2.txt", "a");
	while (1 > 0) {
		$all_data = fread($input_file, 15); #15 symbols for each blocks
		$crc = crc32($all_data);
		$crc = dechex($crc); #dechex = Decimal to hexadecimal
		#sprawdzamy zawartosc pliku
		if ($all_data == "") {
			break;
		}
		echo "<br>"; #breakline for blocks
		echo $all_data . " ; " . $crc;

		fwrite($output_file, $all_data . ";" . $crc . ";" . PHP_EOL); #PHP_EOL = '\n'
	}
	fclose($output_file);
	$output_file = fopen("plik2.txt", "r")
		or die("Can`t open this file!");

	echo "<br>";
	echo "<br>";

	$text = "Origin text: ";
	#taka sama operacja dla sprawdzenia w zadaniu nr2
	#porównanie wartości pliku
	while (1 > 0) {
		$read = fgets($output_file);
		$read = explode(";", $read);

		if ($read[0] == '') {
			break;
		}

		$text .= $read[0];

		echo $read[0] . " ; " . $read[1] . " ; " . dechex(crc32($read[0]));
		echo "<br>";

		if ($read[1] != dechex(crc32($read[0]))) {
			echo "Error!";
			break;
		}
	}
	#zamykamy pliki
	fclose($input_file);
	fclose($output_file);

	echo "<br>";
	echo $text;

	echo "<br>";
	echo "<br>";
	echo "<br>";
	?>
</body>
<footer>All files are saved in parent folder.</footer>
</html>