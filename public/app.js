
let buttonElementAdd = document.getElementById('add-provider');

buttonElementAdd.addEventListener('click', function() {
    let providerName = document.getElementById('provider-name');
    let providerUrl = document.getElementById('provider-url');
    let formData = new FormData();

    formData.append('provider_name', providerName.value);
    formData.append('provider_url', providerUrl.value);
    formData.append('_token', csrf_token);

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '/api/providers');
    xhttp.getResponseHeader('Content-type', 'application/json');
    xhttp.send(formData);

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            try {
                alert('New provider added!');
                let response = JSON.parse(xhttp.response);
                let tbodyRef = document.getElementById('provider-contents');
                tbodyRef.insertAdjacentHTML('afterbegin', 
                    "<tr class=\"bg-white border-b dark:bg-gray-800 dark:border-gray-700\" id=\"trData-" + response.provider_id + "\">" + 
                        "<td class=\"px-6 py-4\">" + response.provider_name + "</td>" +
                        "<td class=\"px-6 py-4\">" + response.provider_url + "</td>" +
                        "<td class=\"px-6 py-4\">" +
                            "<button onclick=\"useProvider(this.id)\" id=\"buttonTry-" + response.provider_id + "\"" + "name=\"try\" class=\"text-white bg-green-500 hover:bg-green-700 font-medium rounded-full text-sm px-4 py-2.5 text-center\">Try</button> " +
                            "<button onclick=\"toggleEditModal(this.id)\" id=\"buttonEdit-" + response.provider_id + "\"" + "name=\"edit\" class=\"text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-full text-sm px-4 py-2.5 text-center\">Edit</button> " +
                            "<button onclick=\"deleteProvider(this.id)\" id=\"buttonDelete-" + response.provider_id + "\"" + "name=\"delete\" class=\"text-white bg-red-500 hover:bg-red-700 font-medium rounded-full text-sm px-4 py-2.5 text-center\">Delete</button> " +
                        "</td>" + 
                    "</tr>"
                );
                providerName.value = '';
                providerUrl.value = '';
            } catch (e) {
                alert('Something went wrong during data insertion');
            }
        } else if (xhttp.status !== 200) {
            alert('Something went wrong');
        }
    }
})


function useProvider(buttonId) {
    let buttonElement = document.getElementById(buttonId);
    let providerUrl = buttonElement.parentElement.previousElementSibling.innerHTML;
    let imageContainer = document.getElementById('response-image');
    let loadingOverlay = document.getElementById('loading-overlay');

    loadingOverlay.classList.remove('hidden');
    loadingOverlay.classList.add('flex');

    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', providerUrl, true);
    xhttp.getResponseHeader('Content-type', 'application/json');

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            try {
                let response = JSON.parse(xhttp.response);
                imageContainer.src = response.message;
            }
            catch (e) {
                alert('There\'s a problem with rendering the image');
            }
        } else if (xhttp.status !== 200) {
            alert('Not a valid data provider URL');
            return;
        }
        loadingOverlay.classList.remove('flex');
        loadingOverlay.classList.add('hidden');
    }
    xhttp.send()
}

function toggleEditModal(buttonId) {
    let buttonElement = document.getElementById(buttonId);
    let tdProviderUrl = buttonElement.parentElement.previousElementSibling;
    let tdProviderName = tdProviderUrl.previousElementSibling;

    let modalObj = document.getElementById('dialog');
    let overlayObj = document.getElementById('overlay');
    let dialogHeader = document.getElementById('current-edit');
    let closeButton = document.getElementById('closeDialog');
    let saveButon = document.getElementById('saveDialog');
    let editProviderName = document.getElementById('edit-provider-name');
    let editProviderUrl = document.getElementById('edit-provider-url');

    modalObj.classList.remove('hidden');
    overlayObj.classList.remove('hidden');
    dialogHeader.innerHTML = 'Editing provider name: ' + tdProviderName.innerHTML;
    editProviderName.value = tdProviderName.innerHTML;
    editProviderUrl.value = tdProviderUrl.innerHTML;

    saveButon.addEventListener('click', function() {
        let formData = new FormData();
        let xhttp = new XMLHttpRequest();

        let newProviderName = document.getElementById('edit-provider-name').value;
        let newProviderUrl = document.getElementById('edit-provider-url').value;

        formData.append('provider_name', newProviderName);
        formData.append('provider_url', newProviderUrl);
        formData.append('_token', csrf_token);

        xhttp.open('POST', '/api/providers/' + buttonId.split('-')[1]);
        xhttp.send(formData);

        xhttp.onreadystatechange = () => {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                if (xhttp.responseText === '1') {
                    alert('Update successful');
                    tdProviderName.innerHTML = newProviderName ?? tdProviderName.innerHTML;
                    tdProviderUrl.innerHTML = newProviderUrl ?? tdProviderUrl.innerHTML;
                } else {
                    alert('Nothing was updated');
                }
                modalObj.classList.add('hidden');
                overlayObj.classList.add('hidden');
            } else if (xhttp.status !== 200) {
                alert('Something went wrong')
            }
        }
    })

    
    closeButton.addEventListener('click', function () {
        modalObj.classList.add('hidden');
        overlayObj.classList.add('hidden');
    });
}

function deleteProvider(buttonId) {
    if (confirm('Are you sure you want to delete this record?')) {
        let providerId = buttonId.split('-')[1];
        let trToDelete = document.getElementById('trData-' + providerId);
        let xhttp = new XMLHttpRequest();
        xhttp.open('DELETE', '/api/providers/' + providerId);

        xhttp.onreadystatechange = () => {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                if (xhttp.responseText === '1') {
                    alert('Deletion successful');
                    trToDelete.remove();
                } else {
                    alert('Something went wrong during deletion');
                }
            } else if (xhttp.status !== 200) {
                alert('Something went wrong')
            }
        }
        xhttp.send()
    }
}

