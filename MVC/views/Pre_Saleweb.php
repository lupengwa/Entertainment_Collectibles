<!DOCTYPE html>
<html>
<head>
    <link href="/CodeIgniter/application/style/style.css" rel="stylesheet" type="text/css">
    <meta name=""viewport" content="width=device-width,initial-scale=1.0">
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    </script>
    <script>

        //Category List
        $(document).ready(createOption);
        function createOption() {
            $.ajax({
                url:"/CodeIgniter/index.php/Cate_control",
                type:"POST",
                success:function(result){
                    var content = JSON.parse(result);
                    var x =$('#category');
                    for (i = 0; i < content.length; i++) {
                        y = document.createElement("option");
                        y.value = content[i++];
                        y.text = content[i];
                        $('#category').append($('<option>', {
                            value: y.value,
                            text : y.text
                        }));

                    }
                },
                error:function(xhr) {
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });

            /*if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var content = JSON.parse(xmlhttp.responseText);
                    var x = document.getElementById("category");
                    for (i = 0; i < content.length; i++) {
                        y = document.createElement("option");
                        y.value = content[i++];
                        y.text = content[i];
                        x.appendChild(y);
                    }
                }
            }
            xmlhttp.open("GET", "/HW3/cate.php", true);
            xmlhttp.send();*/

        }

        //SEARCH function
        $(document).ready(job);
        function job() {
            $(".search").click(searchItem);
            function searchItem() {
                var cate = $('#category').val();
                var content = $('#searchContent').val();
                if (cate == "" && content == "") {
                  $('#error').html("Please select a category or enter the items in search field");
                    $('#Items').html("");
                } else if (cate != "" && content == "") {

                    $.ajax({
                        url:"/CodeIgniter/index.php/Search_control",
                        type:"POST",
                        data:"cate="+cate,
                        success:function(result){
                            $('#error').html("");
                            $('#Items').html(result);
                            //alert(result);

                        },
                        error:function(xhr) {
                            alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }
                    });

                } else {
                    $.ajax({
                        url:"/CodeIgniter/index.php/Search_control",
                        type:"POST",
                        data:"content="+content,
                        success:function(result){
                            $('#error').html("");
                            $('#Items').html(result);
                            //alert(result);

                        },
                        error:function(xhr) {
                            alert("An error occured: " + xhr.status + " " + xhr.statusText);
                        }
                    });

                }
            }
        }

        $(document).ready(start_getCustomer);
        function start_getCustomer() {
            $('#profile_info').click(getCustomer);

            function getCustomer() {
                //document.getElementById("webInput").style.display = "none";
                //document.getElementById("Items").style.display = "none";
                //document.getElementById("change").style.display = "inline";
                $('#webInput').css('display', 'none');
                $("#Items").css('display', 'none');
                $('#change').css('display', "inline");
                $.ajax({
                    url:"/CodeIgniter/index.php/Customer_infor_control",
                    type:"POST",
                    success:function(result){
                        $('#cusInfor').html(result);
                        //alert(result);

                    },
                    error:function(xhr) {
                        alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    }
                });
                /*
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cusInfor").innerHTML = xmlhttp.responseText;
                    }

                }
                xmlhttp.open("GET", "/HW3/customerInfo.php", true);
                xmlhttp.send();*/
            }
        }

        function check(x) {
            if(/[^a-zA-Z0-9]/.test(x.username.value)){
                alert("User Name only can have letters or numbers");
                return false;
            } else if(/[^a-zA-Z0-9]/.test(x.password.value)){
                alert("Password only can have letters or numbers");
                return false;
            } else {
                return true;
            }

        }

    </script>
</head>
<body background="back2.jpg">