<!--
Name: Alexander Gebhardt
Klasse: ITA2a
-->
<html>
<head>
	<meta charset="utf-8">
    <title>Währungsrechner</title>
    
    <!-- CSS (Nicht beachten, ist nur zum aussehen!)-->
    
	<style>
	/* Header */
	.titel{
	}

	/* Boxen */
	.main_box{
        margin: auto;
        background-color: #FF0000;   
        padding: 5%;
    }
    
    .form_box{
        margin-left: 0%;
        background-color: #00FF00;
        width: 50%;
        height: 50%;
        border-radius: 50px 50px 50px 50px;
        padding-top: 25px;
        padding-bottom: -50px;
    }
    
    .eingabe{
        margin-top: 10px;
        margin-bottom: 10px;
    }

	/* "Rechnen" Button */
	.button {
	margin-top: 10px;
    margin-bottom: 10px;
  	display: inline-block;
  	border-radius: 5px;
  	background-color: #00FFFF;
 	border: none;
 	color: Black;
 	text-align: center;
 	font-size: 14px;
	font-weight: 650;
  	padding: 10px;
  	width: 100px;
  	transition: all 0.5s;
  	cursor: pointer;
	}

	.button span {
  	cursor: pointer;
  	display: inline-block;
  	position: relative;
  	transition: 0.5s;
	}

	.button span:after {
  	content: '»';
  	position: absolute;
  	opacity: 0;
  	top: 0;
  	right: -20px;
  	transition: 0.5s;
	}

	.button:hover span {
  	padding-right: 25px;
	}

	.button:hover span:after {
  	opacity: 1;
  	right: 10;
	}
	</style>
</head>

<body>
		<!-- PHP Code -->
<?php

if(isset($_POST['submit'])){ 		// Wenn submit(rechnen button) nochnie gedrückt wurde ,soll folgendes passieren. 
									// Ansonsten -> nix (Wichtig sonst kommen am Anfang Error Meldungen weils 'keine Variablen' gibt. 
$eingabe1 = $_POST['eingabe1'];		// Variable 'Eingabe1' soll den Value (die Eingabe) aus dem Input 'Eingabe1' beziehen.
$eingabe2 = $_POST['eingabe2'];     // Wie eingabe1..
$ausgabe = $_POST['ausgabe'];		// Wie eingabe1..
$fahrzeug = $_POST['fahrzeug'];		// Variable 'Fahrzeug' greift auf die Radiobuttons mit namen 'fahrzeug' zu.. in dem fall haben wir zwei values '1' & '2'.

if(!$eingabe1 || !$eingabe2){		// Javascript der ne AlertBox ausgibt wenn eingabe1 oder eingabe2 fehlt bzw. nichts eingegeben wurde..
echo '<script type="text/javascript" language="Javascript">
alert("Bitte alle Felder ausfüllen!")
</script> ';
}

$fahrzeuganzahl = ceil($eingabe2/4);	// Variable Fahrzeuganzahl ist Gerundet Eingabe2(Personen) durch 4. Also mehr als 4 Personen -> 2 Autos , mehr als 8 Personen -> 3 Autos etc.
										// Halt die Funtkionen die komplett rundet..
if ($fahrzeug == 1){					// 1.Prüfung | Wenn Variable 'Fahrzeug' (Radio Buttons) = Value 1 hat (Erste Optionen 'Auto').
    if ($fahrzeuganzahl == 1){			// 2.Prüfung | Braucht man 1 Fahrzeug also weniger als 4 Personen?
        $treibstoffkosten = $eingabe1*0.09375;		// Rechnung für die Treibstoff kosten.
        $ausgabe = $treibstoffkosten . '&euro;';	// Die ausgabe (Damit die Zahl ein '€' - Zeichen am Ende hat.  
    }
    else if ($fahrzeuganzahl > 1){		// 3.Prüfung | Braucht man --> mehr <-- als 1 Fahrzeug also mehr als 4 Personen?
      $treibstoffkosten = ($eingabe1*0.09375)*$fahrzeuganzahl;	// Rechnung für die Treibstoff kosten * die anzahl der fahrzeuge.
      $ausgabe = round($treibstoffkosten, 2) . '&euro;'; 		// Die ausgabe (Damit die Zahl ein '€' - Zeichen am Ende hat. Und die Kosten werden auf zwei nachkomma Stellen gerundet.
	  															// Der punkt ist wie bei Javascript, C# etc. das "+". 
	}
}
else if($fahrzeug == 2){				// 1.Prüfung | Wenn Variable 'Fahrzeug' (Radio Buttons) = Value 2 hat (Zweite Optionen 'Kleinbus').
    if ($fahrzeuganzahl == 1){			// Oben erklärt
        $treibstoffkosten = $eingabe1*0.15;	// *0.15 ,weil die kosten für den Bus anders sind.
        $ausgabe = $treibstoffkosten . '&euro;';	// Oben erklärt
    }
    else if ($fahrzeuganzahl > 1){		// Oben erklärt
      $treibstoffkosten = ($eingabe1*0.15)*$fahrzeuganzahl;	// Oben erklärt
      $ausgabe = round($treibstoffkosten, 2) . '&euro;';	// Oben erklärt
    }
}



}
?>
<div class="main_box">

        <center>
    <div class="form_box">
        <form action="fahrtkosten.php" method="post">

        Fahrkostenrechner<br />
        Strecke<br />
        
        <!-- Erstes Input feld mit Namen eingabe1 -->
        
        <input class="eingabe" placeholder="in KM..." type="text" value="" name="eingabe1" autofocus/><br />
        Personen <br />
        
        <!-- Zweites Input feld mit Namen eingabe2 -->
        
        <input class="eingabe" type="text" value="" name="eingabe2"/><br />
        
        <!-- Radio Buttons mit Value 1 und 2 (selber Name weil man ja zwischen beiden unterscheiden will -->
        
        <input type="radio" name="fahrzeug" value="1" checked="checked" /> Auto <br />
        <input type="radio" name="fahrzeug" value="2"/> Kleinbus <br />
    
    	<!-- Der 'submit' button , kann man auch anders benutzen -->
    
        <button class="button" style="vertical-align:middle" type="submit" name="submit"><span>Rechnen </span></button> <br />
        Kosten <br />
        
        <!-- Wenn eingabe1 nichts drinnen steht soll nichts ausgegeben werden, andernfalls die Variable 'ausgabe' (siehe oben)-->
        <!-- Readonly ist da ,damit man die Input box nicht bearbeiten kann. -->
        <!-- Placeholder ist diese graue schrift die am anfang da steht. -->
        
        <input class="eingabe" placeholder="&euro;" type="text" value="<?php if (isset($_POST['eingabe1'])) echo $ausgabe; ?>" name="ausgabe" readonly /><br />

        </form>
    </div>
        </center>
</div>

</body>
</html>