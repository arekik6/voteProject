var count = 1;

function addCandidate()
{
    var contact = document.getElementById('contact');
    if (contact)
    {
            // Create a new <p> element
            var newP = document.createElement('p');
            newP.innerHTML = 'Candidate ' + (count + 1);

            // Create the new text box
            var newFirst = document.createElement('input');
            newFirst.type = 'text';
            newFirst.name = 'first[]';
            newFirst.size = '10';

            var newLast = document.createElement('input');
            newLast.type = 'text';
            newLast.name = 'last[]';
            newLast.size = '10';

            var newEmail = document.createElement('input');
            newEmail.type = 'text';
            newEmail.name = 'email[]';
            newEmail.size = '10';

            var newTel = document.createElement('input');
            newTel.type = 'text';
            newTel.name = 'tel[]';
            newTel.size = '10';

            var newAddress = document.createElement('input');
            newAddress.type = 'text';
            newAddress.name = 'address[]';
            newAddress.size = '10';

            var newDesc = document.createElement('input');
            newDesc.type = 'text';
            newDesc.name = 'description[]';
            newDesc.size = '10';

            var newImg = document.createElement('input');
            newImg.type = 'text';
            newImg.name = 'img[]';
            newImg.size = '10';

            if (newFirst && newP)   
            {
                contact.appendChild(newP);
                contact.appendChild(newFirst);
                contact.appendChild(newLast);
                contact.appendChild(newEmail);
                contact.appendChild(newTel);
                contact.appendChild(newAddress);
                contact.appendChild(newDesc);
                contact.appendChild(newImg);
                count++;
            }

    }
}