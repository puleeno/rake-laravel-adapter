# Rake Laravel Adapter

Laravel adapter for [Ramphor Rake](https://github.com/ramphor/rake) - A PHP web crawler and data migration framework.

## Installation

You can install the package via composer:

```
#!bash
composer require puleeno/rake-laravel-adapter
```


The package will automatically register its service provider.

## Database Migrations

The package includes the necessary database migrations. To run them:


```
#!bash
php artisan migrate
```


This will create the following tables:
- `rake_crawled_urls` - Stores URLs to be crawled
- `rake_resources` - Stores crawled resources
- `rake_relations` - Manages relationships between resources
- `rake_options` - Stores Rake configuration options

## Models

The package provides Laravel Eloquent models for all tables:

- `CrawledUrl` - For managing crawl URLs
- `Resource` - For managing crawled resources
- `Option` - For managing Rake options
- `Relation` - Pivot model for resource relationships

Example usage:


```
#!php
use Rake\LaravelAdapter\Models\CrawledUrl;
use Rake\LaravelAdapter\Models\Resource;
use Rake\LaravelAdapter\Models\Option;
// Create new crawl URL
CrawledUrl::create([
'url' => 'https://example.com',
'rake_id' => 'my-rake-id',
'tooth_id' => 'my-tooth-id'
]);
// Get uncrawled URLs
$urls = CrawledUrl::where('crawled', false)->get();
// Get resource with relationships
$resource = Resource::with(['children', 'parents'])->find($id);
```



## Configuration

You can publish the config file with:



```
bash
php artisan vendor:publish --tag="rake-config"

```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email puleeno@gmail.com instead of using the issue tracker.

## Credits

- [Puleeno Nguyen](https://github.com/puleeno)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

