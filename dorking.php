<?php

print "
                                              
 _____ _            ____  ___     _           
| __  |_|___ ___   |    \|   |___| |_ ___ ___ 
| __ -| |   | . |  |  |  | | |  _| '_| -_|  _|
|_____|_|_|_|_  |  |____/|___|_| |_,_|___|_|  
            |___|                             

          		Thx to: Mr.MaGnoM
     Auto Dorking by 4WSec - Anon Cyber Team
";

//Usage: php script.php

function getsource($url, $proxy) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if ($proxy) {
        $proxy = explode(':', autoprox());
        curl_setopt($curl, CURLOPT_PROXY, $proxy[0]);
        curl_setopt($curl, CURLOPT_PROXYPORT, $proxy[1]);
    }
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}

echo "\n\t Input Dork: ";$dork=trim(fgets(STDIN,1024));
$do=urlencode($dork);
        //$ip="xxx.xxx.xxx.xxx";
        $npage = 1;
        $npages = 30000;
        $allLinks = array();
        $lll = array();
        while($npage <= $npages) {
            $x = getsource("http://www.bing.com/search?q=".$do."&first=" . $npage."&FORM=PERE4", $proxy);
            if ($x) {
                preg_match_all('#<h2><a href="(.*?)" h="ID#', $x, $findlink);
                foreach ($findlink[1] as $fl) array_push($allLinks, $fl);
                $npage = $npage + 10;
                if (preg_match("(first=" . $npage . "&amp)siU", $x, $linksuiv) == 0) break;
            } else break;
        }
        $URLs = array();
        foreach($allLinks as $url){
            $exp = explode("/", $url);
            $URLs[] = $exp[2];
        }
        $array = array_filter($URLs);
        $array = array_unique($array);
        $act=count(array_unique($array));
		echo"\nSite: ". $act.'';

        foreach ($array as $domain) {

            echo"\nhttp://".$domain.'/';

        }
?>
