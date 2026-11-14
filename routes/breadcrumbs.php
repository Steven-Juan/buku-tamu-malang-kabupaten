<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Home
 */
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

/**
 * Home > [Guest]
 */
Breadcrumbs::for('guest', function (BreadcrumbTrail $trail, $guest) {
    $trail->parent('home')->push($guest->nama, route('guest.show', $guest));
});

/**
 * Home > [Post]
 */
Breadcrumbs::for('post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('home')->push($post->title, route('post.show', $post));
});
