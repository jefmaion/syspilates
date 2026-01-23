<aside class="navbar navbar-vertical navbar-expand-lg " data-bs-theme="dark">
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
            <div class="nav-item dropdown">
                <x-user-navigation-dropdown>
                    <a href="{{ route('profile') }}" wire:navigate class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                            <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                            <path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" />
                        </svg>
                        {{ __('Profile') }}
                    </a>
                </x-user-navigation-dropdown>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <!-- BEGIN NAVBAR MENU -->
            
            <ul class="navbar-nav pt-lg-3">
                @foreach($sidebarMenu as $title => $item)

                @if($item =='nav-header')
                    <li class="nav-item nav-header ms-3 my-2"><small>{{ strtoupper($title) }}</small></li>
                    @continue
                @endif
               
                <li class="nav-item {{ $item['active'] ? 'active' :  '' }} @if(isset($item['submenu'])) dropdown @endif">
                    <a  class="nav-link  @if(isset($item['submenu'])) dropdown-toggle @endif"  @if(isset($item['submenu'])) href="#navbar-{{ $title }}"
                        data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" @else wire:navisgate href="{{ ($item['route']) ? route($item['route']) : '#' }}" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            {!! $item['icon'] !!}
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
                                        <a class="dropdown-item dropdown-toggle {{ $sub1['active'] ? 'show' :  ''}}" href="#sidebar-{{ $sub1Title }}" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                                            {!! $sub1['icon'] !!}
                                            {{ $sub1Title }} 
                                        </a>
                                        <div class="dropdown-menu {{ $sub1['active'] ? 'show' :  ''}}">
                                            @foreach($sub1['submenu'] as $sub3Title => $sub3)
                                                <a wire:navigate href="{{ ($sub3['route']) ? route($sub3['route']) : '#' }}" class="dropdown-item @if($sub3['active']) active @endif"> {{ $sub3Title }}
                                                    @if(isset($sub3['tag']))
                                                        <span class="badge badge-sm {{ $sub3['tag']['color'] }}-lt text-uppercase ms-auto">{{ $sub3['tag']['label'] }}</span>
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a wire:navigate class="dropdown-item {{ $sub1['active'] ? 'active' :  '' }}" href="{{ ($sub1['route']) ? route($sub1['route']) : '#' }}">
                                        {!! $sub1['icon'] !!}
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