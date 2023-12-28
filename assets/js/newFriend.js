


const addNewFriendBtn = document.getElementById('addNewFriendFormBtn');
const addNewFriendForm = document.getElementById("member-form");
const closeNewFriendForm = document.getElementById("friend-close-btn");
const addFriendFormBtn = document.getElementById("addNewFriendBtn");

addNewFriendBtn.addEventListener("click", () => {
    addNewFriendForm.classList.remove('hidden');
})

closeNewFriendForm.addEventListener("click", () => {
    addNewFriendForm.classList.add('hidden');
})

addFriendFormBtn.addEventListener("click", () => {
    let newFriend = $("#newFriend").val();

    addNewFriend(newFriend)

})

function addNewFriend(friend) {
    $.ajax({
        type: "POST",
        url: "index.php?page=discussion",
        data: {friend},
        success: (data) => {
            console.log(data);
        }
    })
}

const roomInviteSection = document.getElementById("invitation-section");
let roomInvitationId;
let roomInvitationRoomId;

function displayRoomInvitation() {

    $.ajax({
        type: "POST",
        url: "index.php?page=discussion",
        data: {req: "invitation"},
        success: (data) => {
            let invitationData = JSON.parse(data);
            if (invitationData.length === 0) {
                roomInviteSection.innerHTML = '<p class="text-gray-700">invitation list is empty</p>'
            } else
                roomInviteSection.innerHTML = "";
            invitationData.forEach((invitation) => {
                roomInviteSection.innerHTML += `
                                        <div data-invitation-id="${invitation.invitation_id}" data-invitation-room-id="${invitation.room_id}" class="text-sm text-center mr-4">
                                        <div class="p-1 border-4 border-transparent rounded-full">
                                            <div class="w-16 h-16 relative flex flex-shrink-0">
                                                <img class="shadow-md rounded-full w-full h-full object-cover"
                                                     src="./assets/pictures/${invitation.picture} "
                                                     alt=""
                                                />
                                                <div class="absolute bg-gray-900 p-1 rounded-full bottom-0 right-0">
                                                    <div class="bg-green-500 rounded-full w-3 h-3">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="accept-invitation text-white bg-green-500">
                                                accept
                                            </button>
                                            <button class="reject-invitation text-white bg-red-500">
                                                decline
                                            </button>
                                        </div>
                                    </div>`;
            })

            let invitationElm;
            $("#room-invite").off("click", ".invite").on("click", ".invite", function () {
                roomInvitationId = $(this).data("invitation-id");
                roomInvitationRoomId = $(this).data("invitation-room-id");
                invitationElm = $(this);
            });

            const rejectBtn = document.querySelectorAll(".reject-invitation");
            const acceptBtn = document.querySelectorAll(".accept-invitation");


            rejectBtn.forEach((reject) => {
                $(reject).off("click").on("click", () => {
                    $.ajax({
                        type: "POST",
                        url: "index.php?page=discussion",
                        data: {rejectRoomInvitation: true, roomInvitationId},
                        success: (data) => {
                            console.log(data);
                            $(invitationElm).remove();
                        }
                    })
                });
            });

            acceptBtn.forEach((accept) => {
                $(accept).off("click").on("click", () => {
                    console.log(roomInvitationRoomId);
                    $.ajax({
                        type: "POST",
                        url: "controllers/home_controller.php",
                        data: {acceptRoomInvitation: true, roomInvitationId, roomInvitationRoomId},
                        success: (data) => {
                            console.log(data);
                            $(invitationElm).remove();
                            displayRooms();
                        }
                    })
                });
            });
        }
    });
}
