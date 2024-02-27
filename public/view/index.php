<div class=" bg-transparent">
    <div class="container">
        <nav class="nav-gp nav  justify-content-end bg-transparent">
            <!-- <a class="nav-link" onclick="showPage('chatgpt1')" aria-current="page" href="#">Admin</a>
    <a class="nav-link" onclick="showPage('chatgpt2')" href="#">Create Page</a>
    <a class="nav-link" onclick="showPage('chatgpt3')" href="#">Link</a> -->
            <!-- <a class="nav-link "onclick="showPage('chatgpt2')"   href="#">Disabled</a> -->
        </nav>

        <?php
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}generatepageadmin WHERE id = ".get_current_user_id();
        $user = $wpdb->get_results($query, ARRAY_A);
        // print_r(get_current_user_id());
        require_once __DIR__ . "/add/admin.php";

        if (count($user) === 1) {


            require_once __DIR__ . "/add/listPages.php";
            require_once __DIR__ . "/add/createPageIA.php";
            require_once __DIR__ . "/add/modalEditPage.php";
        ?>


    </div>
</div>
<style>
    #wpcontent {
        padding-left: 0px;
    }
</style>
<script>
    var pages = {
        generatepage2: {
            title: "Create "
        },
        generatepage1: {
            title: "Admin "
        },
        generatepage3: {
            title: "Modal "
        },
        generatepage4: {
            title: "List Pages"
        },
    }

    showPage()

    function showPage() {
        z = ''
        for (let k in pages) {
            jQuery("#" + k + ">div>div>h3").html(pages[k]["title"])
            z += '<a class="nav-link" onclick="showPage2(\'' + k + '\')" href="#">' + pages[k]["title"] + '</a>'
        }

        jQuery(".nav-gp").attr("style", "background-color: #f2f2f2")
        jQuery(".nav-gp").html(z)
    }

    showPage2()

    function showPage2(e = "generatepage1") {

        for (let k in pages) {
            if (k == e) {
                jQuery("#" + k).show()
            } else {
                jQuery("#" + k).hide()
            }
        }

    }
</script>
<?php } ?>