## Synopsis

GAPI is an update version of Google Analytics PHP Interface. The Classes files are separated and the code formatting updated. There composer-based auto-loading mechanism was introduced.
The package utilizes deprecated since 2013 authorisation mechanism (login and password). However it is still supported by google.

## Code Example

Get views of given page since beginning to the current date
```
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
```

## Motivation

The idea of this package is to add composer auto-loader functionality to GAPI code and make it PHP>5.4 compatible. There also some minor bug fixes since the original version.

## Installation

composer require jakubpas/gapi

## API Reference

The API Reference are yet to be added.

## Tests

The test are yet to be added.

## Contributors

Jakub Pas 2015
Stig Manning 2009

## License

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
