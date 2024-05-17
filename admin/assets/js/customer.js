const WEEK = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];

function updateTime(){
    var now = new Date();

    var hours = zeroPadding(now.getHours(), 2);
    var suffix = hours >= 12 ? "PM" : "AM";
    if (hours > 12) {
        hours -= 12;
    } else if (hours === 0) {
        hours = 12;
    }
    
    document.getElementById("time").innerText = 
    zeroPadding(now.getHours(), 2) + ":" + 
    zeroPadding(now.getMinutes(), 2) + ":" + 
    zeroPadding(now.getSeconds(), 2) + " " + suffix;
    //hours + ":" + zeroPadding(now.getMinutes(), 2) + " " + suffix;
    //zeroPadding(now.getTime(), 2);

    document.getElementById("date").innerText = 
    now.getFullYear() + "_" + 
    zeroPadding(now.getMonth() + 1, 2) + "_" + 
    zeroPadding(now.getDate(), 2) + " " + 
    WEEK[now.getDay()];
}

updateTime();
setInterval(updateTime, 1000);

function zeroPadding(num, digit){
    return String(num).padStart(digit, '0');
}

// for increment and decrement button
$(document).ready(function() {
    
    alertify.set('notifier','position','top-right');

    $(document).on('click', '.increment', function() {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var productQty = $(this).closest('.qtyBox').find('.prodQty').val();
        var $currentValue = parseInt($quantityInput.val());

        if(!isNaN($currentValue) && $currentValue < productQty){
            var qtyVal = $currentValue + 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);// call function
        }
    });
    $(document).on('click', '.decrement', function() {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var $currentValue = parseInt($quantityInput.val());

        if(!isNaN($currentValue) && $currentValue > 1){
            var qtyVal = $currentValue - 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);// call function
        }
    });

    function quantityIncDec(prodId, qty){
        $.ajax({
            type: "POST",
            url: "OrderCode.php",
            data: {
                'productIncDec': true,
                'prod_id': prodId,
                'prod_qty': qty
            },
            success: function (response) {
                var res = JSON.parse(response);
                if(res.status == 200){
                    //window.location.reload();
                    $('#productArea').load(' #productContent');
                    alertify.success(res.message);
                }else{
                    $('#productArea').load(' #productContent');
                    alertify.success(res.message);
                }
            }
        })
    };
    // proceed to place order
    $(document).on('click','.proceedToPlace', function(){
        
        var payment_mode = $('#payment_mode').val();
        var cphone = $('#cphone').val();

        if(payment_mode == ''){
            swal("Select Payment Mode","Select your payment mode","warning");
            return false;
        }
        if(cphone == '' && !$.isNumeric(cphone)){
            swal("Customer Phone Number","Please Enter Customer Phone Number","warning");
            return false;
        }
        var data = {
            'proceedToPlaceBtn': true,
            'cphone': cphone,
            'payment_mode': payment_mode
        };
        $.ajax({
            type: "POST",
            url:"OrderCode.php",
            data: data,
            success: function (response) {
                var res = JSON.parse(response);
                if(res.status == 200){
                    window.location.href = "OrderSummary.php";
                }else if(res.status == 404){
                    swal(res.message, res.message, res.status_type, {
                        buttons: {
                            catch: {
                                text: "Add Customer",
                                value: "catch"
                            },
                            cancel: "Cancel"
                        }
                    })
                    .then((value) => {
                        switch(value){
                            case "catch":
                                $('#c_phone').val(cphone);
                                $('#addCustomerModal').modal('show');
                                //console.log('Pop');
                                break;
                            default:
                        }
                    });
                }else{
                    swal(res.message, res.message, res.status_type);
                }
            }
        });
    })
    // for saving new customer data
    $(document).on('click','.saveCustomer', function () {
 
        var c_name = $('#c_name').val();
        var c_phone = $('#c_phone').val();
        var c_email = $('#c_email').val();

        if(c_name !='' && c_phone !=''){
           if($.isNumeric(c_phone)){
              var data2 = {
                 'saveCustomerBtn': true,
                 'c_name': c_name,
                 'c_email': c_email,
                 'c_phone': c_phone,
              };
              $.ajax({
                type: "POST",
                url:"InsertCode.php",
                data: data2,
                success: function (response) {
                    var res = JSON.parse(response);
                    if(res.status == 200){
                        swal(res.message, res.message, res.status_type);
                        $('#addCustomerModal').modal('hide');
                    }else if(res.status == 422){
                        swal(res.message, res.message, res.status_type);
                    }else{
                        swal(res.message, res.message, res.status_type);
                    }
                }
              });

           }
        }else{
            swal("please fill required fields","","warning");
        }
    });

    //for saving Order into database.
    $(document).on('click', '#SaveOrder', function () {

        $.ajax({
            type: "POST",
            url: "OrderCode.php",
            data: {
                'saveOrder': true
            },
            success: function (response) {
                var res = JSON.parse(response);

                if(res.status == 200){
                    swal(res.message,res.message,res.status_type);
                    $('#orderPlaceSuccessMessage').text(res.message);
                    $('#orderSuccessModal').modal('show');
                }else{
                    swal(res.message,res.message,res.status_type);
                }
            }
        });
    });

});


