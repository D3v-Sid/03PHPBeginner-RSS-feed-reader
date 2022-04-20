<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <title>RSS Reader</title>
</head>

<body>
    <header class="hero">
        <h1>RSS Reader</h1>
    </header>
    <main class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="url" name="url" placeholder="Your favorite RSS url" autofocus>
            <input type="submit" class="contrast" value="Feed">
        </form>
        <article>
            <?php isset($_POST["url"]) && print(ParseURL($_POST["url"]))?>

        </article>
    </main>


</body>

</html>

<?php 
function ParseURL(string $url )
/** 
 * This function will parse the url passed by user into an XML object.
 * @param  url(string) : the url passed into the form, pointing to a RSS feed.
 * @return  simpleXML object OR false if the URL is not pointing at a RSS feed.
*/
{
    libxml_use_internal_errors(true);
    
    try{
        /* parameters : data, options, dataIsURL,namespace, isPrefix */
        $xml = new SimpleXMLElement($url,0,true);
        $xmlToString = $xml;
        return $xmlToString;
    }
    
    catch(exception $e) { 
        return false;
    }
    
}

?>

<style>
.hero {
    background-color: #394046;
    background-image: url("https://source.unsplash.com/7XRs2HIWLWI/3000x1000");
    background-position: center;
    background-size: cover;
    padding: 1.5rem;
}

h1 {
    color: white;
}
</style>