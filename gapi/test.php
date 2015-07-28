<?php
use JakubPas\Gapi;

$url = 'http://Url.of.page.under.analysis.net';
$ga = new Gapi('eamail@domain.com', 'password');
$filter = 'pagePath == ' . $url;
$startDate = date("Y-m-d", 0);
$endDate = date("Y-m-d");

try {
    $ga->requestReportData(
        943763,
        array('pagePath'),
        array('pageviews'),
        null,
        $filter,
        $startDate,
        $endDate,
        1,
        2000
    );
    $pageViews = $ga->getMetrics()['pageviews'];
} catch (Exception $e) {
    $pageViews = 0;
}

echo $pageViews;