# camt2csv

[![Project Status: WIP – Initial development is in progress, but there has not yet been a stable, usable release suitable for the public.](https://www.repostatus.org/badges/latest/wip.svg)](https://www.repostatus.org/#wip)

PHP script to convert camt.053 files to CSV files intended for [Firefly III](https://www.firefly-iii.org)

Used as a stop-gap measure until Firefly III data importer [can import cam.053 files](https://github.com/firefly-iii/firefly-iii/issues/5098) directly.

## Usage

`php camt2csv.php filename|directory`

Converts the file or all `.xml` files in a directory to csv. Writes output files in the same directory, overwriting existing files.

## Installation

`composer install`

## License

MIT.

## Credits

- Uses the [genkgo/camt](https://github.com/genkgo/camt) parser.

## Author

Christian Studer, [Bureau für digitale Existenz](https://bureau.existenz.ch)
