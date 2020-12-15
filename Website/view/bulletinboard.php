<?php
include "header.php";
?>

<body>
<?php
    include "nav.php";
?>
    <div class="container">
        <h4 class="text-center"> Bulletin Board </h4>

        <h3 class="text-center"> Week of 3/27/2020 </h3>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table id="usersTable" class="table table-border">
                        <thead>
                            <tr>
                                <th scope="col"> Company Name</th>
                                <th scope="col"> Order Taken </th>
                                <th scope="col"> Work Order Typed </th>
                                <th scope="col"> Work Order Copied </th>
                                <th scope="col"> Work Done </th>
                                <th scope="col"> Certs Done </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <button class='buttonFullSize' id="AddRow" type="button"> Add Company </button>
        </div>
    </div>
    <?php
    include "footer.php";
?>
</body>

</html>