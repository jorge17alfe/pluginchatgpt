<nav class="nav navbar navbar-light" style="background-color: #f2f2f2;">
    <!-- <a class="nav-link" onclick="showPage('chatgpt1')" aria-current="page" href="#">Admin</a>
    <a class="nav-link" onclick="showPage('chatgpt2')" href="#">Create Page</a>
    <a class="nav-link" onclick="showPage('chatgpt3')" href="#">Link</a> -->
    <!-- <a class="nav-link "onclick="showPage('chatgpt2')"   href="#">Disabled</a> -->
</nav>


<?php
// echo ;
require_once __DIR__ . "/add/listPages.php";
require_once __DIR__ . "/add/admin.php";
require_once __DIR__ . "/add/createPageIA.php";
require_once __DIR__ . "/add/modalEditPage.php";
?>



<script>
    var pages = {
        chatgpt4: {
            title: "List Pages"
        },
        chatgpt1: {
            title: "Admin "
        },
        chatgpt2: {
            title: "Create "
        },
        chatgpt3: {
            title: "Modal "
        },
    }

    showPage()

    function showPage() {
        z = ''
        for (let k in pages) {
            jQuery("#" + k + ">div>div>h3").html(pages[k]["title"])
            z += '<a class="nav-link" onclick="showPage2(\'' + k + '\')" href="#">' + pages[k]["title"] + '</a>'
        }

        jQuery(".navbar").html(z)
    }

    showPage2()

    function showPage2(e = "chatgpt4") {

        for (let k in pages) {
            if (k == e) {
                jQuery("#" + k).show()
            } else {
                jQuery("#" + k).hide()
            }
        }

    }
</script>