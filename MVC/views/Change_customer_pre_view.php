<!DOCTYPE html>
<html>
<head>
    <link href="/CodeIgniter/application/style/style.css" rel="stylesheet" type="text/css">
    <meta name=""viewport" content="width=device-width,initial-scale=1.0">
    <script>


        function checkField(x){

            email= x.email.value;
            phone= x.phone.value;
            bState= x.bState.value;
            State= x.State.value;
            var states = [
                "AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA",
                "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD",
                "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ",
                "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC",
                "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY",
                "AS", "DC", "FM", "GU", "MH", "MP", "PR", "PW", "VI"
            ];
            reg = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var current=new Date();
            if(phone.toString().length != 10){
                alert("phone number must be 10 digits");
                return false;
            } else if(/[^a-zA-Z]/.test(x.firstName.value)) {
                alert("First Name only can have letters");
                return false;
            }else if(/[^a-zA-Z]/.test(x.lastName.value)){
                alert("Last Name only can have letters");
                return false;
            }
            else if(!email.match(reg)){
                alert("email format is wrong");
                return false;

            } else if(x.bzip.value.toString().length!=5){
                alert("Billing zip code must be 5 digits");
                return false;
            } else if(x.zip.value.toString().length!=5){
                alert("Shipping zip code must be 5 digits");
                return false;
            } else if(x.cardnumber.value.toString().length!=16){
                alert("card number must be 16 digits");
                return false;
            } else if(x.security.value.toString().length != 3){
                alert("security number must be 3 digits");
                return false;
            }else if(x.year.value==current.getFullYear() && x.month.value<(current.getMonth()+1) ){
                alert("your card has expired");
                return false;
            }else if(/[^a-zA-Z]/.test(x.bstreetName.value)){
                alert("Billing Street Name only can have letters");
                return false;
            }else if(/[^a-zA-Z]/.test(x.streetName.value)){
                alert("Shipping Street Nameonly can have letters");
                return false;
            }else if(/[^a-zA-Z]/.test(x.bcity.value)){
                alert("City Name only can have letters");
                return false;
            }else if(/[^a-zA-Z]/.test(x.city.value)){
                alert("City Name only can have letters");
                return false;
            }else if(/[^a-zA-Z0-9]/.test(x.username.value)){
                alert("User Name only can have letters or numbers");
                return false;
            } else if(/[^a-zA-Z0-9]/.test(x.password.value)){
                alert("Password only can have letters or numbers");
                return false;
            }
            else{
                arrayLength=states.length;
                for( var i=0;i<arrayLength;i++){
                    if(bState==states[i]){
                        break;
                    }
                }
                for( var j=0;j<arrayLength;j++){
                    if(State==states[j]){
                        break;
                    }
                }
                if(i>=arrayLength){
                    alert("The State entered is invalid. Please enter as 'CA'");
                    return false;
                }
                else if(j>=arrayLength){
                    alert("The State entered is invalid. Please enter as 'CA'");
                    return false;
                }else {
                    if(OK==true){
                        return true;
                    }else{
                        alert("username already existed");
                        return false;
                    }

                }
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
