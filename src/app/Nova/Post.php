<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Carlson\NovaSimpleContent\Post';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'post';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),
            TextWithSlug::make('Title')
                ->sortable()
                ->rules('required')
                ->slug('slug'),
            Slug::make('Slug')
                ->rules('required')
                ->creationRules('unique:posts,slug')
                ->updateRules('unique:posts,slug,{{resourceId}}')
                ->hideFromIndex(),
            Text::make('SEO Title', 'seo_title')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('SEO Description', 'seo_description')
                ->rules('required')
                ->hideFromIndex(),
            Select::make('Post Type', 'post_type')
                ->options([
                    'blog' => 'Blog Post',
                    'press' => 'Press Release',
                ])
                ->rules('required'),
            Image::make('Hero Image', 'hero_image_url')
                ->disk('s3')
                ->path('posts')
                ->prunable()
                ->hideFromIndex(),
            Image::make('Featured Image', 'featured_image_url')
                ->disk('s3')
                ->path('posts')
                ->prunable()
                ->hideFromIndex(),
            Trix::make('Body')
                ->withFiles('s3')
                ->rules('required')
                ->hideFromIndex(),
            Boolean::make('Published'),
            DateTime::make('Published Date', 'published_on')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}