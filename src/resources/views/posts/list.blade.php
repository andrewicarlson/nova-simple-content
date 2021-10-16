@foreach($posts as $post)
    {{ $post->featured_image_url }}

    {{ $post->slug }}

    {{ $post->title }}

    {{ $post->published_at }}
@endforeach
