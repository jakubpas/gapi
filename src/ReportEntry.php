<?php

namespace JakubPas\Gapi;

use Exception;

/**
 * Class GapiReportEntry
 * Storage for individual API report entries
 * @author Jakub Pas
 * @package DarkPlanet\Google
 */
class ReportEntry {

    private $metrics = array();
    private $dimensions = array();

    public function __construct($metrics, $dimensions)
    {
        $this->metrics = $metrics;
        $this->dimensions = $dimensions;
    }

    /**
     * toString function to return the name of the result this is a concatenated string of the dimensions chosen
     * For example: 'Firefox 3.0.10' from browser and browserVersion
     * @return string
     */
    public function __toString()
    {
        if (is_array($this->dimensions)) {
            return implode(' ', $this->dimensions);
        } else {
            return '';
        }
    }

    /**
     * Get an associative array of the dimensions and the matching values for the current result
     * @return array
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Get an array of the metrics and the matching values for the current result
     * @return Array
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * Call method to find a matching metric or dimension to return
     * @param $name String name of function called
     * @param array $parameters
     * @return String
     * @throws Exception if not a valid metric or dimensions, or not a 'get' function
     */
    public function __call($name, $parameters)
    {
        if (!preg_match('/^get/', $name)) {
            throw new Exception('No such function "' . $name . '"');
        }
        $name = preg_replace('/^get/', '', $name);
        $metric_key = Connector::array_key_exists_nc($name, $this->metrics);
        if ($metric_key) {
            return $this->metrics[$metric_key];
        }
        $dimension_key = Connector::array_key_exists_nc($name, $this->dimensions);
        if ($dimension_key) {
            return $this->dimensions[$dimension_key];
        }
        throw new Exception('No valid metric or dimension called "' . $name . '"');
    }
}