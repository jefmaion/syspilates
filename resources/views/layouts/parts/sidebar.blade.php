<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">

        <!-- BEGIN NAVBAR TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- END NAVBAR TOGGLER -->

        <!-- BEGIN NAVBAR LOGO -->
        <div class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <x-application-logo />
            </a>
        </div>
        <!-- END NAVBAR LOGO -->

        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item d-none d-lg-flex me-3">
                <div class="btn-list">
                    <a href="https://github.com/tabler/tabler" class="btn btn-5" target="_blank" rel="noreferrer">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/brand-github -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-2">
                            <path
                                d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                        </svg>
                        Source code
                    </a>
                    <a href="https://github.com/sponsors/codecalm" class="btn btn-6" target="_blank" rel="noreferrer">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/heart -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon text-pink icon-2">
                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                        </svg>
                        Sponsor
                    </a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <x-user-navigation-dropdown></x-user-navigation-dropdown>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <!-- BEGIN NAVBAR MENU -->
            <ul class="navbar-nav pt-lg-3">
                @foreach(config('tabler.sidebar-menu') as $title => $item)
                <li class="nav-item @if($item['active']) active @endif @if(isset($item['submenu'])) dropdown @endif">
                    <a class="nav-link  @if(isset($item['submenu'])) dropdown-toggle @endif"  @if(isset($item['submenu'])) href="#navbar-{{ $title }}"
                        data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" @else href="{{ $item['link']}}" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> {{ $title }} </span>
                    </a>
                    @if(isset($item['submenu']))
                    <div class="dropdown-menu {{ $item['active'] ? 'show' :  ''}}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @foreach($item['submenu'] as $sub1Title => $sub1)
                                @if(isset($sub1['submenu']))
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-{{ $sub1Title }}" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                                            {{ $sub1Title }} 
                                        </a>
                                        <div class="dropdown-menu">
                                            @foreach($sub1['submenu'] as $sub3Title => $sub3)
                                            <a href="./sign-in.html" class="dropdown-item"> {{ $sub3Title }}
                                                @if(isset($sub3['tag']))
                                                    <span class="badge badge-sm {{ $sub3['tag']['color'] }}-lt text-uppercase ms-auto">{{ $sub3['tag']['label'] }}</span>
                                                @endif
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @else
                                    <a class="dropdown-item {{ $sub1['active'] ?? '' }}" href="{{ $sub1['link'] }}">
                                        {{ $sub1Title }} 
                                        @if(isset($sub1['tag']))
                                            <span class="badge badge-sm {{ $sub1['tag']['color'] }}-lt text-uppercase ms-auto">{{ $sub1['tag']['label'] }}</span>
                                        @endif
                                    </a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </li>
                @endforeach
            </ul>
            <!-- END NAVBAR MENU -->
        </div>
    </div>
</aside>