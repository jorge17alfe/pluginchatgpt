<nav class="nav navbar navbar-light">
    <!-- <a class="nav-link" onclick="showPage('chatgpt1')" aria-current="page" href="#">Admin</a>
    <a class="nav-link" onclick="showPage('chatgpt2')" href="#">Create Page</a>
    <a class="nav-link" onclick="showPage('chatgpt3')" href="#">Link</a> -->
    <!-- <a class="nav-link "onclick="showPage('chatgpt2')"   href="#">Disabled</a> -->
</nav>


<?php
global $wpdb;
$query = "SELECT * FROM {$wpdb->prefix}chatgpt WHERE id = 0";
$user = $wpdb->get_results($query, ARRAY_A);
require_once __DIR__ . "/add/admin.php";

if (count($user) === 1) {


    require_once __DIR__ . "/add/listPages.php";
    require_once __DIR__ . "/add/createPageIA.php";
    require_once __DIR__ . "/add/modalEditPage.php";
?>



    <script>
        var pages = {
            chatgpt1: {
                title: "Admin "
            },
            chatgpt2: {
                title: "Create "
            },
            chatgpt3: {
                title: "Modal "
            },
            chatgpt4: {
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

            jQuery(".navbar").attr("style", "background-color: #f2f2f2")
            jQuery(".navbar").html(z)
        }

        showPage2()

        function showPage2(e = "chatgpt1") {

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