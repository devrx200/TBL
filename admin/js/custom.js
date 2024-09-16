// jquery data table 
    $(document).ready(function() {
        $('#example').DataTable();
    });


function validatePhoneNumber(input) {
    const pattern = /^[6789]\d{9}$/;
    input.classList.toggle('is-invalid', !pattern.test(input.value));
}


//FOR ALL ALERT BOX
$(document).ready(function () {
    var msgElement = $('.msg-container');
    msgElement.slideDown(500, function () { // Slide down over 0.5 seconds
        setTimeout(function () {
            msgElement.slideUp(1000); // Slide up over 0.10 seconds
        }, 1500); // Wait for 2 seconds before sliding up
    });
});


//FOR DELETE 
function confirmDelete(id, tableName, tablekey) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '../includes/delete.php',
                data: JSON.stringify({
                    id: id,
                    table: tableName,
                    key: tablekey
                }),
                contentType: 'application/json',
                success: function (response) {
                    Swal.fire(
                        'Deleted!',
                        response,
                        'success'
                    ).then(() => {
                        // Reload the page after a short delay
                        setTimeout(function () {
                            location.reload();
                        }, 100); // 100-millisecond delay
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Error: ' + xhr.responseText,
                        'error'
                    );
                }
            });
        }
    });
}


// For Vidhansabha
$(document).ready(function () {
    $('#districtSelect').change(function () {
        var district_id = $(this).val();
        //  alert("Selected District ID: " + district_id);
        $.ajax({
            url: '../ajax/get_vidhansabha.php',
            type: 'POST',
            data: {
                district_id: district_id
            },
            success: function (data) {
                var vidhansabha = JSON.parse(data);
                $('#vidhansabhaSelect').empty();
                $('#vidhansabhaSelect').append('<option value="">विधानसभा का नाम चुनें</option>');
                $.each(vidhansabha, function (index, vidhansabha) {
                    $('#vidhansabhaSelect').append('<option value="' + vidhansabha.vidhansabha_id + '">' + vidhansabha.vidhansabha_name + '</option>');
                });
            }
        });
    });
});

// For Area Select
$(document).ready(function () {
    $('#vidhansabhaSelect').change(function () {
        var vidhansabha_id = $(this).val();
        //alert("Selected Vidhansabha ID: " + vidhansabha_id);
        $.ajax({
            url: '../ajax/get_area.php',
            type: 'POST',
            data: {
                vidhansabha_id: vidhansabha_id
            },
            success: function (data) {
                // console.log(data);
                var areas = JSON.parse(data);
                $('#areaSelect').empty();
                $('#areaSelect').append('<option value="">क्षेत्र का नाम चुनें</option>');
                $.each(areas, function (index, areas) {
                    $('#areaSelect').append('<option value="' + areas.area_id + '">' + areas.area_name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});

// For vikashkhand
$(document).ready(function () {
    $('#areaSelect').change(function () {
        var area_id = $(this).val();
        var vidhansabha_id = $('#vidhansabhaSelect').val();
        // alert(vidhansabha_id);
        // var vidhansabha_id  = document.getElementById('vidhansabha_id').value;
        //alert("Selected Vidhansabha ID: " + vidhansabha_id);
        $.ajax({
            url: '../ajax/get_vikaskhand.php',
            type: 'POST',
            data: {
                area_id: area_id,
                vidhansabha_id: vidhansabha_id
            },
            success: function (data) {
                var vikaskhand = JSON.parse(data);
                $('#vikaskhandSelect').empty();
                $('#vikaskhandSelect').append('<option selected>विकासखंड का नाम चुनें</option>');
                $.each(vikaskhand, function (index, vikaskhand) {
                    $('#vikaskhandSelect').append('<option value="' + vikaskhand.vikaskhand_id + '">' + vikaskhand.vikaskhand_name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});

// For Sector Load 
$(document).ready(function () {
    $('#vikaskhandSelect').change(function () {
        var vikaskhand_id = $(this).val();
        var area_id = $('#areaSelect').val();
        // alert(vikaskhand_id);
        $.ajax({
            url: '../ajax/get_sector.php', // Replace with your PHP file to fetch sectors
            type: 'POST',
            data: {
                vikaskhand_id: vikaskhand_id,
                area_id: area_id
            },
            success: function (data) {
                var sectors = JSON.parse(data);
                $('#sectorSelect').empty();
                $('#sectorSelect').append('<option>सेक्टर का नाम चुनें</option>');
                $.each(sectors, function (index, sector) { // Changed variable name to 'sector' to avoid conflict
                    $('#sectorSelect').append('<option value="' + sector.sector_id + '">' + sector.sector_name + '</option>'); // Corrected selector
                });
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});

// For Gram Panchayat From Sector id 
$(document).ready(function () {
    $('#sectorSelect').change(function () {
        var sector_id = $(this).val();
        var area_id = $('#areaSelect').val();
        //alert("Selected Sector ID: " + sector_id);
        $.ajax({
            url: '../ajax/get_gram_panchayat.php', // Replace with your PHP file to fetch sectors
            type: 'POST',
            data: {
                sector_id: sector_id,
                area_id: area_id
            },
            success: function (data) {
                var gram_panchayats = JSON.parse(data);
                $('#gramPanchayatSelect').empty();
                $('#gramPanchayatSelect').append('<option selected>ग्राम पंचायत का नाम चुनें</option>');
                $.each(gram_panchayats, function (index, gram_panchayat) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                    $('#gramPanchayatSelect').append('<option value="' + gram_panchayat.gram_panchayat_id + '">' + gram_panchayat.gram_panchayat_name + '</option>'); // Corrected selector
                });
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});

//   For Grams  By Panchayat
$(document).ready(function () {
    $('#gramPanchayatSelect').change(function () {
        var gram_panchayat_id = $(this).val();
        var area_id = $('#areaSelect').val();
        //   alert("Selected Gram Panchayat ID: " + gram_panchayat_id);
        $.ajax({
            url: '../ajax/get_gram.php', // Replace with your PHP file to fetch gram
            type: 'POST',
            data: {
                gram_panchayat_id: gram_panchayat_id,
                area_id: area_id
            },
            success: function (data) {
                var grams = JSON.parse(data);
                $('#gramSelect').empty();
                $('#gramSelect').append('<option selected>ग्राम का नाम चुनें</option>');
                $.each(grams, function (index, gram) { // Changed variable name to ', gram_panchayat_name' to avoid conflict
                    $('#gramSelect').append('<option value="' + gram.gram_id + '">' + gram.gram_name + '</option>'); // Corrected selector
                });
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
});