<?php
error_reporting(0);

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
        <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t= filemtime("style.css"); ?>
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
            <h1>ANZAC Douglas Raymond Baker</h1>
        </header>
OUTPUT;
    echo $html;
}

function endModule() {
    echo "</main>

            <footer>
                <div>&copy;<script>document.write(new Date().getFullYear());</script>
                    <noscript>2020</noscript>
                    Murray Lowis, S3862651. Last modified "
                    .date("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])).
                    "<br>
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

if (($lettersCSV = fopen("/home/eh1/e54061/public_html/wp/letters-home.txt", "r")) && flock($lettersCSV, LOCK_SH) !== false) {
    $headings = fgetcsv($lettersCSV, 0, "\t");
    
    $articleID = 0;
    while(($line = fgetcsv($lettersCSV, 0, "\t")) !== false) {
        $lineAssociative = array_combine($headings, $line);
        $lineAssociative["ArticleID"]=$articleID;
        $lettersArray[] = $lineAssociative;
        $articleID += 1;
    }
    flock($lettersCSV, LOCK_UN);
    fclose($lettersCSV);
} else if (($lettersCSV = fopen("letters-home.txt", "r")) && flock($lettersCSV, LOCK_SH) !== false) {
    //Uses local copy in case file on server is unavailable
    $headings = fgetcsv($lettersCSV, 0, "\t");
    
    $articleID = 0;
    while(($line = fgetcsv($lettersCSV, 0, "\t")) !== false) {
        $lineAssociative = array_combine($headings, $line);
        $lineAssociative["ArticleID"]=$articleID;
        $lettersArray[] = $lineAssociative;
        $articleID += 1;
    }
    flock($lettersCSV, LOCK_UN);
    fclose($lettersCSV);
} else {
    echo "File somehow unavailable. My disappointment is immeasurable and my day is ruined";
}

function loginModule() {    
        echo "<div class=\"login\">
                <form action=\"login.php\" method=\"POST\">";
                if(!empty($_COOKIE["logIn"])) {
                    echo "<input type=\"submit\" name=\"logOff\" value=\"Sign out\"><br>
                        <input type=\"submit\" name=\"editLetters\" value=\"Edit letters\">";
                } else {
                    echo "<input type=\"submit\" value=\"Sign in\">";
                }
            echo "</form>
        </div>";
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
            $articleKey[] = [$year, $line[Battle]." - ".substr($line[DateStart], 5, 5), $line[ArticleID]];
        } else {
            $articleKey[] = [$year, $line[Type]." - ".substr($line[DateStart], 5, 5), $line[ArticleID]];
        }
    }
    
    echo "<nav>
        <ul>
            <form method=\"GET\">
                <li><input type=\"submit\" name=\"articleID\" value=\"Foreword\"/></li>
            </form>";
            foreach($years as $value) {
                 echo "<li><button class=\"button collapsible\">".$value."</button>
                    <div class=\"collapsibleContent\">
                        <form method=\"GET\">
                            <ul>";
                            unset($line);
                            foreach($lettersArray as $line) {
                                if (substr($line[DateStart], 0, 4) === $value) {
                                    echo "<li><input type=\"submit\" name=\"articleID\" value=\"";
                                    if(!empty($line[Battle])) {
                                         echo $line[Battle];
                                    } else {
                                         echo $line[Type];
                                    } echo " - ".$line[DateStart]."\"/></li>";
                                }
                            }
                            echo "</ul>
                        </form>
                    </div>
                </li>";
            }
            echo "<form method=\"GET\">
                <li><input type=\"submit\" name=\"articleID\" value=\"Contact me\"/></li>
            </form>
            </ul>
            <img class=\"floatLeft\" src='../../media/Douglas Raymond Baker portrait.jpg' alt='Portait of Douglas Baker' id=\"portrait\">
        </nav>

        <main>";
}

function articleBuilder() {
    global $lettersArray;
    global $formData;
    global $errors;
    
    foreach($lettersArray as $line) {
        $year = substr($line[DateStart], 0, 4);
        if(!in_array($year, $years)) {
            $years[] = $year;
        }
    }

    if ($_GET["articleID"] === "Foreword" or empty($_GET["articleID"])) {
        $html = <<<"OUTPUT"
        <article class="foreword">
            <div class="articleHeader">
                <h2 class="basic">Foreword</h2>
            </div>
            <p>Hello and welcome,
            </p><p>This year is the centenary of the birth of the ANZAC legend. As such, many people, particularly young people, are looking for ways to connect with people of that period, in particular those who created the ANZAC legend.
            </p><p>This site presents the letters of Douglas Raymond Baker, who came from Gympie, Queensland, Australia. He enlisted in August 1914 and during the years that followed, he wrote letters and post cards to his family at home. In them, he describes much of the goings-on of the life of an ANZAC, his feelings and opinions, and experiences while visiting his relatives in England during leave.
            </p><p>They start from the beginning of basic training in Brisbane in August 1914 and end in May 1918.
            </p><p>They are offered here so that others may get an understanding of life as an ANZAC and get a sense of what life on the battlefield was like.
            </p><p>These are copies of letters written by my father Douglas Raymond Baker during the First World War (1914-1918) to his family in Gympie. I have three thick exercise books in which the letters were copied in handwriting by my Aunt Alice, his sister. I understand that this was done so his letters could be sent on to other members of the family. I don’t know if the originals are still in existence, probably not.
            </p><p>In the early letters Alice has not included the name of the person they were written to but later she writes at the beginning, “Letter to Dot”, “Letter to Mother”, etc. and later still copies the original, “Dear Al”, “Dear Mag”, etc. Likewise the endings are often not laid out fully as we would do but Al may have done this or Dad may have been saving space on the page.
            </p><p>Some letters are slightly out of date order in the books but as most of these are around the time his father died I have put them in the correct order as this is crucial to understanding the sense of the contents.  A lot will be missing – many, many ships were sunk but thanks to Aunt Alice we have these copies of the ones that did get through.
            </p><p>Where Dad used brackets in a letter I have used [ ] style and where I have made any comment or explanation I have used ( ) and Italics.
            </p><p>Where he uses the word “gay” it is used in the true sense, bright, happy, carefree, etc. This is the original meaning of the word before it became associated with the homosexual community.
            </p><p>The amounts of money are, of course, in Pounds, shillings and pence but as these are out of date and we have no pound sign in the computer I have written them in, sometimes showing the decimal equivalents. One Pound equalled $2, one shilling equalled 10 cents and one penny equalled a little under one cent. After a while I stopped putting the equivalents in as they had no significance unless you knew the relative cost of things then and now. A shilling – equivalent to ten cents might actually buy ten or twenty dollars worth of goods now.
            </p>
        </article>
OUTPUT;
        echo $html;
    } else if ($_GET["articleID"] === "Contact me") {
        echo "<article id=\"form\">
            <div class=\"articleHeader\">
                <h2 class=\"basic\">Contact Me</h2>
            </div>
            <form action=\"post-validation.php\" method=\"POST\">
                <label for=\"name\">Name</label>
                <input type=\"text\" id=\"name\" name=\"name\" placeholder=\"Name\">
                <p class =\"error\">".$errors['name']."</p>
                <label for=\"email\">Email</label>
                <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"Email\">
                <p class =\"error\">".$errors['email']."</p>
                <label for=\"mobile\">Mobile</label>
                <input type=\"subject\" id=\"mobile\" name=\"mobile\" placeholder=\"Mobile\">
                <p class =\"error\">".$errors['mobile']."</p>
                <label for=\"subject\">Subject</label>
                <input type=\"message\" id=\"subject\" name=\"subject\" placeholder=\"Subject\">
                <p class =\"error\">".$errors['subject']."</p>
                <label class=\"messageField\" for=\"message\">Message</label>
                <textarea class=\"messageField basic\" id=\"message\" name=\"message\" cols='80' rows='9'></textarea>
                <p class =\"error\">".$errors['message']."</p>
                <input type=\"submit\" name=\"send\" value=\"Submit\">
            </form>
        </article>";
    } else {
        
        foreach($lettersArray as $key) {
            if ($key[DateStart] == substr($_GET["articleID"],-10)) {
                $articleID = $key[ArticleID];
            }
        }
        
        echo "<article>
                <div class=\"articleHeader\"><h2>";
                    if(!empty($lettersArray[$articleID][Battle])) {
                        echo $lettersArray[$articleID][Battle]."</h2><h3>";
                        if (!empty($lettersArray[$articleID][Country])) {
                            echo $lettersArray[$articleID][Country]." - ";
                        }
                        echo $lettersArray[$articleID][DateStart]."</h3>";
                    } else {
                        if(!empty($lettersArray[$articleID][Town])) {
                            echo $lettersArray[$articleID][Town];
                        } else {
                            echo $lettersArray[$articleID][Type];
                        }
                        if (!empty($lettersArray[$articleID][Country])) {
                            echo ", ".$lettersArray[$articleID][Country];
                        }
                        echo " - ".$lettersArray[$articleID][DateStart]."</h2>";
                    }
                echo "</div>
                <div class=\"".$lettersArray[$articleID][Type]."\">
                    <div></div>
                    <div><p>".str_replace("\n", "</p><p>", $lettersArray[$articleID][Content])."</p></div>";
                        if($lettersArray[$articleID][Type] == 'Letter') {
                            echo "<div></div>";
                        }
                echo "</div>
            </article>";
    }
}

function loginPage() {
    global $formData;
    global $errors;
    
    echo "<main>
        <article>
            <div class=\"articleHeader\">
                <h2>Sign in</h2>
            </div>
            
            <div class=\"loginForm\">";
                echo "<form action=\"post-validation.php\" method=\"POST\" onsubmit=\"return validateForm();\">
                    <label for=\"name\">Name</label>
                    <input type=\"text\" id=\"name\" name=\"name\" placeholder=\"Name\"";
                        if(!empty($formData["name"])) {
                            echo " value=\"".$formData["name"]."\"";
                        } else {
                            echo " value=\"".$_POST["name"]."\"";
                        }
                        echo ">
                    <p class=\"error\" id=\"errorName\"></p>
                    <label for=\"password\">Password</label>
                    <input type=\"text\" id=\"password\" name=\"password\" placeholder=\"Password\"";
                        if(!empty($formData["password"])) {
                            echo " value=\"".$formData["password"]."\"";
                        } else {
                            echo " value=\"".$_POST["password"]."\"";
                        }
                        echo ">
                    <p class=\"error\" id=\"errorPassword\"></p>
                    <label for=\"email\">Email</label>
                    <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"Email\"";
                        if(!empty($formData["email"])) {
                            echo " value=\"".$formData["email"]."\"";
                        } else {
                            echo " value=\"".$_POST["email"]."\"";
                        }
                        echo ">
                    <p class=\"error\" id=\"errorEmail\"></p>
                    <label for=\"mobile\">Mobile</label>
                    <input type=\"text\" id=\"mobile\" name=\"mobile\" placeholder=\"Mobile\"";
                        if(!empty($formData["name"])) {
                            echo " value=\"".$formData["mobile"]."\"";
                        } else {
                            echo " value=\"".$_POST["mobile"]."\"";
                        }
                        echo ">
                    <p class=\"error\" id=\"errorMobile\"></p>
                    <input class=\"checkBox\" type=\"checkbox\" id=\"rememberMe\" name=\"rememberMe\">
                    <label class=\"checkBoxLabel\" for=\"rememberMe\">Remember me</label>
                    <input type=\"submit\" name=\"logIn\" value=\"Log in\">
                </form>
                <form action=\"index.php\">
                    <input type=\"submit\" value=\"Back\">
                </form>
            </div>
        </article>";
}

function contactForm() {
    if(($messages = fopen($filename,"a")) && flock($messages, LOCK_EX) !== false) {
        foreach ($records as $record)
            fputcsv($messages, $record, "\t");
        flock($messages, LOCK_UN);
        fclose($messages);
    }
}

?>