// $('#frmLogin').submit(function () {

//     $.ajax({
//         method: "POST",
//         url: "apis/api-admin-login.php",
//         data: $('#frmLogin').serialize(),
//         dataType: "json"
//     }).done(function (jData, msg, res) {
//         console.log(jData)
//         if (msg === "success" && jData.status === 1) {

//             location.href = 'admin-page'
//         }

//     }).fail(function () {
//         console.log('login API does not work')
//     });

//     return false
// })




$('#frmSearchName').submit(function () {

    $.ajax({
        method: "GET",
        url: "apis/api-search-booking-name.php",
        data: $('#txtSearchName').serialize(),
        dataType: "JSON",
        cache: false
    }).done(function (jData) {
console.log(jData)  
        if (jData.status === 0) {

            swal({

                text: jData.message,
                icon: "warning",
            });
        } else {
            $("#lblSearch").html(" ")
            for (let jDataKey in jData) {
                
                //I should've used const instead of let as the data does not change 
                let data = jData[jDataKey] //get object from key
                let reservationId = data.reservations_id
                let firstName = data.first_name
                let lastName = data.last_name
                let checkIn = data.check_in_date
                let checkOut = data.check_out_date
                let status = data.status
                let roomType = data.room_type
                //let description = data.description
                  let sData = `
                
                          
                <tr>
                            <td class = "name">${firstName+' '+lastName}</td> 
                            <td class = "check-in">${checkIn}</td> 
                            <td class = "check-out">${checkOut}</td> 
                            <td class = "roomType">${roomType}</td> 
                            <td class = "price">${'3000,-'}</td> 
                            <td class = "status">${status}</td> 
                            <td class = "booking-id">${reservationId}</td> 
                           <td><a href = 'manage-booking?reservation-id=${reservationId}'><button class="admin-button">MANAGE BOOKING</button></a></td>
                       
                        </tr>
                    
                ` 
                                  
               $("#lblSearch").append(sData)
                
            }
        }     


    }).fail(function () {
        console.log('search API does not work')
    });

    return false
})


// //delete booking
// $('#deleteBookingBtn').submit(function () {

//             $.ajax({
//                     method: "GET",
//                     url: "apis/api-delete-booking.php",

//                     cache: false
//                 }).done(function (jData) {
// console.log(jData);
//                         if (jData.status === 1) {

//                             swal({

//                                 text: jData.message,
//                                 icon: "warning",
//                             });
//                         }
//                             }).fail(function () {
//                                 console.log('search API does not work')
//                             });

//                             return false
//                             })




$('#frmEditBooking').submit(function () {

    $.ajax({
        method: "GET",
        url: "apis/api-search-booking-name.php",
        data: $('#txtSearchName').serialize(),
        dataType: "JSON",
        cache: false
    }).done(function (jData) {
        console.log(jData)
        if (jData.status === 0) {

            swal({

                text: jData.message,
                icon: "warning",
            });
        } else {
            $("#lblSearch").html(" ")
            for (let jDataKey in jData) {
                //console.log(jDataKey)
                let data = jData[jDataKey] //get object from key
                let reservationId = data.reservations_id
                let firstName = data.first_name
                let lastName = data.last_name
                let checkIn = data.check_in_date
                let checkOut = data.check_out_date
                let status = data.status
                let roomType = data.room_type
                //let description = data.description
                let sData = `
                
                          
                <tr>
                            <td class = "name">${firstName+' '+lastName}</td> 
                            <td class = "check-in">${checkIn}</td> 
                            <td class = "check-out">${checkOut}</td> 
                            <td class = "roomType">${roomType}</td> 
                            <td class = "price">${'3000,-'}</td> 
                            <td class = "status">${status}</td> 
                            <td class = "booking-id">${reservationId}</td> 
                           <td> <a href = 'manage-booking?reservation-id=${reservationId}'> <button class = "admin-search">MANAGE BOOKING</button></a></td>
                       
                        </tr>
                    
                `

                $("#lblSearch").append(sData)

            }
        }


    }).fail(function () {
        console.log('search API does not work')
    });

    return false
})




// //delete


// $('#deleteBookingBtn').submit(function () {

//     $.ajax({
//         method: "POST",
//         url: "apis/api-delete-booking",
//         data: $('#deleteBookingBtn').serialize(),
//         dataType: "json",
//         cache: false
//     }).
//     done(function (jData) {
//         console.log(jData)
//         if (jData.status === 1) {
//             swal({
//                 title: "CONGRATS",
//                 text: "You have added money",
//                 icon: "success",
//             });
//         } else {
//             swal({
//                 title: "SYSTEM UPDATE",
//                 text: "System is under maintainance code:" + jData.code,
//                 icon: "warning",
//             });
//         }
//     }).
//     fail(function (error) {
//         console.log('error', error)
//     })



//     return false
// })
