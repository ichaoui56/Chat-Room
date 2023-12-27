const CreateRoomBtn = document.getElementById('CreateRoomBtn');
const RoomName = document.getElementById('RoomName');
const Core = document.getElementById("Core");
const profile = document.getElementById("profile");
const ProfileBtn = document.getElementById("ProfileBtn");
const ChatBody = document.getElementById("chat-body");
const ChatFooter = document.getElementById("chat-footer");




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

