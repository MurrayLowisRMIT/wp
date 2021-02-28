<?php
    session_start();
    require_once('tools.php');
    topModule();
?>

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

<?= articleBuilder(
    $lettersArray[$currentArticle][DateStart],
    $lettersArray[$currentArticle][DateEnd],
    $lettersArray[$currentArticle][Type],
    $lettersArray[$currentArticle][Town],
    $lettersArray[$currentArticle][Country],
    $lettersArray[$currentArticle][Transport],
    $lettersArray[$currentArticle][Battle],
    $lettersArray[$currentArticle][Content]
); ?>


<article id="form">
    <div class="articleHeader">
        <h2 class="basic">Contact Me</h2>
    </div>
    <form action="https://titan.csit.rmit.edu.au/~e54061/wp/testcontact.php" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email">
        <label for="mobile">Mobile</label>
        <input type="subject" id="mobile" name="mobile" placeholder="Mobile">
        <label for="subject">Subject</label>
        <input type="message" id="subject" name="subject" placeholder="Subject">
        <label class="messageField" for="message">Message</label>
        <textarea class="messageField basic" id="message" name="message" cols='80' rows='9'></textarea>
        <input class="checkBox" type="checkbox" id="remember-me" name="remember-me">
        <label class="checkBoxLabel" for="remember-me">Remember me</label>
        <input type="submit" name="send" value="Submit">
    </form>
</article>
<?= endModule(); ?>