<!-- Navbar -->
<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
            <!-- Breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                <li class="leading-normal text-sm">
                    <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                </li>
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">
                    @yield('page-title', 'Dashboard')
                </li>
            </ol>
            <h6 class="mb-0 font-bold capitalize">@yield('page-title', 'Dashboard')</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <div class="flex items-center md:ml-auto md:pr-4">
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">

                </div>
            </div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                <li class="flex items-center">
                    @auth
                    <div class="relative">
                        <button type="button" id="logoutTrigger" class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500 hover:text-slate-700 focus:outline-none">
                            <i class="fa fa-user sm:mr-1"></i>
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                        </button>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500 hover:text-slate-700">
                        <i class="fa fa-user sm:mr-1"></i>
                        <span class="hidden sm:inline">Sign In</span>
                    </a>
                    @endauth
                </li>
                <li class="flex items-center pl-4 xl:hidden">
                    <a href="javascript:;" class="block p-0 transition-all ease-nav-brand text-sm text-slate-500" sidenav-trigger>
                        <div class="w-4.5 overflow-hidden">
                            <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Logout Modal - Fixed positioning to avoid overlap -->
@auth
<div id="logoutModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-30 backdrop-blur-sm" style="z-index: 99999 !important; position: fixed !important; top: 0 !important; left: 0 !important; width: 100vw !important; height: 100vh !important;">
    <div class="bg-white rounded-lg shadow-xl p-6 w-11/12 max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="logoutModalContent" style="z-index: 100000 !important;">
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Confirm Logout</h3>
            <button type="button" id="closeModalX" class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="mb-6">
            <p class="text-gray-600">Are you sure you want to logout from your account?</p>
        </div>

        <!-- Modal Footer -->
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
            <button type="button" id="cancelLogout" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors w-full sm:w-auto">
                Cancel
            </button>
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="px-4 py-2 bg-danger-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors w-full sm:w-auto">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutTrigger = document.getElementById('logoutTrigger');
        const logoutModal = document.getElementById('logoutModal');
        const logoutModalContent = document.getElementById('logoutModalContent');
        const cancelLogout = document.getElementById('cancelLogout');
        const closeModalX = document.getElementById('closeModalX');

        // Function to show modal with animation
        function showModal() {
            if (logoutModal && logoutModalContent) {
                logoutModal.classList.remove('hidden');
                // Force reflow
                logoutModal.offsetHeight;
                // Add animation classes
                logoutModalContent.classList.remove('scale-95', 'opacity-0');
                logoutModalContent.classList.add('scale-100', 'opacity-100');
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
            }
        }

        // Function to hide modal with animation
        function hideModal() {
            if (logoutModal && logoutModalContent) {
                logoutModalContent.classList.remove('scale-100', 'opacity-100');
                logoutModalContent.classList.add('scale-95', 'opacity-0');

                // Wait for animation to complete before hiding
                setTimeout(() => {
                    logoutModal.classList.add('hidden');
                    // Restore body scroll
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        // Show modal when logout button is clicked
        if (logoutTrigger) {
            logoutTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                showModal();
            });
        }

        // Hide modal when cancel button is clicked
        if (cancelLogout) {
            cancelLogout.addEventListener('click', function(e) {
                e.preventDefault();
                hideModal();
            });
        }

        // Hide modal when X button is clicked
        if (closeModalX) {
            closeModalX.addEventListener('click', function(e) {
                e.preventDefault();
                hideModal();
            });
        }

        // Hide modal when clicking outside the modal content
        if (logoutModal) {
            logoutModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideModal();
                }
            });
        }

        // Hide modal when ESC key is pressed
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && logoutModal && !logoutModal.classList.contains('hidden')) {
                hideModal();
            }
        });
    });
</script>
@endauth