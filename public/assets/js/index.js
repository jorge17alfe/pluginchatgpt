let pagin = 0
let total_rows = 0
jQuery(document).ready(($) => {
    var url = PetitionAjax.url;
    $("#formDataUser").on("submit", (e) => {
        e.preventDefault()


        datas = {
            id: generatePageId.value,
            status: generatePageStatus.value,
            tokenOpenai: generatePageToken.value,
            amazonID: generatePageAmazon.value,
            name: generatePageName.value,
            surname: generatePageSurname.value,
            email: generatePageEmail.value,
            chatgptversion: generatePageVersion.value
        }

        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "save_data_user_admin",
                nonce: PetitionAjax.security,
                data: datas,
            },

        }).done((response) => {
            location.reload()
            getRow(response)
        });



    })


    $.ajax({
        type: "GET",
        url: url,
        data: {
            action: "get_data_user_admin",
            nonce: PetitionAjax.security
        },

    }).done((response) => {
        getRow(response);
    });
    
    function getRow(response) {
        response = response.substring(0, response.length - 1)
        response = JSON.parse(response)
        console.log(response)
        // $("#chatgptToken").attr("disabled","disabled")
        generatePageToken.value = response.tokenOpenai
        generatePageAmazon.value = response.amazonID
        generatePageId.value = response.id
        generatePageName.value = response.name
        generatePageSurname.value = response.surname
        generatePageEmail.value = response.email
        $(`#generatePageVersion option[value='${response.generatePageVersion}']`).attr("selected", "selected");
    }

    $("#spinner").hide()
    $("#btndev").on("click", (e) => {
        e.preventDefault()


        data = {
            // id: null,
            title: titleIA.value,
            content: descriptionIA.value,

        }

        $("#spinner").show()

        var datos = $("#formCreatePageIA").serialize();
        // alert(url)
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "save_create_page_IA",
                nonce: PetitionAjax.security,
                data: data,
            }



        }).done((response) => {
            $("#spinner").hide()
            response = response.substring(0, response.length - 1)
            response = JSON.parse(response)
            
            console.log(response)

            $("#resultpageIA").html(response.content)
            $("#resultpageIA").append(`<a>${response.id}</a>`)
            $("#btneditText").on("click", () => {
                $("#btneditText").html("Send update")
                $("#editTextIA").html(response.content)
            })

        })


    })



    $.ajax({
        type: "GET",
        url: url,
        data: {
            action: "get_all_pages",
            nonce: PetitionAjax.security
        },

    }).done((response) => {
        response = response.substring(0, response.length - 1)
        response = JSON.parse(response)
        console.log(response)
        total_rows = response.length ?? 1
        printGrouprow(response)

    });


})

function printGrouprow(response = '') {
    jQuery(document).ready(($) => {
        var add = '';
        for (let k in response) {
            // console.log(response[k]["shortCode"])
            add += `<tr>`
            add += `<th scope="row">${response[k]["id"]}</th>`
            add += `<td>${response[k]["shortCode"]}</td>`
            add += `<td>${response[k]["consult"]}</td>`
            add += `<td>${response[k]["title"]}</td>`
            add += `</tr>`

        }
        $("#listPages>tbody").html(add);
        // var adds = `<div class=""><p class=" d-flex justify-content-around">`;
        // adds += `<a  onclick=' pagination(-1)' href="javascritp:void(0);">PREV</a>`;
        // adds += `<a  onclick=' pagination(+1)' href="javascritp:void(0);">NEXT</a>`;
        // adds += `</p></div>`;
        // $("#listPages").after(adds);
    })
}
function pagination(arg) {
    var url = PetitionAjax.url;
    pagin += arg
    // if(pagin === 0) pagin = '0'
    jQuery(document).ready(($) => {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                action: "get_all_pages",
                nonce: PetitionAjax.security,
                data: {
                    total_rows: total_rows,
                    since: pagin,

                },
            },

        }).done((response) => {
            response = response.substring(0, response.length - 1)
            response = JSON.parse(response)
            if (pagin < 0) pagin = 0
            if (response.length === 0) {
                $("#listPages>tbody").html("<tr><td>There is not more data...</tr></td>")
                pagin -= 1
                return;
            };
            console.log(response, pagin, total_rows, (pagin * total_rows))
            printGrouprow(response)

        });



    })
}