# camt2csv

[![Project Status: WIP – Initial development is in progress, but there has not yet been a stable, usable release suitable for the public.](https://www.repostatus.org/badges/latest/wip.svg)](https://www.repostatus.org/#wip)

PHP script to convert camt.053 files to CSV files intended for [Firefly III](https://www.firefly-iii.org)

Used as a stop-gap measure until Firefly III data importer [can import cam.053 files](https://github.com/firefly-iii/firefly-iii/issues/5098) directly.

## Usage

`php camt2csv.php <input_file|input_directory>`

Converts the file or all `.xml` files in a directory to csv. Writes output files in the same directory, overwriting existing files.

## Installation

`composer install`

## Links

- [camt0.53 Swiss Implementation Guidelines](https://www.six-group.com/dam/download/banking-services/interbank-clearing/en/standardization/iso/swiss-recommendations/implementation-guidelines-camt.pdf)
- [Firefly III Data Importer column roles](https://docs.firefly-iii.org/data-importer/usage/roles/#roles)

## License

MIT.

## Credits

- Uses the [genkgo/camt](https://github.com/genkgo/camt) parser.

## Author

Christian Studer, [Bureau für digitale Existenz](https://bureau.existenz.ch)
