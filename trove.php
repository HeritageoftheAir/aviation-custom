

<?PHP 

$baseurl = "http://api.trove.nla.gov.au/result?encoding=json&l-australian=y&include=holdings";

$query = urlencode($_GET['query']); 

$apikey ='vl6ahuf5l47j4vaq';

$uri = $baseurl .'&q='. $query . '&key=' . $apikey;   

echo file_get_contents($uri); 
//echo (urldecode($_GET['request'] . $ apikey));

?>