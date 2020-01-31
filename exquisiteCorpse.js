/* 

    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    exquisiteCorpse.js is the JavaScript page which provides the functionality for the 
    Exquisite corpse drawing exhibition. 

    The main functions are:
    1) Click on the "Click here" button and run an ajax call to return a 
       random selection of 3 drawings from the drawing database
    2) Click the randomize button to receive a new random drawing
    3) Click the Save button to save the current drawing to the current user
    4) Click the Load button to load the drawing saved to the current user
    5) Click on any of the drawing sections(Head,Body,Legs) to return a new drawing 
       for the section.
    6) Click the Log out button to log out of the current user and return to the 
       log in page (index.html)


*/


/**
 * Event listener for window load event. 
 * Allows html to load first.
 */
window.addEventListener("load",()=>{

    //img tag for the head drawing
    let head = document.getElementById("head");
    //img tag for the body drawing
    let body = document.getElementById("body");
    //img tag for the legs drawing
    let legs = document.getElementById("legs");
    //Click here container
    let clickHereContainer = document.getElementById("clickHereContainer");
    //Container for the full drawing
    let fullDrawingContainer = document.getElementById("fullDrawingContainer");
    //randomize button
    let randButton = document.getElementById("randButton");
    //save button
    let saveButton = document.getElementById("saveButtonContainer");
    //load button
    let loadButton = document.getElementById("loadButtonContainer");
    //log out button
    let logOutButton = document.getElementById("logOutButtonContainer");
    //Holds the associative array with the current image pathways
    let currentDrawing;
    //ID of current head drawing
    let currentHeadID;
    //ID of current body drawing
    let currentBodyID;
    //ID of current legs drawing
    let currentLegsID;
    

    //--------------------SET SECTIONS---------------------------------//
    //(Used by full body change as well as individual sections)

    /**
     * 
     * Used to change Head image src and fade new image in.
     * Also updates the currentDrawing variable
     * 
     * @param {JSON Object} path 
     */
    let createHead = (path)=>{
        $(head).hide().fadeIn(500).attr("src" , path[0].head);
        currentDrawing.head = path[0].head;
    }

    /**
     * 
     * Used to change Body image src and fade new image in.
     * Also updates the currentDrawing variable
     * 
     * @param {JSON Object} path 
     */
    let createBody = (path)=>{
        $(body).hide().fadeIn(500).attr("src" , path[0].body);
        currentDrawing.body = path[0].body;
        
    }

    /**
     * 
     * Used to change Legs image src and fade new image in.
     * Also updates the currentDrawing variable
     * 
     * @param {JSON Object} path 
     */
    let createLegs = (path)=>{
        $(legs).hide().fadeIn(500).attr("src" , path[0].legs);
        currentDrawing.legs = path[0].legs;
    }


    //---------------CREATE NEW FULL BODY----------------//


    /**
     * 
     * Used to create an entirely new image
     * (Head, Body and Legs). 
     * Changes image src for each section.
     * This function is used on page load and 
     * randomize button click
     * 
     * @param {JSON Object} path 
     */
    let createDrawing = (path)=>{
        createHead(path);
        createBody(path);
        createLegs(path);

    }


    //-----------------------------------MAIN FUNCTIONS---------------------------------------//
    /**
     * RANDOM IMAGE
     * Retrieves a new set of random images and calls create drawing 
     * to set the images on the page
     */
    let getRandomImg = ()=>{
        
        fetch("getImg.php",{credentials:"include"})
        .then(Response => Response.json())
        .then((paths)=>{
            currentDrawing = paths[0];
            createDrawing(paths);
            currentHeadID = currentDrawing.headID;
            currentBodyID = currentDrawing.bodyID;
            currentLegsID = currentDrawing.legsID;
        })
        loadDrawing();
    }

    /**
     * LOAD
     * Sets user drawing via createDrawing
     * @param {JSON Object} paths 
     */
    let loadUserDrawing = (paths) =>{
            createDrawing(paths);
    }




    /**
     * SAVE
     * Makes an ajax call to saveDrawing.php which saves the current 
     * drawing to the current user.
     * Sends img src for all drawing sections along with the id for each section
     */
    let saveDrawing = () =>{

        let url = "saveDrawing.php?head=" + currentDrawing.head + "&body=" + currentDrawing.body + "&legs=" + currentDrawing.legs  
        + "&head_id=" + currentHeadID + "&body_id=" + currentBodyID + "&legs_id=" + currentLegsID;

        fetch(url, {credentials:"include"})
        .then(Response => Response.text())
        .then((paths)=>{
            console.log("clicked");
            console.log(paths);
            
        })
        
    }


/**
 * LOAD
 * Makes an ajax call to load.php
 * If returned object is not empty then it sets the current 
 * drawing and section IDs to those recieved from current user 
 * in the database
 */
    let loadDrawing = ()=>{
        fetch("load.php", {credentials:"include"})
        .then(Response => Response.json())
        .then((paths)=>{
            //console.log(paths[0]);
            if(paths[0].head !== null){
                currentDrawing = paths[0];
                currentHeadID = currentDrawing.headID;
                currentBodyID = currentDrawing.bodyID;
                currentLegsID = currentDrawing.legsID;
                loadUserDrawing(paths);
            }
             
        })
    }
    loadDrawing();



/**
 * LOG OUT
 * Makes an ajax call to logOut.php to destroy the session
 * Logs the user out and sends them back to index.html
 */
let logOut = () =>{
    fetch("logOut.php", {credentials:"include"})
    .then(Response=>Response.text())
    .then((message)=>{
        window.location.assign("index.html");
    })
}

//-----------------------------------LISTENERS---------------------------------------//



    /**
     * RANDOMIZE BUTTON
     * Event Listener for randomize button
     * calls getRandomImg function on click
     */
    randButton.addEventListener("click", ()=>{
        getRandomImg();
    })


//----------------Listener for SAVE button-----------------//


     /**
      * SAVE BUTTON
     * Event Listener for save button
     * calls saveDrawing function on click
     */
    saveButton.addEventListener("click", ()=>{
        saveDrawing();
    })



//--------------Listener for load button------------------//

    /**
     * LOAD BUTTON
     * Event Listener for load button
     * calls loadDrawing function on click
     */
    loadButton.addEventListener("click", ()=>{
        if(currentDrawing !== undefined){
            loadDrawing();
        }
    })

//--------------Listener for Log out button------------------//

     /**
      * LOG-OUT BUTTON
     * Event Listener for log-out button
     * calls logOut function on click
     */
    logOutButton.addEventListener("click", ()=>{
        logOut();
    })

//-----------------CLICKING ON BODY SECTIONS---------------//

     /**
      * HEAD SECTION
     * Event Listener for head section of drawing
     * ajax call is made to changeHead.php and recieves 
     * the next head img path 
     * The createHead function is then called and 
     * new head image is set 
     */
    head.addEventListener("click", ()=>{
        let url = "changeHead.php?currentHeadID=" + currentHeadID
        fetch(url,{credentials:"include"})
        .then(Response => Response.json())
        .then((path)=>
            {
            createHead(path);
            currentHeadID = path[0].currentHeadID;
            console.log(currentHeadID);
            })
        });

     /**
      * BODY SECTION
     * Event Listener for body section of drawing
     * ajax call is made to changeBody.php and recieves 
     * the next body img path 
     * The createBody function is then called and 
     * new body image is set 
     */
    body.addEventListener("click", ()=>{
        let url = "changeBody.php?currentBodyID=" + currentBodyID
        fetch(url,{credentials:"include"})
        .then(Response => Response.json())
        .then((path)=>
            {
            createBody(path);
            currentBodyID = path[0].currentBodyID;
            console.log(currentBodyID);
            })
        });

     /**
      * LEGS SECTION
     * Event Listener for legs section of drawing
     * ajax call is made to changeLegs.php and recieves 
     * the next legs img path 
     * The createLegs function is then called and 
     * new legs image is set 
     */
    legs.addEventListener("click", ()=>{
        let url = "changeLegs.php?currentLegsID=" + currentLegsID
        fetch(url,{credentials:"include"})
        .then(Response => Response.json())
        .then((path)=>
            {
            createLegs(path);
            currentLegsID = path[0].currentLegsID;
            console.log(currentLegsID);
            })
        });


//------------------SHOW IMAGE ON CLICK------------------------//
    
     /**
      * CLICK HERE
     * Event Listener for clickHereContainer which is shown on 
     * the initial log in by a new user.
     * Once clicked the click here image is hidden and the 
     * fullDrawingContainer is shown 
     * Lastly getRandomImg is called 
     */
    clickHereContainer.addEventListener("click", ()=>{

        $("#clickHereContainer").hide();
        $("#fullDrawingContainer").show();
        getRandomImg();   
    })

})