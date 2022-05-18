
function checkEmail() {
var email = document.getElementById('email');
    var filter =  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@Traveller\.[a-zA-Z0-9-]+$/i;

    if (!filter.test(email.value)) {
    alert("Please provide a valid email that belongs to the Admin ");
    email.focus;
    return false;
 }else{
     form.elements[0].submit();
    //  window.location.href = "./adminHP.php";
          return true;  }
}


