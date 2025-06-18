@php
    $user = auth()->user();
    $role = $user->role; // 'user' or 'monitoring'
    $parts = ['mesin','rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'];
    // Determine URL segments: segment(1) is prefix ('user' or 'monitoring'), segment(2) is bagian
    $segmentOne = request()->segment(1);
    $segmentTwo = request()->segment(2);
@endphp
<!-- Sidebar -->
<aside
    class="max-w-62.5 ease-nav-brand z-40 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="" target="_blank">
            <img src="{{ asset('assets/img/logo-ct.png') }}"
                class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Soft UI Dashboard</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="grow basis-full h-full overflow-y-auto px-4">
        <ul class="flex flex-col pl-0 mb-0">
            {{-- Dashboard Link --}}
            @php
                $dashboardRoute = $role === 'monitoring' ? 'monitoring.dashboard' : 'user.dashboard';
                $isDashboard = request()->routeIs($dashboardRoute);
            @endphp

            <li class="mt-0.5 w-full">
                <a href="{{ route($dashboardRoute) }}"
                    class="flex items-center px-4 py-2 text-sm transition-colors
              {{ $isDashboard ? 'shadow-soft-xl rounded-lg bg-white font-semibold text-slate-700' : '' }}">
                    <div
                        class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5
                        {{ $isDashboard ? 'bg-gradient-to-tl from-info-700 to-cyan-500' : 'bg-white' }}">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#000000" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="opacity-60"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                            </path>
                                            <path
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                </a>
            </li>

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 font-bold leading-tight uppercase text-xs opacity-60">MASTER DATA</h6>
            </li>

            @foreach (['area', 'kategori_kronologi', 'masterproses', 'users'] as $item)
                @php
                    $routeName = "$item.index";
                    $isActive = request()->routeIs($routeName);
                @endphp
                <li>
                    <a href="{{ route($routeName) }}"
                        class="flex items-center px-4 py-2 text-sm transition-colors
                          {{ $isActive ? 'bg-white shadow-soft-xl rounded-lg font-semibold text-slate-700' : '' }}">
                          <div
                          class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5
                          {{ $isActive ? 'bg-gradient-to-tl from-info-700 to-cyan-500' : 'bg-white' }}">
                          
                          @switch($item)
                              @case('area')
                                  {{-- ICON AREA --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M475.1 163.8L336 252.3v-68.3c0-18.9-20.9-30.4-36.9-20.2L160 252.3V56c0-13.3-10.7-24-24-24H24C10.7 32 0 42.7 0 56v400c0 13.3 10.7 24 24 24h464c13.3 0 24-10.7 24-24V184c0-18.9-20.9-30.4-36.9-20.2z"/></svg>
                                  @break
                        
                              @case('kategori_kronologi')
                                  {{-- ICON KATEGORI --}}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 9H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 12H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 15H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                  @break
                        
                              @case('masterproses')
                                  {{-- ICON PROSES --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M448 73.1v45.7C448 159.1 347.7 192 224 192S0 159.1 0 118.9V73.1C0 32.9 100.3 0 224 0s224 32.9 224 73.1zM448 176v102.9C448 319.1 347.7 352 224 352S0 319.1 0 278.9V176c48.1 33.1 136.2 48.6 224 48.6S399.9 209.1 448 176zm0 160v102.9C448 479.1 347.7 512 224 512S0 479.1 0 438.9V336c48.1 33.1 136.2 48.6 224 48.6S399.9 369.1 448 336z"/></svg>
                                  @break
                        
                              @case('users')
                                  {{-- ICON USERS --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
                                  @break
                        
                              @default
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <circle cx="12" cy="12" r="10" stroke-width="2" stroke="currentColor" fill="none"/>
                                  </svg>
                          @endswitch
                        </div>
                        
                        <span class="ml-1">{{ Str::title(str_replace('_', ' ', $item)) }}</span>
                    </a>
                </li>
            @endforeach

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 font-bold leading-tight uppercase text-xs opacity-60">MENU</h6>
            </li>

            @foreach ([['name' => 'flowproses', 'label' => 'Flow Proses'], ['name' => 'kronologi', 'label' => 'Kronologi'], ['name' => 'pengumuman', 'label' => 'Pengumuman'], ['name' => 'inputerp', 'label' => 'Input ERP']] as $menu)
                @php
                    $routeName = "$menu[name].index";
                    $isActive = request()->routeIs($routeName);
                @endphp
                <li>
                    <a href="{{ route($routeName) }}"
                        class="flex items-center px-4 py-2 text-sm transition-colors
                          {{ $isActive ? 'bg-white shadow-soft-xl rounded-lg font-semibold text-slate-700' : '' }}">
                          <div
                          class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5
                          {{ $isActive ? 'bg-gradient-to-tl from-info-700 to-cyan-500' : 'bg-white' }}">
                          
                          @switch($menu['name'])
                              @case('flowproses')
                                  {{-- ICON FLOW --}}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 9H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 12H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 15H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                  @break
                        
                              @case('kronologi')
                                  {{-- ICON KRONOLOGI --}}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="9" stroke="#000000" stroke-width="2" fill="none" />
                                    <path d="M12 7V12L15 15" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                  @break
                        
                              @case('pengumuman')
                                  {{-- ICON PENGUMUMAN --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 9H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 12H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 15H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                                  @break

                              @case('inputerp')
                                  {{-- ICON INPUT ERP --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 9H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 12H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.5 15H7.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                                  @break
                        
                              @default
                                  {{-- DEFAULT ICON --}}
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <circle cx="12" cy="12" r="10" stroke-width="2" stroke="currentColor" fill="none"/>
                                  </svg>
                          @endswitch
                        </div>
                        <span class="ml-1">{{ $menu['label'] }}</span>
                    </a>
                </li>
            @endforeach
            @if (Auth::user()->role === 'monitoring')
                <li class="mt-4 px-4 text-xs uppercase font-bold opacity-60">Bagian</li>
                @foreach ($parts as $p)
                    @php
                        $routeName = 'tb_cekqty_rosset.index';
                        $isActive = request()->routeIs($routeName) && request('bagian') === $p;
                        $url = route($routeName, ['bagian' => $p]);
                    @endphp
                    <li>
                        <a href="{{ $url }}"
                            class="flex items-center px-4 py-2 text-sm transition-colors
                          {{ $isActive ? 'bg-white shadow-soft-xl rounded-lg font-semibold text-slate-700' : '' }}">
                            <div
                                class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5
                          {{ $isActive ? 'bg-gradient-to-tl from-info-700 to-cyan-500' : 'bg-white' }}">
                          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 20V12L6 9H3V20H9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 20V8L15 12V20H21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 20H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M12 4V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M18 4V6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M6 16H8M17 16H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            </div>
                            <span class="ml-1">{{ ucfirst($p) }}</span>
                        </a>
                    </li>
                @endforeach
            @elseif (Auth::user()->role === 'user')
                {{-- only show the user’s own bagian --}}
                <li class="mt-4 px-4 text-xs uppercase font-bold opacity-60">Bagian</li>
                @php
                    $p = Auth::user()->bagian_area; // e.g. "gudang"
                    $routeName = 'cekqty_rosset.index';
                    $isActive = request()->routeIs($routeName) && request('bagian') === $p;
                    $url = route($routeName, ['bagian' => $p]);
                @endphp
                <li>
                    <a href="{{ $url }}"
                        class="flex items-center px-4 py-2 text-sm transition-colors
                              {{ $isActive ? 'bg-white shadow-soft-xl rounded-lg font-semibold text-slate-700' : '' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg xl:p-2.5
                                    {{ $isActive ? 'bg-gradient-to-tl from-info-700 to-cyan-500' : 'bg-white' }}">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 20V12L6 9H3V20H9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M21 20V8L15 12V20H21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 20H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M12 4V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M18 4V6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M6 16H8M17 16H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                        </div>
                        <span class="ml-1">{{ ucfirst($p) }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

</aside>
