<?php
    session_start();

    function top_module($pageTitle) {
        $html = <<<"OUTPUT"
        <!DOCTYPE html>
        <html>
            <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="author" content="Murray Lowis">
            <title>$pageTitle</title>
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

            <nav>
                <ul>
                    <li><a href="#0">FOREWORD</a>
                    <li><button class="button collapsible">1914</button>
                        <div class="collapsibleContent">
                            <ul>
                                <li><a href="#1">Post card - August 24th</a></li>
                                <li><a href="#2">Post card - October 23rd</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><button class="button collapsible">1915</button>
                        <div class="collapsibleContent">
                            <ul>
                                <li><a href="#3">An account of Gallipoli - May 4th</a></li>
                                <li><a href="#4">Postcard to Dad - July 21st</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><button class="button collapsible">1916</button>
                        <div class="collapsibleContent">
                            <ul>
                                <li><a href="#5">The "Big Push" - July 30th</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><button class="button collapsible">1917</button>
                        <div class="collapsibleContent">
                            <ul>
                                <li><a href="#6">Getting wounded again - November 1st</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><button class="button collapsible">1918</button>
                        <div class="collapsibleContent">
                            <ul>
                                <li><a href="#7">Letter to mother - February 8th</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#form">CONTACT ME</a></li>
                </ul>
            <img class="floatLeft" src='../../media/Douglas Raymond Baker portrait.jpg' alt='Portait of Douglas Baker' id="portrait">
            </nav>

            <main>        
    OUTPUT;
        echo $html;
    }

 //sanitise this VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
    function end_module() {
        $html = <<<"OUTPUT"
        </main>

            <footer>
                <div>&copy;<script>document.write(new Date().getFullYear());</script>
                    <noscript>2020</noscript>
                    Murray Lowis, S3862651. Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.<br>
                    <a href="https://github.com/MurrayLowisRMIT/wp/tree/main/a2">https://github.com/MurrayLowisRMIT/wp/tree/main/a2</a>
                </div>
                <div>
                    Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.
                </div>
                <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
            </footer>
            <script src="tools.js"></script>        
        </body>
    </html>
    OUTPUT;
        echo $html;
    }

?>