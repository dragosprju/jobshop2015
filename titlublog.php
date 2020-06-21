<?php
function xTimeAgo($datetime)
{
    $time_ago = strtotime($datetime);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "in acest moment";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "acum un minut";
        }
        else{
            return "acum " . $minutes . " minute";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "acum o oră";
        }else{
            return "acum " . $hours . " ore";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "ieri";
        }else{
            return "acum " . $days . " zile";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "acum o săptămână";
        }else{
            return "acum " . $weeks . " săptămâni";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "acum o lună";
        }else{
            return "acum " . $months . " luni";
        }
    }
    //Years
    else{
        if($years==1){
            return "acum un an";
        }else{
            return "acum " . $years .  " ani";
        }
    }
}

	$rss = new DOMDocument();
	$rss->load('https://iasi.jobshop.ro/blog/?feed=rss2');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
	$limit = 1;
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$date = date('Y-m-d H:i:s', strtotime($feed[$x]['date']));
		echo '<b><a href="'.$link.'" title="'.$title.'" class="titlublog">'.$title.'</a></b> ';
		echo '(' . xTimeAgo($date) . ')';
	}
?>