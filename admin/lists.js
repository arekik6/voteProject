function openUser(id,path,typ){
          
    // console.dir(document.getElementById(id).firstChild.nextSibling.innerText);
   console.log("open user declenchée");
    method = "get"; // Set method to post by default if not specified.
    var userId;
    if(typ){
        userId = document.getElementById(id).firstChild.innerText;
    }else{
        userId = document.getElementById(id).firstChild.nextSibling.innerText;
    }
    console.log('userId',userId)
   // The rest of this code assumes you are not using a library.
   // It can be made less wordy if you use one.
   var form = document.createElement("form");
   form.setAttribute("method", method);
   form.setAttribute("action", path);
    console.log(path);
   var hiddenField = document.createElement("input");
   hiddenField.setAttribute("type", "hidden");
   hiddenField.setAttribute("name", "id");
   hiddenField.setAttribute("value", userId);

   form.appendChild(hiddenField);

   document.body.appendChild(form);
   form.submit();
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

   function myFunction() {
    console.log("myFunction declenchée");
    var input, filter;
    input = document.getElementById('myInput');
    filter = input.value;//.toLowerCase();

    var container = document.getElementById("tbody");
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
    var http = new XMLHttpRequest();
    var url = './getUsers.php?search=' + filter;
    //var params = 'search=' + filter;
    http.open('GET', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            console.log("1st if ");
            console.log(http.responseText);
            response = JSON.parse(http.responseText);
            for (i in response){
                var tr = document.createElement("tr");
                tr.id = i;
                tr.onclick = function () {
                    openUser(i,'./showUser.php',1);
                }

                var td1 = document.createElement("td");
                var td2 = document.createElement("td");
                var td3 = document.createElement("td");
                var td4 = document.createElement("td");
                var td5 = document.createElement("td");
                var button1 = document.createElement("button");
                button1.classList.add("btn");
                button1.classList.add("btn-primary");
                button1.innerText = 'modify';
                button1.onclick = function () {
                    openUser(i ,"./modifyUser.php",1);
                    event.stopPropagation();
                }
                var button2 = document.createElement("button");
                button2.classList.add("btn");
                button2.classList.add("btn-danger");
                button2.innerText = 'delete';
                button2.onclick = function () {
                    deleteUser(response[i].id ,'user',i);
                    event.stopPropagation();
                }
                td5.appendChild(button1);
                td5.appendChild(button2);

                td1.innerText = response[i].id;
                td2.innerText = response[i].firstName;
                td3.innerText = response[i].lastName;
                if(response[i].role){
                    td4.innerText = 'admin';
                }else{
                    td4.innerText = 'user';
                }

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                container.appendChild(tr);

            }
        }
    }

    http.send('');
}