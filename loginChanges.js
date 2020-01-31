/* 

    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    loginChanges.js is the JavaScript file used to control the functionality 
    on the index page. loginChanges toggles between the log in form and the 
    registration form. It also has event listeners on the form inputs to 
    provide feedback to the user. For example, if their passwords match on
    the registration page. It also does not allow a user to submit a username
    if it already exists or the passwords don't match.

*/

/**
 * Event listener for window load event. 
 * Allows html to load first.
 */
window.addEventListener("load",()=>{
    //Button to toggle registration form view
    let clickToReg = document.getElementById("clickToReg");
    //1st password input on registration form
    let passwordReg1 = document.getElementById("passwordReg1");
    //2nd password input on registration form
    let passwordReg2 = document.getElementById("passwordReg2");
    //username input on registration form
    let userNameReg = document.getElementById("userNameReg");
    //submit button for registration form
    let subButtonReg = document.getElementById("subButtonReg");
    //Button to toggle login form view
    let backToLoginButton = document.getElementById("backToLoginButton"); 
    

    

    //---------------------Show registration menu------------------------//

    /**
     * Event listener clickToReg button which toggles
     * registration view.
     * It also sets the form back to initial state (i.e. no input).
     */
    clickToReg.addEventListener("click", ()=>{
        $("#regContainer").slideToggle("slow");
        $("#loginContainer").hide();
        $("#userNameReg").val("");
        $(passwordReg1).val("");
        $(passwordReg2).val("");
        $("#msg").html("");
    })

    //---------------Event listener for valid password---------------------//

    /**
     * Event listener for the second password input
     * Checks to see if password is valid or not
     * while user is typing. 
     * !!!NOTE: This only works if user enters password
     * into the first password before this one. May fix 
     * this later.
     *  
     */
    passwordReg2.addEventListener("keyup",()=>{
        if(passwordReg1.value.length >= 3){
            if(passwordReg2.value === passwordReg1.value){
                subButtonReg.disabled = false;
                $("#msg").css("color", "green").html("Valid password");
            }else{
                $("#msg").css("color", "red").html("Password not valid");
                subButtonReg.disabled = true;
            }
        }else{
            $("#msg").css("color", "red").html("Password not valid");
            subButtonReg.disabled = true;
        }
        
        
    })


   
    //----------------------Back to login after success registration---------------//

    /**
     * Toggles the login view and hides the registration form
     */
    let backToLogin = ()=>{
            $("#regContainer").hide();
            $("#loginContainer").slideToggle("slow");
            subButtonReg.disabled = true;
    }

    //----------------------SUBMIT OF REGISTRATION---------------------//
    /**
     * Event listener for Registration submit button
     * When clicked ajax call made to registration.php
     * which checks to see if the user exists already.
     * If user doesn't already exist the user is added to the
     * database and sent back to the login page.
     * If user does exist message is displayed for user saying
     * user exists.
     */
    subButtonReg.addEventListener("click", (event)=>{
        event.preventDefault();
        let params = "passwordReg1=" + passwordReg1.value + "&passwordReg2=" + passwordReg2.value +
                     "&userNameReg=" + userNameReg.value;

        fetch("registration.php", {
                                    credentials: "include",
                                    method: "POST",
                                    headers: {"Content-Type": "application/x-www-form-urlencoded"},
                                    body: params
        })
        .then(Response => Response.json())
        .then((valid)=>{
            console.log(valid);
            if(valid){
                backToLogin();
            } else{
                $("#msg").css("color", "red").html("Username not valid. Already exists or null");
            }
        })
        

    })


    /**
     * Event listener for the backToLoginButton
     * When clicked the back to login function is called 
     * and login form is toggled
     * 
     */
    backToLoginButton.addEventListener("click", (event)=>{
        backToLogin();
    })
 
})