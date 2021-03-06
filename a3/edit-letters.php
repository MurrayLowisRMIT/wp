<?php
if(!isset($_COOKIE["logIn"])) {
    header("Location: index.php");
} else {
    require_once('post-validation.php');
    require_once('tools.php');
    topModule();
    loginModule();

    echo "<main>
            <article>
                <div class=\"articleHeader\">
                    <h2>Edit letters page - Under construction</h2>
                </div>

                <div class=\"loginForm\">";
                    echo "<form action=\"post-validation.php\" method=\"POST\">
                        <input type=\"submit\" name=\"back\" value=\"Back\">
                    </form>
                </div>
            </article>";

    endModule();
}
?>