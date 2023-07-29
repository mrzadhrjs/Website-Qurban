$(document).ready(function() {
    var optarray = $("#layout_select").children('option').map(function() {
        return {
            "value": this.value,
            "option": "<option value='" + this.value + "'>" + this.text + "</option>"
        }
    })

    $("#column_select").change(function() {
        $("#layout_select").children('option').remove();
        var addoptarr = [];
        for (i = 0; i < optarray.length; i++) {
            if (optarray[i].value.indexOf($(this).val()) > -1) {
                addoptarr.push(optarray[i].option);
            }
        }
        $("#layout_select").html(addoptarr.join('')).selectpicker('refresh')
       
    }).change();
})

$(document).ready(function() {

    var optarray = $("#bobot").children('option').map(function() {
        return {
            "value": this.value,
            "option": "<option value='" + this.value + "'>" + this.text + "</option>"
        }
    })

    $("#grade").change(function() {
        $("#bobot").children('option').remove();
        var addoptarr = [];
        for (i = 0; i < optarray.length; i++) {
            if (optarray[i].value.indexOf($(this).val()) > -1) {
                addoptarr.push(optarray[i].option);
            }
        }
        $("#bobot").html(addoptarr.join('')).selectpicker('refresh');  

        $('#bobot').change(function() {
            $('span[id^="bobot-harga-"]').hide();
            var selectedOptionVal = $(this).val();
            $('#bobot-harga-' + selectedOptionVal).show();
        }).change();   

    }).change();

    // $('#exampleModalCenter').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget); // Button that triggered the modal
    //     var hewan = button.closest('li').find('.media-heading').text(); // Get the hewan value from the clicked image's parent li
    //     var modal = $(this);
    //     modal.find('.modal-title').text(hewan);
    // });

    $('#submitButton').click(function(e) {
        e.preventDefault(); // Prevent default hyperlink behavior
  
        // Programmatically submit the form
        $('#logoutForm').submit();
    });


    // function showAddBobot(id) {
    //     $("#bt-bobot" + id).hide();
    //     $("#add-bobot" + id).show();
    //   }

    $('.bt-bobot').click(function() {
        var modal = $(this).closest('.modal'); // Find the parent modal
        var addBobotSection = modal.find('.add-bobot'); // Find the associated add-bobot section
        var addBobotButton = modal.find('.add-bobot-button'); // Find the associated add-bobot-button
        
        // Hide the "bt-bobot" button
        $(this).hide();
    
        // Show the "add-bobot" section and "add-bobot-button"
        addBobotSection.show();
        addBobotButton.show();
    });

    $('#bt-pembayaran').click(function() {
        // Hide the "Lakukan Pembayaran" button
        $(this).hide();
        
        // Show the "upload-bp" section and button
        $('#upload-bp').show();
        $('#upload-bp-button').show();
    });

    $('#verSubmit').click(function(e) {
        e.preventDefault(); // Prevent the link from navigating to another page

        // Trigger the form submission action
        $('#verForm').submit();
    });
 
        // Add click event handler to each clickable row
        $('.clickable-row').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior
            // Toggle the visibility of the next row
            $(this).closest('tr').next('.hidden-row').toggle();
        });

        $('#nama1').change(function() {
            var selectedId = $(this).val();
            var selectedValue = $('.nama2-select[data-hewan-id="' + selectedId + '"]').val();
        
            // Sembunyikan semua select option kedua
            $('.nama2-select').hide();
        
            // Tampilkan select option kedua yang sesuai dengan id select option pertama yang terpilih
            $('.nama2-select[data-hewan-id="' + selectedId + '"]').show();
        
            // Setel kembali nilai select option kedua yang terpilih setelah perubahan
            $('.nama2-select[data-hewan-id="' + selectedId + '"]').val(selectedValue);
        }).change();
        
        $('#whatsappButton').on('click', function(event) {
            event.preventDefault();
            
            var adminPhoneNumber = '087873031310'; // Replace with the admin's WhatsApp number
            var message = 'Assalamualaikum admin, saya ingin verifikasi pembelian.'; // Replace with the default message you want to send
            
            var whatsappURL = 'https://api.whatsapp.com/send?phone=' + adminPhoneNumber + '&text=' + encodeURIComponent(message);
            window.open(whatsappURL, '_blank');
        });

        // $("#exampleModalCenter").modal("show");

})



