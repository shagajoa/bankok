<?php include '../modules/head.php'; ?>

<?php include '../modules/navbar_backoffice.php'; ?>



    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Detail des comptes</h2>
                        <a href="create_compte.php" class="btn btn-success pull-right">Créer un nouveau compte</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM ACCOUNTS";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>RIB</th>";
                                        echo "<th>Solde</th>";
                                        echo "<th>Découvert</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ACCOUNT_ID'] . "</td>";
                                        echo "<td>" . $row['ACCOUNT_NAME'] . "</td>";
                                        echo "<td>" . $row['ACCOUNT_RIB'] . "</td>";
                                        echo "<td>" . $row['ACCOUNT_BALANCE'] . "</td>";
                                        echo "<td>" . $row['ACCOUNT_OVERDRAFT'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='voir_compte.php?id=". $row['ACCOUNT_ID'] ."' title='View Record' data-toggle='tooltip'><span class='btn btn-primary'>View</span></a>";
                                            echo "<a href='update_compte.php?id=". $row['ACCOUNT_ID'] ."' title='Update Record' data-toggle='tooltip'><span class='btn btn-primary'>Update</span></a>";
                                            echo "<a href='delete_compte.php?id=". $row['ACCOUNT_ID'] ."' title='Delete Record' data-toggle='tooltip'><span class='btn btn-primary'>Delete</span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>

<?php include '../modules/end.php'; ?>  