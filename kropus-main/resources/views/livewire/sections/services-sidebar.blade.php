<div class="grid grid-cols-2 gap-4 lg:gap-5">
    @foreach($services as $post)
        @include('blog.cards.services-small', ['post' => $post, 'additionalClasses' => 'lg:min-h-[12rem]'])
    @endforeach
</div>
