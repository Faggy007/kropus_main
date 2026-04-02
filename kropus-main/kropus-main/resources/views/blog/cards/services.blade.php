@props(['post'])

@include('blog.cards.default', [
    'post' => $post,
    'titleLineClamp' => 0,
    'showDescription' => false,
])
