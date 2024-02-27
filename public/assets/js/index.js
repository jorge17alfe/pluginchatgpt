let pagin = 0
let total_rows = 0
jQuery(document).ready(($) => {
    $("#btnedittext").hide()
    var url = PetitionAjax.url;
    $("#formDataUser").on("submit", (e) => {
        e.preventDefault()


        datas = {
            id: generatePageId.value,
            tokenOpenai: generatePageToken.value,
            amazonID: generatePageAmazon.value,
            gptversion: generatePageVersion.value
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
        // console.log(response)
        generatePageToken.value = response.tokenOpenai
        generatePageAmazon.value = response.amazonID
       
        $(`#generatePageVersion option[value='${response.gptversion}']`).attr("selected", "selected");
    }

    $("#spinner").hide()
    $("#btncreate").on("click", (e) => {
        e.preventDefault()
        data = {
            title: titleIA.value,
            content: descriptionIA.value,
        }

        $("#spinner").show()

        // var datos = $("#formCreatePageIA").serialize();
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
            $("#resultpageIA").html(response.content.title + response.content.content)
            $("#btncreate").html("New Create")
            $("#btnedittext").show().attr("href", `${window.location.hostname}/../post.php?post=${response.id}&action=edit`)

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
            add += `<th scope="row">${response[k]["ID"]}</th>`
            add += `<td>${response[k]["post_name"]}</td>`
            add += `<td>${response[k]["post_status"]}</td>`
            add += `<td>${response[k]["post_title"]}</td>`
            add += `<td><a href='${window.location.hostname}/../post.php?post=${response[k]["ID"]}&action=edit'>Edit</a></td>`
            add += `</tr>`

        }
        $("#listPages>tbody").html(add);
   
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