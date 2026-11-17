<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

// Logout diteruskan ke hub lewat tautan bertanda tangan, supaya hub juga menghapus cookie lama miliknya
class SsoLogoutTest extends TestCase
{
    public function test_logout_continues_at_hub_and_expires_cookies_stored_for_this_host_only(): void
    {
        config(['sso.hub_url' => 'https://auth.elips.id', 'session.domain' => '.elips.id']);
        $user = new User(['name' => 'Uji']);
        $user->id = 3;

        $response = $this->actingAs($user)->get('/logout');

        $this->assertGuest();
        $location = $response->headers->get('Location');
        $this->assertStringStartsWith('https://auth.elips.id/sso/logout?', $location);
        parse_str(parse_url($location, PHP_URL_QUERY), $query);
        $this->assertSame(url(config('sso.home')), $query['redirect']);
        $this->assertNotEmpty($query['signature']);

        $cleared = collect($response->headers->getCookies())
            ->filter(fn ($c) => $c->getDomain() === null && $c->isCleared())->map->getName();
        $this->assertContains(auth()->guard()->getRecallerName(), $cleared);
        $this->assertContains(config('session.cookie'), $cleared);
    }
}
