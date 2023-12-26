<link rel="stylesheet" href="./assets/css/discussion.css">
<title><?= ucfirst($page) ?></title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x/dist/tailwind.min.css" rel="stylesheet">

<!-- Messenger Clone -->
<div class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden">
    <div class="flex-1 flex flex-col">
        <main class="flex-grow flex flex-row min-h-0">
            <section class="flex flex-col flex-none overflow-auto w-24 group lg:max-w-sm md:w-2/5 transition-all duration-300 ease-in-out">
                <div class="header p-4 flex flex-row justify-between items-center flex-none">
                    <div id="roomForm" class="top-1/4 left-1/3  mt-2">
                        <div id="overlay" class="fixed inset-0 bg-black opacity-70 hidden"></div>
                        <div id="contact-form" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded shadow-lg" style="width: 400px">
                            <button id="close-btn" class="text-gray-700 hover:text-red-600 font-bold text-xl absolute top-2 right-2" onclick="closeForm()">X</button>
                            <h2 class="text-2xl font-semibold mb-4">Create Room</h2>
                            <form action="" method="" class="space-y-4">
                                <div>
                                    <label for="email" class="block mb-8 text-xl font-medium text-gray-600">Room Name</label>
                                    <label class="wrapper">
                                        <input type="text" placeholder="Room Name" name="text" id="RoomName" class="input">
                                        <span class="placeholder">Room Name</span>
                                    </label>
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-600">All Friends</label>
<!--                                    start of input select box-->

                                    <label for="countries_multiple" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                                    <select name="membersdrop[]" multiple id="Members" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <?php foreach ($users as $user) {
                                            if ($user["user_id"] != $_SESSION["user_id"]) {
                                                ?>
                                                <option value="<?= $user["user_id"] ?>"><?= $user["username"] ?></option>
                                            <?php }
                                        } ?>

                                    </select>

                                    <!--                                    start of input select box-->
                                </div>

                                <div type="submit" id="CreateRoomBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Submit
                                </div>
                            </form>
                        </div>



                        <button type="submit" name="NewRoom" id="open-popup" >
                            <i id="popup-icon" class="fas fa-comment">
                                <svg viewBox="0 0 24 24" class="w-6 h-6 right-36 bottom-40 fill-current">
                                    <path
                                            d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/>
                                </svg>
                            </i>
                        </button>

                        <script>
                            const openPopupBtn = document.getElementById('open-popup');
                            const contactForm = document.getElementById('contact-form');
                            const popupIcon = document.getElementById('popup-icon');
                            const overlay = document.getElementById('overlay');

                            openPopupBtn.addEventListener('click', function () {
                                if (contactForm.style.display === 'block') {
                                    contactForm.style.display = 'none';
                                    overlay.style.display = 'none';
                                    popupIcon.classList.remove('fa-comment');
                                    popupIcon.classList.add('fa-comment-alt');
                                } else {
                                    contactForm.style.display = 'block';
                                    overlay.style.display = 'block';
                                    popupIcon.classList.remove('fa-comment-alt');
                                    popupIcon.classList.add('fa-comment');
                                }
                            });

                            function closeForm() {
                                contactForm.style.display = 'none';
                                overlay.style.display = 'none';
                                popupIcon.classList.remove('fa-comment');
                                popupIcon.classList.add('fa-comment-alt');
                            }

                            overlay.addEventListener('click', function () {
                                closeForm();
                            });

                        </script>
                    </div>
                    <p class="text-md font-bold hidden md:block group-hover:block">Room Chat</p>
                    <div x-data="{ isOpen: true }" class="relative inline-block ">
                        <!-- Dropdown toggle button -->
                        <button @click="isOpen = !isOpen" class="relative z-10 flex items-center p-2 text-sm text-gray-600 bg-transparent border border-transparent rounded-md   dark:focus:ring-opacity-40  dark:focus:ring-blue-400  dark:text-white dark:bg-gray-800 ">
                            <img class="shadow-md rounded-full w-14 object-cover"
                                 src="https://randomuser.me/api/portraits/men/75.jpg"
                                 alt=""/>
                            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z" fill="currentColor"></path>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="isOpen"
                             @click.away="isOpen = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-90"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-90"
                             class="absolute right-0 z-20 w-56 py-2 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800"
                        >
                            <a href="#" class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                <img class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9" src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200" alt="jane avatar">
                                <div class="mx-1">
                                    <h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Jane Doe</h1>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">janedoe@exampl.com</p>
                                </div>
                            </a>

                            <hr class="border-gray-200 dark:border-gray-700 ">






                            <hr class="border-gray-200 dark:border-gray-700 ">

                            <hr class="border-gray-200 dark:border-gray-700 ">


                            <a href="index.php?page=home" class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 21H10C8.89543 21 8 20.1046 8 19V15H10V19H19V5H10V9H8V5C8 3.89543 8.89543 3 10 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21ZM12 16V13H3V11H12V8L17 12L12 16Z" fill="currentColor"></path>
                                </svg>

                                <span class="mx-1">
                Return to home
            </span>
                            </a>
                        </div>
                    </div>


                </div>
                <div class="search-box p-4 flex-none">
                    <form onsubmit="">
                        <div class="relative">
                            <label>
                                <input class="rounded-full py-2 pr-6 pl-10 w-full border border-gray-800 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                                       type="text" value="" placeholder="Search Messenger"/>
                                <span class="absolute top-0 left-0 mt-2 ml-3 inline-block">
                                    <svg viewBox="0 0 24 24" class="w-6 h-6">
                                        <path fill="#bbb"
                                              d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="active-users flex flex-row p-2 overflow-auto w-0 min-w-full">
                    <div class="text-sm text-center mr-4">
                        <button class="flex flex-shrink-0 focus:outline-none block bg-gray-800 text-gray-600 rounded-full w-20 h-20"
                                type="button">
                            <svg class="w-full h-full fill-current" viewBox="0 0 24 24">
                                <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                            </svg>
                        </button>
                        <p>Add friend</p>
                    </div>


                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-blue-600 rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/women/12.jpg"
                                     alt=""
                                />
                            </div></div><p>Anna</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-transparent rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/men/75.jpg"
                                     alt=""
                                />
                                <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                    <div class="bg-green-500 rounded-full w-3 h-3"></div>
                                </div>
                            </div></div><p>Jeff</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-blue-600 rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/women/42.jpg"
                                     alt=""
                                />
                            </div></div><p>Cathy</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-transparent rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/women/87.jpg"
                                     alt=""
                                />
                                <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                    <div class="bg-green-500 rounded-full w-3 h-3"></div>
                                </div>
                            </div></div><p>Madona</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-transparent rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/women/23.jpg"
                                     alt=""
                                />
                                <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                    <div class="bg-green-500 rounded-full w-3 h-3"></div>
                                </div>
                            </div></div><p>Emma</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-blue-600 rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/men/65.jpg"
                                     alt=""
                                />
                            </div></div><p>Mark</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-blue-600 rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/women/65.jpg"
                                     alt=""
                                />
                            </div></div><p>Eva</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-transparent rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/men/31.jpg"
                                     alt=""
                                />
                                <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                    <div class="bg-green-500 rounded-full w-3 h-3"></div>
                                </div>
                            </div></div><p>Max</p></div>
                    <div class="text-sm text-center mr-4"><div class="p-1 border-4 border-blue-600 rounded-full"><div class="w-16 h-16 relative flex flex-shrink-0">
                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                     src="https://randomuser.me/api/portraits/men/81.jpg"
                                     alt=""
                                />
                            </div></div><p>Adam</p></div>
                </div>
                <div class="contacts p-2 flex-1 overflow-y-scroll">
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/women/61.jpg"
                                 alt=""
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Angelina Jolie</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">Ok, see you at the subway in a bit.</p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">Just now</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/97.jpg"
                                 alt=""
                            />
                            <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                <div class="bg-green-500 rounded-full w-3 h-3"></div>
                            </div>
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p class="font-bold">Tony Stark</p>
                            <div class="flex items-center text-sm font-bold">
                                <div class="min-w-0">
                                    <p class="truncate">Hey, Are you there?</p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">10min</p>
                            </div>
                        </div>
                        <div class="bg-blue-700 w-3 h-3 rounded-full flex flex-shrink-0 hidden md:block group-hover:block"></div>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/women/33.jpg"
                                 alt=""
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Scarlett Johansson</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">You sent a photo.</p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">1h</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/12.jpg"
                                 alt=""
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>John Snow</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">You missed a call John.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">4h</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/women/23.jpg"
                                 alt="User2"
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Emma Watson</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">You sent a video.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">11 Feb</p>
                            </div>
                        </div>
                        <div class="w-4 h-4 flex flex-shrink-0 hidden md:block group-hover:block">
                            <img class="rounded-full w-full h-full object-cover" alt="user2"
                                 src="https://randomuser.me/api/portraits/women/23.jpg"/>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/women/87.jpg"
                                 alt="User2"
                            />
                            <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                <div class="bg-green-500 rounded-full w-3 h-3"></div>
                            </div>
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Sunny Leone</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">Ah, it was an awesome one night stand.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">1 Feb</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/45.jpg"
                                 alt="User2"
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Bruce Lee</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">You are a great human being.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">23 Jan</p>
                            </div>
                        </div>
                        <div class="w-4 h-4 flex flex-shrink-0 hidden md:block group-hover:block">
                            <img class="rounded-full w-full h-full object-cover" alt="user2"
                                 src="https://randomuser.me/api/portraits/men/45.jpg"/>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-10 h-10 object-cover absolute ml-6"
                                 src="https://randomuser.me/api/portraits/men/22.jpg"
                                 alt="User2"
                            />
                            <img class="shadow-md rounded-full w-10 h-10 object-cover absolute mt-6"
                                 src="https://randomuser.me/api/portraits/men/55.jpg"
                                 alt="User2"
                            />
                            <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                <div class="bg-green-500 rounded-full w-3 h-3"></div>
                            </div>
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>TailwindCSS Group</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">Adam: Hurray, Version 2 is out now!!.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">23 Jan</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/34.jpg"
                                 alt="User2"
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Will Smith</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">WTF dude!! absofuckingloutely.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">13 Dec</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/22.jpg"
                                 alt="User2"
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Brad Pitt</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">you called Brad.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">31 Dec</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/99.jpg"
                                 alt="User2"
                            />
                            <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                <div class="bg-green-500 rounded-full w-3 h-3"></div>
                            </div>
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Tom Hanks</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">Tom called you.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">31 Dec</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/41.jpg"
                                 alt="User2"
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Dwayne Johnson</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">How can i forget about that man!.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">12 Nov</p>
                            </div>
                        </div>
                        <div class="w-4 h-4 flex flex-shrink-0 hidden md:block group-hover:block">
                            <img class="rounded-full w-full h-full object-cover" alt="user2"
                                 src="https://randomuser.me/api/portraits/men/41.jpg"/>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/70.jpg"
                                 alt="User2"
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Johnny Depp</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">Alright! let's catchup tomorrow!.
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">4 Nov</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/20.jpg"
                                 alt="User2"
                            />
                            <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                <div class="bg-green-500 rounded-full w-3 h-3"></div>
                            </div>
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Leonardo Dicaprio</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">How can you leave Rose dude. I hate you!
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">26 Oct</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <div class="w-16 h-16 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/men/32.jpg"
                                 alt="User2"
                            />
                        </div>
                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p>Tom Cruise</p>
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="min-w-0">
                                    <p class="truncate">Happy birthday to you my friend!
                                    </p>
                                </div>
                                <p class="ml-2 whitespace-no-wrap">2 Oct</p>
                            </div>
                        </div>
                        <div class="w-4 h-4 flex flex-shrink-0 hidden md:block group-hover:block">
                            <img class="rounded-full w-full h-full object-cover" alt="user2"
                                 src="https://randomuser.me/api/portraits/men/32.jpg"/>
                        </div>
                    </div>
                </div>
            </section>
            <link
                    rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
            />


            <section class="flex flex-col flex-auto border-l border-gray-800">
                <div class="chat-header px-6 py-4 flex flex-row flex-none justify-between items-center shadow">
                    <div class="flex">
                        <div class="w-12 h-12 mr-4 relative flex flex-shrink-0">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/women/33.jpg"
                                 alt=""
                            />
                        </div>
                        <div class="text-sm">
                            <p class="font-bold">Scarlett Johansson</p>
                            <p>Active 1h ago</p>
                        </div>
                    </div>

                    <div class="flex">

                        <a href="#" class="block rounded-full hover:bg-gray-700 bg-gray-800 w-10 h-10 p-2 ml-4">
                            <svg viewBox="0 0 20 20" class="w-full h-full fill-current text-blue-500">
                                <path d="M2.92893219,17.0710678 C6.83417511,20.9763107 13.1658249,20.9763107 17.0710678,17.0710678 C20.9763107,13.1658249 20.9763107,6.83417511 17.0710678,2.92893219 C13.1658249,-0.976310729 6.83417511,-0.976310729 2.92893219,2.92893219 C-0.976310729,6.83417511 -0.976310729,13.1658249 2.92893219,17.0710678 Z M9,11 L9,10.5 L9,9 L11,9 L11,15 L9,15 L9,11 Z M9,5 L11,5 L11,7 L9,7 L9,5 Z"/>
                            </svg>

                        </a>
                    </div>
                </div>
                <div class="chat-body p-4 flex-1 overflow-y-scroll">
                    <div class="flex flex-row justify-start">
                        <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/women/33.jpg"
                                 alt=""
                            />
                        </div>
                        <div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
                            <div class="flex items-center group">
                                <p class="px-6 py-3 rounded-t-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">Hey! How are you?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center group">
                                <p class="px-6 py-3 rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">Shall we go for Hiking this weekend?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center group">
                                <p class="px-6 py-3 rounded-b-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">Lorem ipsum
                                    dolor sit
                                    amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Volutpat lacus laoreet non curabitur gravida.</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="p-4 text-center text-sm text-gray-500">FRI 3:04 PM</p>
                    <div class="flex flex-row justify-end">
                        <div class="messages text-sm text-white grid grid-flow-row gap-2">
                            <div class="flex items-center flex-row-reverse group">
                                <p class="px-6 py-3 rounded-t-full rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Hey! How are you?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center flex-row-reverse group">
                                <p class="px-6 py-3 rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Shall we go for Hiking this weekend?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center flex-row-reverse group">
                                <p class="px-6 py-3 rounded-b-full rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Lorem ipsum
                                    dolor sit
                                    amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Volutpat lacus laoreet non curabitur gravida.</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="p-4 text-center text-sm text-gray-500">SAT 2:10 PM</p>
                    <div class="flex flex-row justify-start">
                        <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                 src="https://randomuser.me/api/portraits/women/33.jpg"
                                 alt=""
                            />
                        </div>
                        <div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
                            <div class="flex items-center group">
                                <p class="px-6 py-3 rounded-t-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">Hey! How are you?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center group">
                                <p class="px-6 py-3 rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">Shall we go for Hiking this weekend?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center group">
                                <p class="px-6 py-3 rounded-b-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">Lorem ipsum
                                    dolor sit
                                    amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Volutpat lacus laoreet non curabitur gravida.</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="p-4 text-center text-sm text-gray-500">12:40 PM</p>
                    <div class="flex flex-row justify-end">
                        <div class="messages text-sm text-white grid grid-flow-row gap-2">
                            <div class="flex items-center flex-row-reverse group">
                                <p class="px-6 py-3 rounded-t-full rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Hey! How are you?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center flex-row-reverse group">
                                <p class="px-6 py-3 rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Shall we go for Hiking this weekend?</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center flex-row-reverse group">
                                <a class="block w-64 h-64 relative flex flex-shrink-0 max-w-xs lg:max-w-md" href="#">
                                    <img class="absolute shadow-md w-full h-full rounded-l-lg object-cover" src="https://unsplash.com/photos/8--kuxbxuKU/download?force=true&w=640" alt="hiking"/>
                                </a>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center flex-row-reverse group">
                                <p class="px-6 py-3 rounded-b-full rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Lorem ipsum
                                    dolor sit
                                    amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                    dolore magna aliqua. Volutpat lacus laoreet non curabitur gravida.</p>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>
                                    </svg>
                                </button>
                                <button type="button" class="option-message">
                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                                        <path
                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-footer flex-none">
                    <div class="flex flex-row items-center p-4">
                        <div class="relative flex-grow">
                            <label>
                                <input class="input-message rounded-full py-2 pl-3 pr-10 w-full border border-gray-800 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                                       type="text" value="" placeholder="Aa"/>
                                <button type="button" class="absolute top-0 right-0 mt-2 mr-3 flex flex-shrink-0 focus:outline-none block text-blue-600 hover:text-blue-700 w-6 h-6">
                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                        <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 3a6 6 0 0 1-11.32 0h11.32z" />
                                    </svg>
                                </button>
                            </label>
                        </div>
                        <button type="button" class="flex flex-shrink-0 focus:outline-none mx-2 block text-blue-600 hover:text-blue-700 w-6 h-6">
                            <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                <path d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<script src="./assets/js/discussion.js"></script>

