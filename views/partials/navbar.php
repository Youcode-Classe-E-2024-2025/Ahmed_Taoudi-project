    <nav class="bg-emerald-600 fixed w-full z-30 top-0">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="lg:hidden mr-2 text-white">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                    <a href="/" class="text-xl font-bold flex items-center lg:ml-2.5">
                        <!-- <img src="assets/images/logo.png" alt="Logo" class="h-8 w-8 mr-2"> -->
                        <span class="text-white">TeamFlow</span>
                    </a>
                </div>
                <?php if(!isset($_SESSION['user'])){?> 

                <div class="flex items-center gap-4">
                    <a href="/login" class="text-white hover:text-gray-200">
                        <i class="ri-login-circle-line text-xl"></i>
                        <span class="ml-1">Connexion</span>
                    </a>
                    <a href="/register" class="bg-white text-emerald-600 px-4 py-2 rounded-md hover:bg-gray-100">
                        <span>Inscription</span>
                    </a>
                </div>
                <?php }else{?>
                    <div class="flex items-center gap-4">
                    <a href="/user/profile" class=" text-white px-4 py-2 rounded-md text-lg ">
                        <i class="ri-user-fill"></i>
                        <?= $_SESSION['user']['name']?>
                    </a>
                    <a href="/logout" class="text-white  hover:text-emerald-600 rounded-md px-4 py-2  hover:bg-white">
                        <span class="ml-1">Log Out</span>
                        <i class="ri-logout-circle-r-line text-xs"></i>
                        <!-- <i class="ri-login-circle-line text-xl"></i> -->
                    </a>
                </div>
                    <?php }?>
            </div>
        </div>
    </nav>
