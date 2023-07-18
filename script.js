function validation(){
    var firnameid = document.getElementById("fname");
    var lnameid = document.getElementById("lname");            
    var phnoid = document.getElementById("phno");
    var cityid = document.getElementById("City");
    var stateid = document.getElementById("State");
    var Pincodeid = document.getElementById("Pincode");
    let dateid = new Date(document.getElementById("dob").value);

    var pinee = Pincodeid.value.trim();
    var pstree = phnoid.value.trim();
    // window.alert(pinee.length);
    // window.alert(pstree.length);
    var numpin = pinee.length;
    var numpho = pstree.length;

    var emailID = document.myform.email.value; 
    atpos = emailID.indexOf("@"); 
    dotpos = emailID.lastIndexOf("."); 
    if (atpos < 1 || ( (dotpos - atpos) < 2 )) { 
        alert("Please enter correct email ID") ;
        return false;
    }             
    else if(firnameid.value.trim()==""){
        window.alert("Blank First name");
        return false;
    }
    else if(lnameid.value.trim()==""){
        window.alert("Blank Last name");
        return false;
    }
    else if(phnoid.value.trim()==""){
        window.alert("Blank Phone Number");
        return false;
    }
    else if(numpho!=10){
        window.alert("Enter correct Phone Number");
        return false;
    }
    else if(dateid==""){
        window.alert("Enter Date of birthday");
        return false;
    }
    else if(streetid.value.trim()==""){
        window.alert("Blank Street");
        return false;
    }
    else if(cityid.value.trim()==""){
        window.alert("Blank City");
        return false;
    }
    else if(stateid.value.trim()==""){
        window.alert("Blank State");
        return false;
    }
    else if(Countryid.value.trim()==""){
        window.alert("Blank Country");
        return false;
    }
    else if(Pincodeid.value.trim()==""){
        window.alert("Blank Pincode");
        return false;
    }
    else if(numpin!=6)            {
        window.alert("Enter Correct Pincode");
        return false;
    }
}