<link rel="stylesheet" href="./assets/css/discussion.css">
<title><?= ucfirst($page) ?></title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x/dist/tailwind.min.css" rel="stylesheet">

<!-- Messenger Clone -->
<div class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden">
    <div class="flex-1 flex flex-col">
        <main class="flex-grow flex flex-row min-h-0">
            <section class="flex flex-col flex-none overflow-auto w-24 group lg:max-w-sm md:w-2/5 transition-all duration-300 ease-in-out">
                <div class="header p-4 flex flex-row justify-between items-center flex-none">
                    <div id="roomForm" class="mt-2">
                        <div id="overlay" class="fixed inset-0 bg-black opacity-70 hidden"></div>
                        <div id="contact-form" class="fixed transform mt-20 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded shadow-lg" style="width: 400px; margin-left: 600px">
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

                                    <select multiple id="Members" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                                    Create room
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

                            CreateRoomBtn.addEventListener('click', function () {
                                closeForm();
                            });

                        </script>
                    </div>
                    <p class="text-md font-bold hidden md:block group-hover:block">Room Chat</p>
                    <div x-data="{ isOpen: true }" class="relative inline-block ">
                        <!-- Dropdown toggle button -->
                        <button @click="isOpen = !isOpen" class="relative z-10 flex items-center p-2 text-sm text-gray-600 bg-transparent border border-transparent rounded-md   dark:focus:ring-opacity-40  dark:focus:ring-blue-400  dark:text-white dark:bg-gray-800 ">
                            <img class="shadow-md rounded-full w-14 object-cover"
                                 src="assets/pictures/<?= $userData['picture'] ?>"
                                 alt=""/>
                            <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z" fill="currentColor"></path>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="!isOpen"
                             @click.away="isOpen = true"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-90"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-90"
                             class="absolute right-0 z-20 w-56 py-2 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800"
                        >
                            <a href="#" class="cursor-pointer flex bg-white items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                <img class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9" src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8d29tYW4lMjBibHVlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=face&w=500&q=200" alt="jane avatar">
                                <div class=" mx-1">
                                    <h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200"><?= $userData['username'] ?></h1>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"><?= $userData['email'] ?></p>
                                </div>
                            </a>

                            <hr class="border-gray-200 dark:border-gray-700 ">






                            <hr class="border-gray-200 dark:border-gray-700 ">
                            <a @click="isOpen = !isOpen" id="ProfileBtn" class="flex cursor-pointer items-center p-3 text-sm bg-white text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="ml-2 mr-1 w-5" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>profile [#1336]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-380.000000, -2159.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M334,2011 C337.785,2011 340.958,2013.214 341.784,2017 L326.216,2017 C327.042,2013.214 330.215,2011 334,2011 M330,2005 C330,2002.794 331.794,2001 334,2001 C336.206,2001 338,2002.794 338,2005 C338,2007.206 336.206,2009 334,2009 C331.794,2009 330,2007.206 330,2005 M337.758,2009.673 C339.124,2008.574 340,2006.89 340,2005 C340,2001.686 337.314,1999 334,1999 C330.686,1999 328,2001.686 328,2005 C328,2006.89 328.876,2008.574 330.242,2009.673 C326.583,2011.048 324,2014.445 324,2019 L344,2019 C344,2014.445 341.417,2011.048 337.758,2009.673" id="profile-[#1336]"> </path> </g> </g> </g> </g></svg>

                                <span class="mx-1">
                My profile
            </span>
                            </a>
                            <hr class="border-gray-200 dark:border-gray-700 ">


                            <a href="index.php?page=home" class="flex items-center p-3 cursor-pointer text-sm bg-white text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
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
                                <input class="rounded-full py-2 pr-6 pl-10 w-full border border-gray-800 focus:border-gray-700 bg-black focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
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
                        <button id="addNewFriendFormBtn" class="flex flex-shrink-0 focus:outline-none block bg-gray-800 text-gray-600 rounded-full w-20 h-20"
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

                <div class="contacts cursor-pointer p-2 flex-1 overflow-y-scroll">
                    <?php foreach ($rooms as $room) {?>
                    <div data-room-name="<?= $room['room_name'] ?>" data-room-creator="<?= $room['creator'] ?>"  data-room-id="<?= $room['room_id'] ?>" class="rooms flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
                        <?php
                        $members = Room::getAllMembers($room["room_id"]);
                        $i = 0;
                        foreach ($members as $member) {
                            if ($i < 2) {
                                // Add a right margin to the first image
                                $marginClass = $i == 0 ? '-space-x-2' : '';
                                ?>
                                <div class="img-container w-10 h-10 relative flex flex-col justify-between <?= $marginClass ?>">
                                    <img class="shadow-md rounded-full w-10 h-10 object-cover"
                                         src="./assets/pictures/<?= $member["picture"] ?>"
                                         alt="User Image"
                                    />
                                </div>
                                <?php
                            }
                            $i++;
                        }
                        ?>

                        <!--                        <img class="shadow-md rounded-full w-10 h-10 object-cover absolute ml-2"-->
<!--                             src="./assets/pictures/974-1696615908.jpg"-->
<!--                             alt="User2"-->
<!--                        />-->
<!--                        <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">-->
<!--                            <div class="bg-green-500 rounded-full w-3 h-3"></div>-->
<!--                        </div>-->
                        <div class="roomName flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                            <p><?= $room['room_name'] ?></p>
                        </div>

                    </div>
<!--                    <div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">-->
<!--                        <div class="w-16 h-16 relative flex flex-shrink-0">-->
<!--                            <img class="shadow-md rounded-full w-10 h-10 object-cover absolute ml-6"-->
<!--                                 src="https://randomuser.me/api/portraits/men/22.jpg"-->
<!--                                 alt="User2"-->
<!--                            />-->
<!--                            <img class="shadow-md rounded-full w-10 h-10 object-cover absolute mt-6"-->
<!--                                 src="https://randomuser.me/api/portraits/men/55.jpg"-->
<!--                                 alt="User2"-->
<!--                            />-->
<!--                            <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">-->
<!--                                <div class="bg-green-500 rounded-full w-3 h-3"></div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">-->
<!--                            <p>TailwindCSS Group</p>-->
<!--                            <div class="flex items-center text-sm text-gray-600">-->
<!--                                <div class="min-w-0">-->
<!--                                    <p class="truncate">Adam: Hurray, Version 2 is out now!!.-->
<!--                                    </p>-->
<!--                                </div>-->
<!--                                <p class="ml-2 whitespace-no-wrap">23 Jan</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <?php } ?>
                </div>

            </section>
            <link
                    rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
            />


            <section id="Core" class="flex flex-col flex-auto border-l border-gray-800">
                <!-- component -->
                <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
                <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

                <section id="profile" class="pt-16 ">
                    <div class="px-4 mx-auto" style="width: 600px;height: 100px" >
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16" style="height: 450px">
                            <div class="px-6">
                                <div class="flex flex-wrap justify-center">
                                    <div class="w-full px-4 flex justify-center">
                                        <div class="relative">
                                            <img alt="..." src="./assets/pictures/<?= $userData['picture'] ?>" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                                        </div>
                                    </div>
                                    <div class="w-full px-4 text-center mt-20">
                                        <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                            <div class="mr-4 p-3 text-center">
              <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                22
              </span>
                                                <span class="text-sm text-blueGray-400">Friends</span>
                                            </div>
                                            <div class="mr-4 p-3 text-center">

              <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                89
              </span>
                                                <span class="text-sm text-blueGray-400">Rooms</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-12">
                                    <h3 class="text-xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                        <?= $userData['username'] ?>
                                    </h3>

                                    <div class="mb-2 text-blueGray-600">
                                        <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>
                                        <?= $userData['email'] ?>
                                    </div>
                                </div>
                                <p class="font-bold text-center text-black text-xl" >List of friends</p>
                                <div id="invitation-section" class="active-users flex flex-row p-2 overflow-auto w-0 min-w-full">

                                </div>
                        </div>
                    </div>
                </section>
                <div id="chat-header" class=" px-6 py-4 flex flex-row flex-none justify-between items-center shadow">
                    <div class="flex">
                        <div id="RmName" class=" text-sm">

                        </div>
                    </div>
                    <div id="roomDetails" class="top-1/4 left-1/3  mt-2">

                    </div>
                    <div id="overlays" style="display: none" class="fixed inset-0 bg-black opacity-70 hidden"></div>
                    <div id="room-form" style="display: none" class="fixed overflow-y-scroll ml-56 mt-96 w-96 h-96 transform -translate-x-1/2 -translate-y-1/2 bg-gray-800 border-4 border-black p-6 rounded-xl shadow-lg" style="width: 400px;">
                        <button id="close" class="text-gray-700 hover:text-red-600 font-bold text-xl absolute top-2 right-2" onclick="closeForm()">X</button>
                        <h2 class="text-2xl text-black text-center font-bold mb-4">Room Profile</h2>
                        <h2 class="text-2xl text-black text-center font-bold mb-4"></h2>
                                <div id="RoomMembers" action="" method="" class="space-y-4">

                                </div>
                    </div>
                    <div class="flex">

                        <a id="popup-ic" class="hidden block rounded-full hover:bg-gray-700 bg-gray-800 w-10 h-10 p-2 ml-4">
                            <svg viewBox="0 0 20 20" class="w-full h-full fill-current text-blue-500">
                                <path d="M2.92893219,17.0710678 C6.83417511,20.9763107 13.1658249,20.9763107 17.0710678,17.0710678 C20.9763107,13.1658249 20.9763107,6.83417511 17.0710678,2.92893219 C13.1658249,-0.976310729 6.83417511,-0.976310729 2.92893219,2.92893219 C-0.976310729,6.83417511 -0.976310729,13.1658249 2.92893219,17.0710678 Z M9,11 L9,10.5 L9,9 L11,9 L11,15 L9,15 L9,11 Z M9,5 L11,5 L11,7 L9,7 L9,5 Z"/>
                            </svg>

                        </a>
                    </div>
                </div>
                <div id="chat-body" class="chat-body p-4 flex-1 overflow-y-scroll">

<!--                    <p class="p-4 text-center text-sm text-gray-500">FRI 3:04 PM</p>-->
<!--                    <div class="flex flex-row justify-end">-->
<!--                        <div  class="messages text-sm text-white grid grid-flow-row gap-2">-->
<!--                            <div id="chat-section" class="flex items-center flex-row-reverse group">-->
<!--                                -->
<!--                                <p class="px-6 py-3 rounded-t-full rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Hey! How are you?</p>-->
<!--                                -->
<!--                                <button type="button" class="option-message">-->
<!--                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">-->
<!--                                        <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z-->
<!--	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8-->
<!--	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                                <button type="button" class="option-message">-->
<!--                                    <svg viewBox="0 0 20 20" class="w-full h-full fill-current">-->
<!--                                        <path d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"/>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                                <button type="button" class="option-message">-->
<!--                                    <svg viewBox="0 0 24 24" class="w-full h-full fill-current">-->
<!--                                        <path-->
<!--                                            d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div id="member-form" class="hidden fixed transform mt-20 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded shadow-lg" style="width: 400px; margin-left: 600px">
                        <button id="friend-close-btn" class="text-gray-700 hover:text-red-600 font-bold text-xl absolute top-2 right-2">X</button>
                        <h2 class="text-2xl font-semibold mb-4">Add New Friend</h2>
                        <form action="" method="" class="space-y-4">
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-600">All Users</label>
                                <!--                                    start of input select box-->

                                <select id="newFriend" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php foreach ($users as $user) {
                                        if ($user["user_id"] != $_SESSION["user_id"]) {
                                            ?>
                                            <option value="<?= $user["user_id"] ?>"><?= $user["username"] ?></option>
                                        <?php }
                                    } ?>

                                </select>

                                <!--                                    start of input select box-->
                            </div>

                            <div type="submit" id="addNewFriendBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add New Friend
                            </div>
                        </form>
                    </div>

                    <div id="chatCore" class="flex flex-col justify-start">
<!--                        chat core -->
                    </div>
                </div>
                <div class="chat-footer flex-none">
                    <div id="lastInput" class="hidden flex flex-row items-center p-4">
                        <div class="relative flex-grow">
                            <label>
                                <input id="chat-input" class="input-message rounded-full py-2 pl-3 pr-10 w-full border bg-black focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                                       type="text" value="" placeholder="Aa"/>
                            </label>
                        </div>
                        <button id="chat-btn" type="button" class="flex flex-shrink-0 focus:outline-none mx-2 block text-blue-600 hover:text-blue-700 w-6 h-6">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10.3009 13.6949L20.102 3.89742M10.5795 14.1355L12.8019 18.5804C13.339 19.6545 13.6075 20.1916 13.9458 20.3356C14.2394 20.4606 14.575 20.4379 14.8492 20.2747C15.1651 20.0866 15.3591 19.5183 15.7472 18.3818L19.9463 6.08434C20.2845 5.09409 20.4535 4.59896 20.3378 4.27142C20.2371 3.98648 20.013 3.76234 19.7281 3.66167C19.4005 3.54595 18.9054 3.71502 17.9151 4.05315L5.61763 8.2523C4.48114 8.64037 3.91289 8.83441 3.72478 9.15032C3.56153 9.42447 3.53891 9.76007 3.66389 10.0536C3.80791 10.3919 4.34498 10.6605 5.41912 11.1975L9.86397 13.42C10.041 13.5085 10.1295 13.5527 10.2061 13.6118C10.2742 13.6643 10.3352 13.7253 10.3876 13.7933C10.4468 13.87 10.491 13.9585 10.5795 14.1355Z" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<script src="./assets/js/discussion.js"></script>

<script src="./assets/js/newFriend.js"></script>