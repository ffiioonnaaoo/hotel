// //SEARCH ROOM AVAILABILITY
//In general the indentation could be improved 

$('#frmSearchRooms').submit(function () {

    $.ajax({
        method: "GET",
        url: "apis/api-show-available-rooms.php",
        data: $('#frmSearchRooms').serialize(),
        dataType: "JSON",
        cache: false
    }).done(function (jData) {
     
        if (jData.status === 0) {

            swal({

                text: jData.message,
                icon: "warning",
            });
        }
       
        else  {
            $("div#roomPlaceHolder").html(" ")
                for (let jDataKey in jData){
                //console.log(jDataKey)
                let data = jData[jDataKey] //get object from key
                let roomId = data.room_id
                let roomType = data.room_type
                let description = data.description 
                let photo = data.photo_url 
                let rate = data.rate 
                let sData = `
                
                    <div class="room-desc-container">
                    
                       
                        <img src="images/${photo}"class="room-img">
                    <div class="desc-cont">
                        <h3>${roomType}</h3>
                          <p>${description}</p>
                            <h3>${rate},- per night</h3>
                         
                        <a href = 'book-room?room-id=${roomId}'> <button class="book-btn"> Book </button></a>
                         </div>
                    
                    
                ` 
                                          
               $('div#roomPlaceHolder').append(sData)
                
            }
          
        }

    
    }).fail(function () {
        console.log('search API does not work')
    });

    return false
})

