<?php
require_once 'vendor/autoload.php';

/*
 * camt2csv
 * 
 * PHP script to convert camt.053 files to CSV files intended for Firefly III
 * 
 * @link https://github.com/cstuder/camt2csv
 */

use Genkgo\Camt\Config;
use Genkgo\Camt\Reader;

// Read command line arguments
if (!isset($argv[1])) {
    echo "Usage: php camt2csv.php <input_file|input_directory>\n";
    exit(1);
}

$input = realpath($argv[1]);

// Find files to convert
$files = [];

if (is_dir($input)) {
    $files = glob($input . '/*.xml');
} else {
    $files[] = $input;
}

// Convert files
$reader = new Reader(Config::getDefault());

foreach ($files as $file) {
    echo "Converting {$file}\n";

    $outputfilename = str_replace('.xml', '.csv', $file);
    $output = fopen($outputfilename, 'w');

    $statements = $reader->readFile($file)->getRecords();
    foreach ($statements as $statement) {
        // TODO continue here
        var_dump($statement->getEntries());
    }

    fclose($output);
}

// Done.
echo "Done.\n";
