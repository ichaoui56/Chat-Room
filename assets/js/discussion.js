const CreateRoomBtn = document.getElementById('CreateRoomBtn');
const RoomName = document.getElementById('RoomName');
const Core = document.getElementById("Core");
const profile = document.getElementById("profile");
const ProfileBtn = document.getElementById("ProfileBtn");
const ChatBody = document.getElementById("chat-body");
const chatHeader = document.getElementById("chat-header");
const lastInput = document.getElementById("lastInput");
const contactForms = document.getElementById('room-form');
const popupIcons = document.getElementById('popup-ic');
const overlays = document.getElementById('overlays');
const closeBtn = document.getElementById('close');
const PopupIc = document.getElementById("popup-ic");

// PopupIc.addEventListener('click', ()=>{
//     console.log("test");
// });

closeBtn.addEventListener('click', ()=>{
    closeForms();
})


PopupIc.addEventListener('click', function () {
    if (contactForms.style.display === 'block') {
        contactForms.style.display = 'none';
        overlays.style.display = 'none';
        popupIcons.classList.remove('fa-comment');
        popupIcons.classList.add('fa-comment-alt');
    } else {
        contactForms.style.display = 'block';
        overlays.style.display = 'block';
        popupIcons.classList.remove('fa-comment-alt');
        popupIcons.classList.add('fa-comment');
    }
});

function closeForms() {
    contactForms.style.display = 'none';
    overlays.style.display = 'none';
    popupIcons.classList.remove('fa-comment');
    popupIcons.classList.add('fa-comment-alt');
}

overlays.addEventListener('click', function () {
    closeForms();
});




CreateRoomBtn.addEventListener('click', () => {
    let NewRoom = {
        members: $("#Members").val(),
        roomName: RoomName.value
    };
    $.ajax({
        type: "POST",
        url: "index.php?page=discussion",
        data: NewRoom,
        success: (response) => {
            console.log(response);
        },
        error: (error) => {
            console.log(error);
        }
    })
    location.reload();
});

const rooms = document.querySelectorAll('.rooms');
const chatCore = document.getElementById('chatCore');
let currentRoom = 0;
let currentRoomName;

ProfileBtn.addEventListener('click', ()=>{
    profile.classList.remove("hidden");
    ChatBody.classList.add("hidden");
    lastInput.classList.add("hidden");
    chatHeader.classList.add("hidden");
    PopupIc.classList.add("hidden");
});

rooms.forEach((room) => {
    room.addEventListener("click", () => {
        const roomId = $(room).data("room-id");
        const roomName = $(room).data("room-name");
        currentRoom = roomId;
        currentRoomName = roomName;
        // console.log($("#RmName"));

        document.getElementById("RmName").innerHTML = `<p class=\"font-bold\">${currentRoomName}</p>`;
        ChatBody.classList.remove("hidden");
        profile.classList.add("hidden");
        lastInput.classList.remove("hidden");
        chatHeader.classList.remove("hidden");
        PopupIc.classList.remove("hidden");
        getRoomMemeber(roomId);
        getRoomId(currentRoom);
        displayMessage(currentRoom);
    })
})

const chatInput = document.getElementById('chat-input');
const chatBtn = document.getElementById('chat-btn');

chatBtn.addEventListener('click', () => {
    let messageValue = chatInput.value;

    $.ajax({
        type: "POST",
        url: "index.php?page=discussion",
        data: {
            messageValue,
            currentRoom,
            req: "InsertChat"
        },
        success: (data) => {
            displayMessage(currentRoom);
            console.log(data);
            chatInput.value = "";
        }
    })


})

let lastMessageId = 0;

function displayMessage(roomid) {
    chatCore.innerHTML = "";
    $.ajax({
        type: "POST",
        url: "index.php?page=discussion",
        data: {
            req: "chat",
            roomid

        },
        success: (data) => {
            console.log(data);
            let chatData = JSON.parse(data);

            chatData.forEach((message) => {
                let date = formatTimestamp(message.date);
                chatCore.innerHTML += `<p class="p-4 text-center text-sm text-gray-500">${date}</p>
<div class="flex flex-row mb-2">
    <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
        <img class="shadow-md rounded-full w-full h-full object-cover"
         src="assets/pictures/${message.picture}"
         alt=""
        />
    </div>
    <div>
    
    <p class="text-sm">${message.username}</p>
    
    
    </div>
</div>
<div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
    <div id="chat-section" class="flex items-center group">
        <p class="px-6 py-3 ml-4 rounded-b-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">
            ${message.message}</p>
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

`;


            });
        }
    })
}


const RoomMembers = document.getElementById('RoomMembers');

function getRoomMemeber(roomId){
    $.ajax({
        type : "POST",
        url : "index.php?page=discussion",
        data : {
            roomId,
            req : "members"},
        success: (data) => {
            console.log(data);
            RoomMembers.innerHTML = '';
            let MemberData = JSON.parse(data);
            MemberData.forEach((member) => {
                RoomMembers.innerHTML += `<div class="flex justify-between mb-4 items-center">
                                        <div class="flex items-center">
                                            <div class="mr-4 w-12 h-12 rounded shadow">
                                                <img class="w-full h-full overflow-hidden object-cover object-center rounded" src="./assets/pictures/${member.picture}" alt="avatar" />
                                            </div>
                                            <div>
                                                <h3 class="mb-2 sm:mb-1 text-black text-base font-normal leading-4">${member.name}</h3>
                                            </div>
                                        </div>
                                        <div class="relative font-normal text-xs sm:text-sm flex items-center text-gray-600">
                                            <button>profile</button>
                                            <button>Remove</button>

                                        </div>
                                    </div>`;
            })
        }
    })
}

function getRoomId(roomId){
    $.ajax({
        type : "POST",
        url : "index.php?page=discussion",
        data : {
            roomId ,
            req : "getRoomId"},
        success: (data) => {
            console.log(data);
        }
    })
}

$(document).ready(function() {
    $('.rooms').on('click', function() {

        var roomName = $(this).data('room-name');
        var roomCreator = $(this).data('room-creator');
        var roomId = $(this).data('room-id');

        // Do something with the data
        console.log('Room Name:', roomName);
        console.log('Room Creator:', roomCreator);
        console.log('Room ID:', roomId);

    });
});





// setInterval(function() {
//     displayMessage();
//     console.log ('testing');
// }, 500);























function formatTimestamp(timestamp) {
    // Convert timestamp to milliseconds
    const date = new Date(timestamp * 1000);

    // Extract components
    const day = date.getDate();
    const month = date.getMonth() + 1; // Months are zero-based
    const year = date.getFullYear();

    const hours = date.getHours();
    const minutes = date.getMinutes();

    // Check if it's a full date or just time
    if (day !== 1 || month !== 1 || year !== 1970) {
        return `${day}/${month < 10 ? '0' : ''}${month}/${year}, ${hours}:${minutes < 10 ? '0' : ''}${minutes}`;
    } else {
        return `${hours}:${minutes < 10 ? '0' : ''}${minutes}`;
    }
}

