function openUser(id,path,typ){
          
    // console.dir(document.getElementById(id).firstChild.nextSibling.innerText);
   console.log("open user declenchée");
    method = "post"; // Set method to post by default if not specified.
    var userId;
    if(typ){
        userId = document.getElementById(id).firstChild.innerText;
    }else{
        userId = document.getElementById(id).firstChild.nextSibling.innerText;
    }
    console.log('userId',userId)
   // The rest of this code assumes you are not using a library.
   // It can be made less wordy if you use one.
   /*var form = document.createElement("form");
   form.setAttribute("method", "get");
   form.setAttribute("action", path);

   var hiddenField = document.createElement("input");
   hiddenField.setAttribute("type", "hidden");
   hiddenField.setAttribute("name", "id");
   hiddenField.setAttribute("value", userId);

   form.appendChild(hiddenField);

   document.body.appendChild(form);*/
   //form.submit();
   }


   function deleteUser(id,personne,elementId){
    
    console.log("deleteUser declenchée");
    var http = new XMLHttpRequest();
    var url = '../deletePerson.php';
    var params = 'id=' + id + '&personne=' + personne;
    http.open('POST', url, true);
 
    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
 
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
          console.log("1st if " + id);
          console.log(http.responseText);
          if(http.responseText == 'success'){
            console.log("2nd if");
            elt = document.getElementById(elementId);
            console.dir(elt);
            elt.parentElement.removeChild(elt);
          }
        }
    }
    
    http.send(params); 
    
   }