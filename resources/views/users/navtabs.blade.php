<ul class="nav nav-tabs nav-fill mb-3">
    {{-- ユーザ詳細タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
            {{__("top.TimeLine")}}
            <span class="badge badge-secondary">{{ $user->microposts_count }}</span>
        </a>
    </li>
    {{-- フォロー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
            {{__("top.Followings")}}
            <span class="badge badge-secondary">{{ $user->followings_count }}</span>
        </a>
    </li>
    {{-- フォロワー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
            {{__("top.Followers")}}
            <span class="badge badge-secondary">{{ $user->followers_count }}</span>
        </a>
    </li>
    {{-- お気に入り一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.favorites') ? 'active' : '' }}">
            {{__("top.Favorites")}}
            <span class="badge badge-secondary">{{ $user->favorites_count }}</span>
        </a>
    </li>
</ul>