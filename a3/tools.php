<?php

function topModule() {
    $html = <<<"OUTPUT"
    <!DOCTYPE html>
    <html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Murray Lowis">
        <title>ANZAC Douglas Raymond Baker Letters Home</title>
        <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
        <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
        <link rel="icon" href="../../media/ANZAC Crest.png" type="image/x-icon">
        <script type="text/javascript" src="tools.js"></script>
        <script src='../wireframe.js'></script>
    </head>

    <body>
        <header  id="0">
            <!--Original image sourced for educational purposes:
            https://ranzcrarchivesblog.wordpress.com/2015/04/13/anzac-images-radiology-at-gallipoli/-->
            <img class="floatLeft headerimg" src='../../media/ANZAC Crest.png' alt='ANZAC crest'>
            <img class="floatRight headerimg" src='../../media/ANZAC Crest.png' alt='ANZAC crest'>
            <H1>ANZAC Douglas Raymond Baker<br><small>Letters Home</small></H1>
        </header>
OUTPUT;
    echo $html;
    navModule();
}

function endModule() {
    global $_SERVER;
    
    echo "</main>

            <footer>
                <div>&copy;<script>document.write(new Date().getFullYear());</script>
                    <noscript>2020</noscript>
                    Murray Lowis, S3862651. Last modified ";

    date("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME']));

    echo "          <br>
                    <a href=\"https://github.com/MurrayLowisRMIT/wp/tree/main/a2\">https://github.com/MurrayLowisRMIT/wp/tree/main/a3</a>
                </div>
                <div>
                    Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.
                </div>
                <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
            </footer>
            <script src=\"tools.js\"></script>
        </body>
    </html>";
}

$currentArticle = "foreword";
$currentArticle = $_POST["articleID"];

//change 'fopen()' to actual address when setup complete -> "/home/eh1/e54061/public_html/wp/letters-home.txt"!!!
if (($lettersCSV = fopen("letters-home.txt", "r")) && flock($lettersCSV, LOCK_SH) !== false) {
    $headings = fgetcsv($lettersCSV, 0, "\t");
    while(($line = fgetcsv($lettersCSV, 0, "\t")) !== false) {
        $lineAssociative = array_combine($headings, $line);
        $lettersArray[] = $lineAssociative;
    }
    flock($lettersCSV, LOCK_UN);
    fclose($lettersCSV);}
else { echo "File unavailable, my disappointment is immeasurable and my day is ruined";
}

function navModule() {
    global $lettersArray;
    foreach($lettersArray as $line) {
        
        $year = substr($line[DateStart], 0, 4);
        if(!in_array($year, $years)) {
            $years[] = $year;
        }
        sort($years);
        
        if(!empty($line[Battle])) {
            $articleKey[] = [$year,$line[Battle]." - ".substr($line[DateStart], 5, 5)];
        } else {
            $articleKey[] = [$year,$line[Type]." - ".substr($line[DateStart], 5, 5)];
        }        
    }

    echo "<nav>
        <ul>
            <form method=\"post\">
                <li><input type=\"submit\" name=\"articleID\" value=\"Foreword\"/></li>
            </form>";
            foreach($years as $value) {
                echo "<li><button class=\"button collapsible\">".$value."</button>
                    <div class=\"collapsibleContent\">
                        <form method=\"post\">
                            <ul>";
                            foreach($articleKey as $line) {
                                if ($line[0] === $value) {
                                    echo "<li><input type=\"submit\" name=\"articleID\" value=\"".$line[1]."\"/></li>";
                                }
                            }
                            echo "</ul>
                        </form>
                    </div>
                </li>";
            }
            echo "</ul>
            <img class=\"floatLeft\" src='../../media/Douglas Raymond Baker portrait.jpg' alt='Portait of Douglas Baker' id=\"portrait\">
        </nav>

        <main>";
}
echo $lettersArray[0][DateStart];

/*function articleBuilder($currentArticle) {
    $contentFormatted = str_replace("\n", "</p><p>", $lettersArray[$articleID][Content]);
    $html = <<<"OUTPUT"
                <article>
                    <div class="articleHeader">
                        <h2>$lettersArray[$articleID][Battle]</h2>
                        <h3>$lettersArray[$articleID][Town], $lettersArray[$articleID][Country] - $lettersArray[$articleID][DateStart]</h3>
                    </div>
                    <div class="$lettersArray[$articleID][Type]">
                        <div>$lettersArray[$articleID][Type] placeholder cover text</div>
                        <div><p>$contentFormatted</p></div>
                    </div>
                </article>
OUTPUT;
    echo $html;
    //echo "<p>test".$lettersArray[$articleID]."</p>";
}*/

function articleBuilder($dateStart, $dateEnd, $type, $town, $country, $transport, $battle, $content) {
    $contentFormatted = str_replace("\n", "</p><p>", $content);
    $html = <<<"OUTPUT"
                <article>
                    <div class="articleHeader">
                        <h2>$battle</h2>
                        <h3>$town, $country - $dateStart</h3>
                    </div>
                    <div class="$type">
                        <div>$type placeholder cover text</div>
                        <div><p>$contentFormatted</p></div>
                    </div>
                </article>
OUTPUT;
    echo $html;
}

?>