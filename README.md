# Nova Simple Content

## Purpose

This is a simple package for managing simple content. If all you need is to simplify the boilerplate of setting up Nova resources for things like blog posts and pages with total control over the view, this is for you. If you want complex hierarchical categorization and deep control over the post and page models then this package likely isn't a good fit.

### Requirements

1. \>= Laravel 8
1. \>= Laravel Nova 3 

### Features

1. Nova resource pages for Posts and Pages
1. Independently configurable caching for Posts and Pages
1. Event driven caching based on resource Update and Delete
1. Unopinionated view templates – write your own!
1. Configurable Page and Post route prefix (such as /blog, /content)
1. 100% test coverage

## Installation

1. `composer require carlson/nova-simple-content`
1. To copy the views for editing: `php artisan vendor:publish --tag=nova-simple-content-views`
1. To copy the config to customize caching and routes: `php artisan vendor:publish --tag=nova-simple-content-config`
1. To set up the required tables: `php artisan migrate`

## Config

The following values may be configured in the `nova-simple-content.php` config file:

1. `cache_posts`: Turns caching on or off for Posts. Default is `true`
1. `cache_pages`: Turns caching on or off for Pages. Default is `true`
1. `post_list_url`: The route for the post list. Default is `'/blog'`
1. `post_detail_slug_prefix`: The route prefix for posts, e.g. the '/blog' in /blog/test-slug. Default is `'/blog'`
1. `page_slug_prefix`: The route prefix for all pages, e.g. the '/content' in /content/test-slug. Default is `'/content'`

## Caching

Caching of both Pages and Posts is turned on by default, but can be configured independently. To disable either Post or Page caching edit the corresponding value in the `nova-simple-content.php` config file.

## Development

Contributions welcome! There is an included `docker-compose.yml` with containers for the correct version of PHP with required dependencies and database and cache containers for testing.

### Installation

1. Clone this repository.
1. Ensure Docker is already installed on your machine.
1. From the repository root run `docker-compose up -d` from your terminal.

### Testing

All commits of PHP or JavaScript must be accompanied by corresponding tests. To run the test suite enter the running app container (`docker exec -it nova_simple_content_app /bin/bash`) and run `composer test`