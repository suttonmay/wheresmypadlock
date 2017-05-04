<html>
<head>
  <link rel="stylesheet" href="css/results.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <title>Results</title>
</head>
<body>
<div class="container">
<div class="row" id="header">
<?php
$url = $_POST['url'];

echo "<h2 class='col-sm-3'>Showing results for</h2><form method='post' action='results.php'><div class='form-group'><input name='url' id='url' class='form-control col-sm-3' type='text' placeholder=$url/><input name='submit' type='submit' class='btn btn-primary col-sm-1' id='submit' value='Submit'/>";
?>
</div>
</form>
</div>
</div>
<div class="ellipsis">
<div class="container" id="tableContain">
<table class='table'>
<th>Link Name</th><th>URL</th>
<?php
;# Use the Curl extension to query the site and get back a page of results
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CERTINFO, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

$html = curl_exec($ch);
curl_close($ch);

# Create a DOM parser object
$dom = new DOMDocument();

# Parse the HTML from the url.
# The @ before the method call suppresses any warnings that
# The @ before the method call suppresses any warnings that
# loadHTML might throw because of invalid HTML in the page.
@$dom->loadHTML($html);


# Iterate over all the <a> tags
foreach($dom->getElementsByTagName('a') as $link) {
        # Show the <a href>
        $href = $link->getAttribute('href');
        $linkValue = $link->nodeValue;
        if (strlen(trim($href)) == 0) {
        }
        elseif (substr($href, 0, 1) === '/') {
        }
        elseif (substr($href, 0, 1) === '#') {
        }
        elseif (strpos($href, 'https://') === false) {
                echo "<tr>";
                echo "<td class='linkValue'>$linkValue</td>";
                echo "<td class='href'>$href</td>";
                echo"</tr>";
        }
}

foreach($dom->getElementsByTagName('img') as $node) {
        $src = $node->getAttribute('src');
        $nodeValue = $node->nodeValue;
        if (strlen(trim($src)) == 0) {
                }
        elseif (substr($src, 0, 1) === '/') {
                }
        elseif (strpos($src, 'https://') === false) {
                echo "<tr>";
                echo "<td class='nodeValue'><img src='$src' class='srcValue'/></td>";
                echo "<td class='src'>$src</td>";
                echo"</tr>";
        }
    }

foreach($dom->getElementsByTagName('script') as $script) {
        $scriptsrc = $script->getAttribute('src');
        $scriptValue = $script->nodeValue;
        if (strlen(trim($scriptsrc)) == 0) {
                }
        elseif (substr($scriptsrc, 0, 1) === '/') {
                }
        elseif (strpos($scriptsrc, 'https://') === false) {
        echo "<tr>";
                echo "<td class='scriptValue'>$scriptValue</td>";
                echo "<td class='scriptsrc'>$scriptsrc</td>";
                echo"</tr>";
        }
    }
?>
</table>
</div>
</div>
</body
</html>
