  <?php 
require ('backendheader.php');
require ('db_connect.php');

$role_id=2;

 $sql = "SELECT users.*, roles.name as rname FROM users 
         INNER JOIN model ON users.id = model.user_id 
         INNER JOIN roles ON model.role_id = roles.id 
         WHERE model.role_id=:v1";

         $stmt= $conn->prepare($sql);
         $stmt->bindParam(':v1',$role_id);
         $stmt->execute();

        $rows=$stmt->fetchAll();
      
   ?>



  <div class="app-title">
    <div>
        <h1> <i class="icofont-list"></i> User </h1>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                          $i=1;

                        foreach($rows as $row){
                          $id = $row["id"];
                          $name = $row["name"];
                          $email= $row['email'];
                          $phone= $row['phone'];
                          $address= $row['address'];


                        ?>




                        <tr>
                            <td> <?= $i++ ?> </td>
                            <td> <div><?= $name ?></div><?= $email ?><div></div> </td>
                            <td><div><?= $phone ?></div><?= $address ?><div></div></td>
                            <td>

                                <a href="user_delete.php?id=<?= $id?>" class="btn btn-outline-danger">
                                    <i class="icofont-close"></i>
                                </a>
                            </td>

                        </tr>
                      <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div> 

<?php 

require ('backendfooter.php');
 ?>