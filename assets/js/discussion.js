const CreateRoomBtn = document.getElementById('CreateRoomBtn');
const RoomName = document.getElementById('RoomName');

CreateRoomBtn.addEventListener('click' ,()=>{
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
});
