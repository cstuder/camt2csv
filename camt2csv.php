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

// Configuration
$headers = [
    'Date', // Value Date
    'Description', // Additional Information / Remittance Information 
    'Asset Account', // Account IBAN
    'Opposing Account', // Related party account IBAN or identification
    'Amount', // Amount
    'Foreign currency code', // Currency code
    'Transaction booking date', // Booking Date
    'External ID', // Account Servicer Reference
];

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

    fputcsv($output, $headers);

    $statements = $reader->readFile($file)->getRecords();
    foreach ($statements as $statement) {
        foreach ($statement->getEntries() as $entry) {

            $record = [];

            // Date
            $record[] = $entry->getValueDate()->format('Y-m-d');

            // Description
            $record[] = $entry->getAdditionalInfo();

            // Asset Account
            $record[] = $statement->getAccount()->getIdentification();

            // Opposing Account
            $record[] = $entry->getTransactionDetail()->getRelatedParty()->getAccount()->getIdentification();

            // Amount
            $record[] = $entry->getAmount()->getAmount();

            // Foreign currency code
            $record[] = $entry->getAmount()->getCurrency();

            // Transaction booking date
            $record[] = $entry->getBookingDate()->format('Y-m-d');

            // External ID
            $record[] = $entry->getAccountServicerReference();

            fputcsv($output, $record);
        }
    }

    fclose($output);
}

// Done.
echo "Done.\n";
