// //VIEW BOOKING SELECTION

$('#select-room-button').submit(function () {

    $.ajax({
        method: "GET",
        url: "apis/api-select-room-and-display-room-info.php",
        
        dataType: "JSON",
        cache: false
    }).done(function (jData) {
        
         
        console.log(jData)

    }).fail(function () {
        console.log('search API does not work')
    });

    return false
})

//BOOK ROOM
$('#frmBookRoom').submit(function () {

    $.ajax({
        method: "POST",
        url: "apis/api-insert-guest-info.php",
        data: $('#frmBookRoom').serialize(),
        dataType: "JSON",
        cache: false
    }).done(function (jData) {
        console.log(jData)
        
        if (jData.status === 0) {

            swal({   

                text: jData.message,
                icon: "warning",
            });
        } else  if (jData.status === 1) {

           location.href = 'booking-confirmation?reservation-id='+jData.message;
        }

    }).fail(function () {
        console.log('search API does not work')
    });

    return false
})
